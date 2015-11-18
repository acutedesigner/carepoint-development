<?php

if(!class_exists('carepointSaveArticle'))
{

class carepointSaveArticle
{
	var $post_id;
	var $result = array();

	function __construct()
	{
		add_action( 'init', array( $this, 'cpsa_add_rewrites' ) );
		register_activation_hook( __FILE__, array( $this, 'cpsa_rewrite_activation' ));
		add_filter( 'query_vars', array( $this, 'cpsa_rewrite_add_var' ));
		add_action( 'template_redirect', array( $this, 'cpsa_catch_form' ));
	}

	function cpsa_add_rewrites()
	{
		add_rewrite_rule(
			'^savearticle/([a-z]*)/([0-9]*)/([a-z0-9]*)/?$',
			'index.php?cpsa_action=$matches[1]&cpsa_post_id=$matches[2]&cpsa_nonce=$matches[3]',
			'top'
		);
	}

	// Only need to have this done once
	function cpsa_rewrite_activation()
	{
		$this->cpsa_add_rewrites();
		flush_rewrite_rules();
	}

	function cpsa_rewrite_add_var( $vars )
	{
	    $vars[] = 'cpsa_action';
	    $vars[] = 'cpsa_post_id';
	    $vars[] = 'cpsa_nonce';
	    return $vars;
	}

	function cpsa_catch_form()
	{

		if( get_query_var('cpsa_post_id') && wp_verify_nonce( get_query_var('cpsa_nonce'), "cp_bookmark_article_nonce"))
		{
			$this->post_id = get_query_var('cpsa_post_id');

			switch (get_query_var('cpsa_action')) {
				case 'bookmark':
					$this->bookmark_article();
					break;

				case 'unbookmark':
					$this->unbookmark_article();
					break;
				
				default:
					# code...
					break;
			}
		}

	}

	function bookmark_article()
	{

		$this->result['method'] = "bookmark";

		if ( !wp_verify_nonce( get_query_var('cpsa_nonce'), "cp_bookmark_article_nonce"))
		{
			// NOTE! Want this to go to 404 error page
			exit("No naughty business please");
		}

		if($this->post_id != $_COOKIE['cp_sa_'.$this->post_id])
		{
			$time_stamp = time();

			// Set the new cookie
			setcookie("cp_sa_".$this->post_id, $time_stamp, time() + 30000000, apply_filters('cp_bookmark_cookiepath', SITECOOKIEPATH));

			// Create the db data
			$save_data = array(
				'cp_sa_postid' => $this->post_id,
				'cp_sa_posttype' => get_post_type( $this->post_id ),
				'cp_sa_timestamp' => $time_stamp,
				'cp_sa_ip' => $this->get_ipaddress()
			);

			// Save and return to article page
			if($this->save_to_db($save_data))
			{
				$this->result['type'] = "success";
				$this->result['message'] = "Article saved";
				$this->return_to_page();
			}
			else
			{
				// NOTE! Want this to go to 404 error page
				exit("No naughty business please");				
			}

		}
		else
		{
			$this->return_to_page();
		}
	}

	function unbookmark_article()
	{
	
		$this->result['method'] = "unbookmark";

		// Then delete the entry from the db only if it exists
		$user_ip = $this->get_ipaddress();
		$cookie = $_COOKIE['cp_sa_'.$this->post_id];

		// NOTE! Delete the cookie

		global $wpdb;
		$db_query = $wpdb->delete( $wpdb->cp_save_article, array( 'cp_sa_postid' => $this->post_id, 'cp_sa_ip' => $user_ip, 'cp_sa_timestamp' => $cookie) );

		if($db_query == 1)
		{
			$this->result['type'] = "success";
		}
		else
		{
			$this->result['message'] = "Article not unbookmarked";
		}

		$this->return_to_page();
	}

	function get_bookmarked_articles()
	{

	}

	/*** Bookmark helper functions ***/

	function get_ipaddress() {
		if (empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip_address = $_SERVER["REMOTE_ADDR"];
		} else {
			$ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		if(strpos($ip_address, ',') !== false) {
			$ip_address = explode(',', $ip_address);
			$ip_address = $ip_address[0];
		}
		return esc_attr($ip_address);
	}

	function check_article($post_id)
	{
		$user_ip = $this->get_ipaddress();
		$cookie = $_COOKIE['cp_sa_'.$post_id];

		// Get the data from the db
		global $wpdb;
		$db_query = $wpdb->get_row( $wpdb->prepare("SELECT cp_sa_id, cp_sa_timestamp FROM $wpdb->cp_save_article WHERE cp_sa_postid = %d AND cp_sa_ip = %s AND cp_sa_timestamp = %s", $post_id, $user_ip, $cookie) );

		if(!empty($db_query) && $db_query->cp_sa_timestamp == $cookie)
		{
			return TRUE;
		}
	}

	// Add to database
	function save_to_db($save_data)
	{
		global $wpdb;			
		if($wpdb->insert( $wpdb->cp_save_article, $save_data, array('%d','%d','%s','%s','%s',)))
		{
			return TRUE;
		}
	}

	function return_to_page()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$result = json_encode($this->result);
      		echo $result;
      		die();
		}
		else
		{
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}		
	}

}

function cp_bookmark_article()
{
	$carepointSaveArticle = new carepointSaveArticle;
	$carepointSaveArticle->bookmark_article();
}

add_action("wp_ajax_nopriv_cp_bookmark_article", "cp_bookmark_article");

function cp_unbookmark_article()
{
	$carepointSaveArticle = new carepointSaveArticle;
	$carepointSaveArticle->unbookmark_article();
}

add_action("wp_ajax_nopriv_cp_unbookmark_article", "cp_unbookmark_article");

/**
 *
 *	This function loads a button into the single.php template
 *	ready for user interact to download a PDF.
 *
 * 	@param int $post_id ID of the current post
 * 
 */

global $carepointSaveArticle;
$carepointSaveArticle = new carepointSaveArticle;

function cp_bookmark_article_button($post_id)
{

	global $carepointSaveArticle;

	$nonce = wp_create_nonce("cp_bookmark_article_nonce");

	// We need to check to see if the article already has been bookmarked by this user.

	// print_r($carepointSaveArticle->check_article($post_id));

	if($carepointSaveArticle->check_article($post_id))
	{
		// Show the unbookmark link
		//$link = admin_url('admin-ajax.php?action=cp_unbookmark_article&post_id='.$post_id.'&nonce='.$nonce);
		$link = site_url('/savearticle/unbookmark/'.$post_id.'/'.$nonce);
		echo '<li><a class="cp_bookmark_article_button tooltip" title="Remove article from your list" href="' . $link . '" data-post-id="'.$post_id.'" data-nonce="'.$nonce.'" data-action="unbookmark" ><i class="fa fa-trash">&nbsp;</i></a></li>';
	}
	else
	{
		// Show the bookmark link
		//$link = admin_url('admin-ajax.php?action=cp_bookmark_article&post_id='.$post_id.'&nonce='.$nonce);
		$link = site_url('/savearticle/bookmark/'.$post_id.'/'.$nonce);
		echo '<li><a class="cp_bookmark_article_button tooltip" title="Save this article" href="' . $link . '" data-post-id="'.$post_id.'" data-post-id="'.$post_id.'" data-nonce="'.$nonce.'" data-action="bookmark" ><i class="fa fa-plus-circle">&nbsp;</i></a></li>';
	}	

}

}






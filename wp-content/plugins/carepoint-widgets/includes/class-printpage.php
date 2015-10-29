<?php

if(!class_exists('carepointPrintPage'))
{

class carepointPrintPage
{

	public function __construct()
	{
		add_action( 'init', array( $this, 'cppp_add_rewrites' ) );
		register_activation_hook( __FILE__, array( $this, 'cppp_rewrite_activation' ));
		add_filter( 'query_vars', array( $this, 'cppp_rewrite_add_var' ));
		add_action( 'template_redirect', array( $this, 'cppp_catch_form' ));
	}

	public static function cppp_add_rewrites()
	{
		add_rewrite_rule(
			'^printpage/?([0-9]*)/([a-z0-9]*)/?$',
			'index.php?cppp_post_id=$matches[1]&cppp_nonce=$matches[2]',
			'top'
		);
	}

	// Only need to have this done once
	public static function cppp_rewrite_activation()
	{
		$this->cppp_add_rewrites();
		flush_rewrite_rules();
	}

	public function cppp_rewrite_add_var( $vars )
	{
	    $vars[] = 'cppp_post_id';
	    $vars[] = 'cppp_nonce';
	    return $vars;
	}

	public static function cppp_catch_form()
	{

		if( get_query_var('cppp_post_id') && !wp_verify_nonce( get_query_var('nonce'), "cp_printpage_nonce"))
		{
			get_header('print');
			include(CPT_PLUGIN_DIR . '/views/' . 'cppp-layout.php');
			exit();
		}

	}
}

$carepointPrintPage = new carepointPrintPage;

/**
 *
 *	This function loads a button into the single.php template
 *	ready for user interact to download a PDF.
 *
 * 	@param int $post_id ID of the current post
 * 
 */

function cp_printpage_button($post_id)
{
	$nonce = wp_create_nonce("cp_printpage_nonce");
	$link = site_url('/printpage/'.$post_id.'/'.$nonce);
	echo '<li><a class="cp_print_button tooltip" title="Print this article" href="' . $link . '"><i class="fa fa-print"></i></a></li>';
}

}






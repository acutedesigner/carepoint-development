<?php

if(!class_exists('emailArticle')){

class emailArticle
{
	/**
	 *  
	 *  EMAIL ARTICLE
	 * 
	 *  This class will allow a user to email a link of the article
	 *  to an email address of their choice  
	 * 
	 */

	var $message;
	var $message_type;
	var $post;
	var $html_email;

	public function __construct()
	{	
		// Check nonce carepoint_email_article
		
		if(wp_verify_nonce( $_POST['nonce'], 'cp_ea_nonce'))
		{
			$this->process_article();
		}
		else
		{
			$this->message_type = 'error';
		    $this->message = 'Heeeey! Why is you tryin hmmmmmmmm?';
		    $this->response_message();			
		}
	}

	/**
	 *
	 *	Processes the request from the user
	 *	The main engine of the class
	 *
	 * 	@param object $post WP_Post Object
	 * 	returns nothing
	 * 
	 */

	function process_article()
	{
		require_once CPT_PLUGIN_DIR . 'assets/php/gump/gump.class.php';

		$gump = new GUMP();

		$_POST = $gump->sanitize($_POST); // You don't have to sanitize, but it's safest to do so.

		$gump->validation_rules(array(
		    'email'       => 'required|valid_email',
		));

		$gump->filter_rules(array(
		    'email'    => 'trim|sanitize_email',
		));

		$validated_data = $gump->run($_POST);

		if($validated_data === false) {
			$this->message_type = 'error';
		    $this->message = $gump->get_readable_errors(true);
		} else {

			// Get the article data
			$this->post = get_post($validated_data['post_id'], OBJECT, 'edit'); 
			
			//build the html
			$email_html = $this->build_html();

			// If article is sent
			if($this->send_email($validated_data['email']))
			{
				$this->message_type = 'success';
			    $this->message = 'The article link has been emailed';				
			}
			else
			{
				$this->message_type = 'error';
			    $this->message = 'The article has not been sent. Please try again';				
			} 
		}

		// Finally send the response to user
		$this->response_message();

	}

	/**
	 *
	 *	Build the HTML email based on the post object
	 *
	 * 	@param object $this->post WP_Post Object
	 * 	returns HTML Email string
	 * 
	 */

	private function send_email($email)
	{
		$to = $email;
		$subject = $this->post->post_title.' | Havering Care Point';
		$headers = 'From: Care Point <donotreply@haveringcarepoint.org>' . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		if(wp_mail( $to, $subject, $this->html_email, $headers ))
		{
			return true;
		}
	}

	/**
	 *
	 *	Build the HTML email based on the post object
	 *
	 * 	@param object $this->post WP_Post Object
	 * 	returns HTML Email string
	 * 
	 */

	private function build_html()
	{
		$carepoint_logo = get_bloginfo('template_url').'/library/images/carepoint-logo.jpg';
		$excerpt = $this->post->post_excerpt;
		$post_title = $this->post->post_title;
		$post_permalink = get_permalink ( $this->post->ID );

		if( $excerpt == '' )
		{
			$excerpt = $this->get_excerpt_by_id($this->post->ID);
		}
		require_once CPT_PLUGIN_DIR . 'views/email-article-html.php';
	}
	
	/**
	 *
	 *	Sends back a JSON response to the email form
	 *
	 * 	@param str $this->message Alert message for user
	 * 	@param str $this->message_type ID Type of message error | success
	 * 	returns JSON object
	 * 
	 */

	private function response_message()
	{
		$result = array(
			'message' => $this->message,
			'type' => $this->message_type
			);

		echo json_encode($result);
		die();		
	}

	/**
	 *
	 *	Because Wordpress wont let you get the excerpt outside the loop
	 *	Silly Wordpress!!
	 *
	 * 	@param int $post_id Post id
	 * 	returns string the excerpt
	 * 
	 */

	function get_excerpt_by_id($post_id){
	    $the_post = get_post($post_id); //Gets post ID
	    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	    $excerpt_length = 35; //Sets excerpt length by word count
	    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

	    if(count($words) > $excerpt_length) :
	        array_pop($words);
	        array_push($words, '...');
	        $the_excerpt = implode(' ', $words);
	    endif;

	    return $the_excerpt;
	}
}

add_action('wp_ajax_nopriv_email_article', 'carepoint_email_article');

function carepoint_email_article()
{
	$emailArticle = new emailArticle;	
}

function cp_emailarticle_button()
{
	echo '<li><a class="tooltip email-form-button" title="Email this article" href="#"><i class="fa fa-envelope-o"></i></a></li>';
}

function cp_emailarticle_form($post_id)
{
	$nonce = wp_create_nonce("cp_ea_nonce");

	$html = <<<EOT
		<div class="block email-form">
			<h3>Email this article</h3>
			<p>Please enter the email address you want to send this article to:</p>
			<form action="" method="post">
				<input name="email" type="text">
				<input name="nonce" type="hidden" value="$nonce">
				<input name="post_id" type="hidden" value="$post_id">
				<input name="action" type="hidden" value="email_article">
				<input class="btn red-grad" type="submit" value="Email article">
			</form>
			<hr/>
			<a class="btn blue-grad email-form-button" href="#">Hide form <i class="fa fa-close"></i></a>
		</div>
EOT;

    echo $html;
}
	
}
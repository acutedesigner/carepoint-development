<?php

if(!class_exists('emailArticle')){

class emailArticle
{
	/**
	 *  
	 *  EMAIL ARTICLE
	 * 
	 *  This class will allow a user to email a link of the article to an email address of their choice
	 *  First we need to capture the post data
	 *  $post_id
	 *  $email_address
	 *
	 * 	Then we need to vaildate the email address
	 *
	 * 		If the validation fails
	 * 		
	 *   		then we need to send back an error message: "This email is not valid"
	 * 		
	 * 		else
	 * 			
	 * 			we get the article data and build the HTML email
	 *
	 * 				If article is sent
	 *
	 * 					Send back an success message: "Your email has been sent"
	 *
	 * 				else
	 *
	 * 					Send back an error message: "There was an error sending your email"
	 *
	 * 		
	 * 
	 */

	public function __construct()
	{	
		echo "Email Article. YaY!";
		die();
	}

	function send_email()
	{

	}

	function build_html()
	{

	}
	
	/**
	 *
	 *	This function loads will send back a JSON response to the email form
	 *
	 * 	@param str $message Alert message for user
	 * 	@param str $error_type ID Type of message error | success
	 * 	returns JSON object
	 * 
	 */

	function response_message($message, $error_type)
	{

	}
}

add_action('wp_ajax_nopriv_email_article', 'carepoint_email_article');

function carepoint_email_article()
{
	$emailArticle = new emailArticle;	
	
	exit();
}

function cp_emailarticle_button($post_id)
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
				<input name="action" type="hidden" value="email_article">
				<input class="btn red-grad" type="submit">
			</form>
			<hr/>
			<a class="btn blue-grad email-form-button" href="#">Hide form <i class="fa fa-close"></i></a>
		</div>
EOT;

    echo $html;
}
	
}
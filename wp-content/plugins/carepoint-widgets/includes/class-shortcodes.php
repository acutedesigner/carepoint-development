<?php

if(!class_exists('carepointShortcodes'))
{

class carepointShortcodes
{


	public function __construct()
	{
		add_shortcode('services-directory',	array( 'carepointShortcodes', 'services_directory' ));	
		add_shortcode('column', array( 'carepointShortcodes', 'column' ));
	}

	public static function services_directory($atts , $content)
	{

		return '<div class="two-up-grid">' . do_shortcode($content) . '</div>';

	}

	public static function column($atts, $content)
	{
		return '<div class="grid">'.$content.'</div>';
	}

}

$carepointShortcodes = new carepointShortcodes();

}
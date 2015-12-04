<?php

if(!class_exists('carepointShortcodes'))
{

class carepointShortcodes
{


	public function __construct()
	{
		add_shortcode('services-directory',	array( 'carepointShortcodes', 'services_directory' ));	
		add_shortcode('block-service-link',	array( 'carepointShortcodes', 'block_service_link' ));	
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

	public static function block_service_link($atts, $content)
	{
		extract($atts);

		$html = '<div class="block block-service-link ">';
		$html .= '	<div class="text-block">';
		$html .= '		<h2>'.$title.'</h2>';
		$html .= 		($content != '' ? '<p>'.$content.'</p>' : NULL);
		$html .= '	</div>';
		$html .= '	<a href="'.$url.'" target="_blank">Access form <i class="fa fa-angle-double-right"></i></a>';
		$html .= '	</div>';

		return $html;
	}

}

$carepointShortcodes = new carepointShortcodes();

}
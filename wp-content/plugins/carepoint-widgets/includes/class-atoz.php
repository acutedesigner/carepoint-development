<?php

if(!class_exists('carepointAtoz'))
{

class carepointAtoz
{

	public function __construct()
	{
		add_action( 'init', array( $this, 'atoz_add_rewrites' ) );
		register_activation_hook( __FILE__, array( $this, 'atoz_rewrite_activation' ));
		add_filter( 'query_vars', array( $this, 'atoz_rewrite_add_var' ));
		add_action( 'template_redirect', array( $this, 'atoz_catch_form' ));
	}

	public static function atoz_add_rewrites()
	{
		add_rewrite_rule(
			'^tag/?([a-z\-]*)/?$',
			'index.php?letter=$matches[1]',
			'top'
		);

		add_rewrite_rule(
			'^tag/([a-z\-]*)/([a-z\-]*)/?$',
			'index.php?letter=$matches[1]&term=$matches[2]',
			'top'
		);
	}

	// Only need to have this done once
	public static function atoz_rewrite_activation()
	{
		$this->atoz_add_rewrites();
		flush_rewrite_rules();
	}

	public function atoz_rewrite_add_var( $vars )
	{
	    $vars[] = 'term';
	    $vars[] = 'letter';
	    return $vars;
	}

	public static function atoz_catch_form()
	{

		if( get_query_var('letter') && get_query_var('term') )
		{
			get_header();
			include(CPT_PLUGIN_DIR . '/views/' . 'atoz-menu.php');
			include(CPT_PLUGIN_DIR . '/views/' . 'atoz-terms-posts.php');
			get_footer();
			exit();
		}
		else if( get_query_var( 'letter' ) )
		{
			get_header();
			include(CPT_PLUGIN_DIR . '/views/' . 'atoz-menu.php');
			include(CPT_PLUGIN_DIR . '/views/' . 'atoz-terms.php');
			get_footer();
			exit();
		}
	}
	
}

$carepointAtoz = new carepointAtoz;

}
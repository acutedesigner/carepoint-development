<?php
/*
Plugin Name: Carepoint Functions
Plugin URI: http://www.acumendesign.co.uk
Description: A collections of features and function exclusive for the Havering Care Point Website
Version: 1.0
Author: @acute_designer
Author Nigel M Peters
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define("CPT_VERSION_NUMBER", "0.1");
define("CPT_PLUGIN_DIR", plugin_dir_path(__FILE__)); 

// Setup db table name
global $wpdb;
$wpdb->cp_save_article = $wpdb->prefix.'cp_save_article';


//Load up the classes for wordpress
require_once CPT_PLUGIN_DIR . 'includes/class-custom-posttypes.php';
require_once CPT_PLUGIN_DIR . 'includes/class-shortcodes.php';
require_once CPT_PLUGIN_DIR . 'includes/class-widgets.php';

//Load up custom classes
require_once CPT_PLUGIN_DIR . 'includes/class-breadcrumbs.php';
require_once CPT_PLUGIN_DIR . 'includes/class-atoz.php';
require_once CPT_PLUGIN_DIR . 'includes/class-texttopdf.php';
require_once CPT_PLUGIN_DIR . 'includes/class-printpage.php';
require_once CPT_PLUGIN_DIR . 'includes/class-savearticle.php';
require_once CPT_PLUGIN_DIR . 'includes/class-emailarticle.php';


// Register javascript
wp_register_script('carepoint_script', plugins_url('assets/js/cpt-script.js', __FILE__), array('jquery'),'1.1', true);

// Localize the script with new data
// To make it easy for JS to access wordpress URLs ^_^
$site_parameters = array(
    'site_url' => get_site_url(),
    'ajax_url' => admin_url( 'admin-ajax.php' ),
    'theme_directory' => get_template_directory_uri()
    );

wp_localize_script( 'carepoint_script', 'wp_js_object', $site_parameters );

// Enqueued script with localized data.
wp_enqueue_script( 'carepoint_script' );

// Activate plugin
register_activation_hook( __FILE__, 'carepoint_activation' );
function carepoint_activation()
{
	global $wpdb;

	// Create Post Ratings Table
	$create_sql = "CREATE TABLE $wpdb->cp_save_article (".
					"cp_sa_id int(11) NOT NULL AUTO_INCREMENT,".
					"cp_sa_postid int(11) NOT NULL,".
					"cp_sa_userid int(11) NOT NULL,".
					"cp_sa_posttype text NOT NULL,".
					"cp_sa_timestamp varchar(15) NOT NULL,".
					"cp_sa_ip varchar(40) NOT NULL,".
					"PRIMARY KEY (cp_sa_id))";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $create_sql );

	add_option( 'carepoint_functions', CPT_VERSION_NUMBER );
}
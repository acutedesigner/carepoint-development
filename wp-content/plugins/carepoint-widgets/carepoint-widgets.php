<?php
/*
Plugin Name: Carepoint Functions
Plugin URI: http://www.acumendesign.co.uk
Description: A collections of features and function exclusive for the Havering Care Point Website
Version: 1.0
Author: @acute_designer
Author http://www.acumendesign.co.uk
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit;

define("CPT_VERSION_NUMBER", "0.1");
define("CPT_PLUGIN_DIR", plugin_dir_path(__FILE__)); 

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


// Register the script
wp_register_script('carepoint_script', plugins_url('assets/cpt-script.js', __FILE__), array('jquery'),'1.1', true);

// Localize the script with new data
// To make it easy for JS to access website URLs ^_^
$site_parameters = array(
    'site_url' => get_site_url(),
    'theme_directory' => get_template_directory_uri()
    );

wp_localize_script( 'carepoint_script', 'object_name', $site_parameters );

// Enqueued script with localized data.
wp_enqueue_script( 'carepoint_script' );
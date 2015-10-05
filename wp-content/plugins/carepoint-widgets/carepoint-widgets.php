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

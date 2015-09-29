<?php

/*
 Plugin Name: Plugin School
 Plugin URI: http://www.acumendesign.co.uk
 Description: A new plugin
 Version: 0.0.6
 Author: Nigel M Peters
 Author URI: @acute_designer
 */

if(!class_exists('pluginSchool')){

class pluginSchool
{

	const PREFIX = 'pS';
	private $pluginURL;

	function __construct()
	{
		$this->pluginURL = plugins_url(basename(dirname(__FILE__)));
		add_action('init', array($this, 'initThis'));
	}

	function initThis()
	{
		add_option(self::PREFIX.'dateTodayFormat', 'd M Y');
		add_shortcode('dateToday', array($this,'dateFormatter'));
		add_action('admin_init', array($this, 'registerSettings'));
		add_action('admin_menu', array($this, 'addSettingsMenuItem'));
		add_action('admin_enqueue_scripts', array($this, 'addSettingsPageJS'));	
	}

	function addSettingsPageJS($hook)
	{
		if('settings_page'.self::PREFIX.'settingsPage' != $hook) return;
		wp_enqueue_script(self::PREFIX.'settingJS', $this->pluginURL.'/settings.js');
	}

	function registerSettings()
	{
		register_setting(self::PREFIX.'Settings', self::PREFIX.'dateTodayFormat');
	}

	function addSettingsMenuItem()
	{
		add_submenu_page(
			'options-general.php',
			'pluginSchool Settings', // Page title
			'pluginSchool', // Menu title
			'manage_options', // user rights
			self::PREFIX.'settingsPage', // page slug
			array($this, 'showSettingsPage')
		);
	}

	function showSettingsPage()
	{
		include 'settings.php';
	}

	function dateFormatter($atts, $content = null)
	{
		extract(
			shortcode_atts(
				array(
					'format' => get_option(self::PREFIX.'dateTodayFormat')
				),
				$atts
			)
		);

		return date($format);
	}

} // Class pluginSchool

$pluginSchool = new pluginSchool();

}
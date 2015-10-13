<?php

/*

Plugin Name: Event Plugin
Author Name: NM Peters
Plugin Uri: @acutedesigner
Description: Event plugin for Cron Jobs
Version: 1.1

 */

$time = wp_next_scheduled('jw_cron_hook');

wp_unschedule_event($time, 'jw_cron_hook');

add_action('init', function(){

	if(!wp_next_scheduled('jw_cron_hook'))
	{
		wp_schedule_event(time(), 'two-minutes', 'jw_cron_hook');
	}

});

add_action('jw_cron_hook', function(){

	$str = time();
	wp_mail('nigel@acumendesign.co.uk','For nigel Peters',"This is an email");

});

add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
	add_options_page('Cron Settings','Cron Settings', 'manage_options', 'jw-cron', function()
	{

		$cron = _get_cron_array();
		$schedule = wp_get_schedules();

		?>
		<h2>yo Yo YO!</h2>

		<?php print_r($schedule); die;

			foreach ($cron as $time => $hook) {
				echo "<h1>".$time."</h1>";
				print_r($hook);
			}

	});
}


add_filter('cron_schedule', function($schedules){

	$schedules['two-minutes'] = array(

			'interval' => 120,
			'display' => 'Every two minutes'

	);

	return $schedules;

});
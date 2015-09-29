<?php

error_reporting(E_ALL);

/*

	Plugin Name: Informer
	Plugin URI: Http://www.acumendesign.co.uk
	Description: This is a widget plugin
	Author: Nigel Peters
	Version: 1.0 

 */

class Informer extends WP_Widget{


	function __construct()
	{
		$options = array(

			'description' => 'This is a simple widget',
			'name' => 'Informer'

		);

		parent::__construct('Informer', '', $options);
	}

	function form($atts)
	{
		extract($atts);

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input	class="widefat"
					id="<?php echo $this->get_field_id('title'); ?>"
					name="<?php echo $this->get_field_name('title') ?>"
					value="<?php if(isset($title)) echo esc_attr($title); ?>"
					type="text"
			>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>">Description:</label>
			<textarea	class="widefat"
					id="<?php echo $this->get_field_id('description'); ?>"
					name="<?php echo $this->get_field_name('description') ?>"
					rows="10"
			><?php if(isset($description)) echo esc_attr($description); ?></textarea>
		</p>

		<?php
	}

	function widget($args, $instance)
	{
		extract($args);
		extract($instance);

		echo $before_widget;

		echo $before_title . $title . $after_title;
		echo $description;

		echo $after_widget;
	}

}

add_action('widgets_init', 'jw_register_messenger');

function jw_register_messenger()
{
	register_widget('Informer');
}
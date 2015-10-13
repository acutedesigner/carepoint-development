<?php

/*

Plugin Name: Options Plugin
Author Name: NM Peters
Plugin Uri: @acutedesigner
Description: Plugin for option page in the control panel
Version: 1.1

 */

class OptionsPage
{

	public $options;

	public function __construct()
	{
		$this->options = get_option('Settings-options');
		$this->register_settings();
	}

	public static function add_menu_page()
	{
		add_options_page('Uploader', 'Uploader', 'administrator', __FILE__, array('OptionsPage', 'options_page'));
	}

	public function options_page()
	{
		?>
			<div id="wrap">
				<form name="options" method="post" action="options.php" enctype="multipart/form-data">

					<?php settings_fields('Settings-options'); ?>
					<?php do_settings_sections(__FILE__); ?>
					
					<p class="submit">
						<input type="submit" name="submit" value="Submit Options" class="button-primary">						
					</p>

				</form>
			</div>
		<?php		
	}

	public function register_settings()
	{
		register_setting('Settings-options', 'Settings-options');

		add_settings_section('Options_id', 'Settings', array( $this, 'Options_cb'), __FILE__);
		add_settings_field('Options_Page_Settings', 'Name', array($this, 'Drop_Down_Header_Options'), __FILE__, 'Options_id');
		add_settings_field('Options_Page_Settings_1', 'Image', array($this, 'Drop_Down_Header_Options_image'), __FILE__, 'Options_id');
	}

	public function Options_cb()
	{

	}

	// Inputs
	public function Drop_Down_Header_Options()
	{
		echo '<input name="Settings-options[Option_Page_Settings]" type="text" value="'.$this->options['Options_Page_Settings'].'" />';
	}

	public function Drop_Down_Header_Options_image()
	{
		echo '<input type="file" />';		
	}
}

add_action('admin_menu', function(){

	OptionsPage::add_menu_page();

});

add_action('admin_init', function(){

	New OptionsPage;

});
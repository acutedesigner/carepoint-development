<?php

class CPT_Widgets_Admin
{

	public function __construct()
	{
		//add_action('init', array($this, 'add_caps') );
		add_action( 'add_meta_boxes', array($this, 'add_meta_box'), 20 );
	}

	public function add_caps() {
		$caps_version = '1.1';

		// did we add the caps already?
		if( version_compare(get_option('wywi_caps_version', 0), $caps_version, '>=') ) {
			return;
		}
		
		$role = get_role('administrator');
		$role->add_cap('edit_widget_block');
		//update_option('wywi_caps_version', $caps_version);
	}

	public function add_meta_box()
	{
		add_meta_box( 
        'wysiwyg-widget-donate-box',
	        __('More..', 'wysiwyg-widgets'),
	        array($this, 'meta_donate_box'),
	        'wysiwyg-widget',
	        'side',
            'low'
	    );
	}

	public function register_widget()
	{
		register_widget('CPT_Widgets_Widget');  
	}

	public function meta_donate_box($post)
	{
		?>
			<div>
				<h4><?php echo 'And now?'; ?></h4>
				<p><?php printf(__('Show this widget block by going to your %swidgets page%s and then dragging the WYSIWYG Widget to one of your widget areas.', 'wysiwyg-widgets'), '<a href="'. admin_url('widgets.php') .'">', '</a>'); ?></p>
			</div>

		<?php
	}
}
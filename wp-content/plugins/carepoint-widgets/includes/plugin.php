<?php

function cpt_register_widget() {
	require_once CPT_PLUGIN_DIR . 'includes/class-widget.php';
	register_widget('CPT_Textbox_Widget');
	register_widget('CPT_Category_Block');
}

add_action( 'widgets_init', 'cpt_register_widget');

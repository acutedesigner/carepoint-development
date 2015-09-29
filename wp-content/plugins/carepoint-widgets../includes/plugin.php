<?php

function cpt_register_widget() {
	require_once TAP_PLUGIN_DIR . 'includes/class-widget.php';
	register_widget('CPT_Widgets_Widget');
}

add_action( 'widgets_init', 'cpt_register_widget');

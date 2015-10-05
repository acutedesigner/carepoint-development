<?php

/*

	Plugin Name: Shortcode tutorial
	Author Name: Nigel M Peters
	Description: A shortcode Plugin
	Version: 0.1

 */

add_shortcode('google', function($atts){

	return '<a href="http://www.twitter.com/'.$atts['username'].'">Visit Google</a>';

});
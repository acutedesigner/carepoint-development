<?php
/**
 *
 *  Template Name: Site map
 *
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Matt Everson of Astuteo, LLC – http://astuteo.com/slickmap" />
	<title>Havering Carepoint - Sitemap</title>
	<link rel="stylesheet" type="text/css" media="screen, print" href="<?php bloginfo('template_url'); ?>/slickmap/slickmap.css" />
</head>

<body>

	<div class="sitemap">
		
		<h1>Havering Carepoint</h1>
		<h2>Preliminary Site Map &mdash; Version 1.0</h2>

<!-- 		<?php wp_nav_menu( array('theme_location' => 'header_menu', 'container' => '', 'menu_id' => 'utilityNav')); ?>
 -->		<?php wp_nav_menu( array('theme_location' => 'primary_menu', 'container' => '', 'menu_class' => 'col5 main-menu', 'menu_id' => 'primaryNav')); ?>

	</div>
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.js" ></script>
	<script>

		$( document ).ready(function() {
    		
			$('.main-menu').prepend( "<li id='home'><a href=''>Home</a></li>" );

		});

	</script>

</body>

</html>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title><?php wp_title(''); ?></title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/main.css" media="all" />
		<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/font-awesome.min.css" media="all" />	

		<script src="<?php bloginfo("template_directory"); ?>/library/js/modernizr.js"></script>

		<!--[if IE 8]>
			<script src="<?php bloginfo("template_directory"); ?>/library/js/selectivizr-min.js"></script>
			<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/ie.css" media="all" />
		<![endif]-->

		<?php wp_enqueue_script('jquery'); ?>
		<?php wp_head(); ?>

	</head>
	<body  <?php body_class(); ?> >
		<div class="wrapper">

			<header class="header" role="banner">
				<div class="logo">
					<a href="<?php bloginfo("url"); ?>"><img src="<?php bloginfo("template_directory"); ?>/library/images/carepoint-logo.png" alt="Care Point Logo" /></a>
				</div>
				<nav class="header-nav">
					<ul>
						<li><a href="#">Contact Us</a></li>
						<li><a class="atoz-toggle" href="#">A to Z</a></li>
						<li><a href="#">Translate</a></li>
						<li><a class="tooltip" title="Text to speech" href="#"><i class="fa fa-volume-up"></i></a></li>		
						<li><a class="tooltip" title="Your saved articles" href="#"><i class="fa fa-list-ul"></i></a></li>		
						<li><a class="tooltip search-toggle" title="Search" href="#"><i class="fa fa-search"></i></a></li>		
					</ul>
				</nav>
		</header>
			<!-- End .header -->

			<nav class="primary-nav" id="nav">
				<ul class="mini-menu">
					<li><a href="#"><i class="fa fa-volume-up"></i></a></li>
					<li><a href="#"><i class="fa fa-list-ul"></i></a></li>
					<li><a class="search-toggle" href="#"><i class="fa fa-search"></i></a></li>
				</ul>
				<a class="to-main-nav" href="#main-nav">Menu <i class="fa fa-bars"></i></a>

				<?php wp_nav_menu( array('theme_location' => 'primary_menu', 'container' => 'false', 'menu_id' => 'primary-nav')); ?>

			</nav>
			<!-- end .nav-->

			<div class="block-form">
				<div class="container">
					<form action="#">
						<div class="search-form-select">
							<label>I am looking for:</label>
							<select class="select-style" name="" id="">
								<option value="2">Care Advice</option>
								<option value="1">Care Services</option>
							</select>
						</div>
						<div class="search-form-input">
							<input type="search" name="" placeholder="Your search term">
						</div>
						<div class="search-form-submit">
							<input type="submit" class="btn red-grad" value="Search">
						</div>
					</form>
				</div>
			</div>
			<!-- end .block-form -->
				
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title><?php
		/*
		* Print the <title> tag based on what is being viewed.
		*/
		global $page, $paged;
		 
		wp_title( '|', true, 'right' );
		 
		// Add the blog name.
		bloginfo( 'name' );
		 
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		 
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'shape' ), max( $paged, $page ) );
		 
		?></title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/main.css" media="all" />
		<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/font-awesome.min.css" media="all" />	
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="all" />	

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

			<header class="header">
				<div class="logo">
					<a href="<?php bloginfo("url"); ?>"><img src="<?php bloginfo("template_directory"); ?>/library/images/carepoint-logo.png" alt="Care Point Logo" /></a>
				</div>
				<nav class="header-nav">
					<ul class="mini-menu">
						<li><a class="tooltip" title="Contact Us" href="<?php echo home_url( '/contact-us' ) ?>">Contact Us</a></li>		
						<li><a class="tooltip atoz-toggle" title="A to Z" href="#">A to Z</a></li>		
						<?php echo cp_view_bookmarks_button(); ?>
						<li><a class="tooltip search-toggle" title="Search" href="#"><i class="fa fa-search"></i></a></li>		
					</ul>
				</nav>
			</header>
			<!-- End .header -->

			<nav class="primary-nav" id="nav">
				<ul class="mini-menu">
					<li><a class="tooltip" title="Contact us" href="<?php echo home_url( '/contact-us' ) ?>"><i class="fa fa-phone"></i></a></li>		
					<li><a class="tooltip atoz-toggle" title="A to Z" href="#"><i class="fa fa-book"></i></a></li>		
					<li><a class="tooltip" title="Browse Aloud" href="#"><i class="fa fa-headphones"></i></a></li>		
					<?php echo cp_view_bookmarks_button(); ?>
					<li><a class="tooltip search-toggle" title="Search" href="#"><i class="fa fa-search"></i></a></li>		
				</ul>
				<a class="to-main-nav" href="#main-nav">Menu <i class="fa fa-bars"></i></a>

				<?php wp_nav_menu( array('theme_location' => 'primary_menu', 'container' => 'false', 'menu_id' => 'primary-nav')); ?>

			</nav>
			<!-- end .nav-->

			<?php get_atoz_menu(); ?>

			<?php
				$post_type = ( $_REQUEST['search_type'] ? $_REQUEST['search_type'] : NULL );
				$term = ( get_query_var('s') ? get_query_var('s') : NULL );
			?>			
			<div class="block-form" <?php echo ( is_search() || is_404() ? 'style="display: block;"' : NULL ); ?>>
				<div class="container">
					<form method="get" action="<?php bloginfo("url"); ?>">
						<div class="search-form-select">
							<label>I am looking for:</label>

							<?php
								// This is to allow the search form to pre-populate the users search parameters
								$search_options[] = array( 'post_type' => 'everything', 'post_type_name' => 'Any Information' );
								$search_options[] = array( 'post_type' => 'care_advice', 'post_type_name' => 'Care Advice' );
								$search_options[] = array( 'post_type' => 'care_services', 'post_type_name' => 'Care Services' );
							?>
							<select class="select-style" name="search_type">
							<?php foreach( $search_options as $options ):?>
								<option <?php echo ( $options['post_type'] == $post_type ? "selected" : NULL); ?> value="<?php echo $options['post_type']; ?>"><?php echo $options['post_type_name']; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
						<div class="search-form-input">
							<input type="search" name="s" id="s" <?php echo ( get_query_var('s') ? 'value="'.get_query_var('s').'"' : NULL ) ?> placeholder="Your search term">
						</div>
						<div class="search-form-submit">
							<input type="submit" class="btn red-grad" value="Search">
						</div>
					</form>
				</div>
			</div>
			<!-- end .block-form -->
				
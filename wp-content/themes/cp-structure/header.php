<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Care Point Framework</title>

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/normalize.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/skeleton.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/main.css">

</head>
<body>

<div class="container">
	<div class="row">

    <h1>Care Point Framework</h1>

		<?php wp_nav_menu( array('theme_location' => 'main_menu', 'container' => 'nav', 'menu_class' => 'nav navbar-nav')); ?>

      <form method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>" >
        <input class="u-full-width" type="email" placeholder="Search" value="<?php get_search_query(); ?>" name="s" id="s">

        <input class="button-primary" type="submit" value="Search">

    </form>
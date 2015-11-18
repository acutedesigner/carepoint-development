<?php $the_post = get_post(get_query_var('cppp_post_id')); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title><?php echo $the_post->post_title; ?></title>

		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/main.css" media="all" />
		<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/font-awesome.min.css" media="all" />	
		<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/print.css" media="all" />

		<script src="<?php bloginfo("template_directory"); ?>/library/js/modernizr.js"></script>

		<!--[if IE 8]>
			<script src="<?php bloginfo("template_directory"); ?>/library/js/selectivizr-min.js"></script>
			<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/css/ie.css" media="all" />
		<![endif]-->

		<?php wp_head(); ?>

	</head>
	<body  <?php body_class(); ?> >
	<div class="container">
		<img src="<?php bloginfo("template_directory"); ?>/library/images/carepoint-logo.png" alt="Care Point Logo" />

		<hr />
		<article class="text"	>
		<?php
			echo '<h1>'.$the_post->post_title.'</h1>';
			echo apply_filters('the_content', $the_post->post_content);
		?>
		</article>
		<div class="block-info">
			<small>This article is sourced from:</small>
			<?php echo get_permalink($the_post->ID); ?>
		</div>

		<?php if(get_field('nhs_choices') != ""): ?>
		<div class="nhs-choices-label">
			<small>This article is sourced from:</small>
			<img src="<?php bloginfo("template_url"); ?>/library/images/nhs-choices-logo.jpg" alt="NHS Choices">
		</div>
		<?php endif; ?>
	</div>


	</body>
</html>
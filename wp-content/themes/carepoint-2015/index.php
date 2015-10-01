<?php get_header(); ?>
	<!-- FOR CAROUSEL -->
	<div class="container">
		<ul class="bxslider">
			<li><img src="<?php bloginfo('template_url'); ?>/library/images/slider-image-1.jpg" /></li>
			<li><img src="<?php bloginfo('template_url'); ?>/library/images/slider-image-2.jpg" /></li>
			<li><img src="<?php bloginfo('template_url'); ?>/library/images/slider-image-3.jpg" /></li>
		</ul>
	</div>

	<div class="two-column-grid">

		<?php dynamic_sidebar( 'homepage_text_blocks' ); ?>

	</div>
	
	<!-- END OF INTRO BLOCK -->
	<div class="four-up-grid">
		
		<?php dynamic_sidebar( 'homepage_category_blocks' ); ?>

	</div>
	<!-- end 4up -->
	<?php get_footer(); ?>
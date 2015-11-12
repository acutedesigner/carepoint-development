<?php get_header(); ?>

	<!-- FOR CAROUSEL -->
	<div class="carousel">
		<ul class="bxslider">
			<?php dynamic_sidebar( 'homepage_carousel_items' ); ?>
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
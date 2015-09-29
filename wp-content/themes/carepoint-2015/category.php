<?php get_header(); ?>

	<div class="left column">
		<?php 

			$category = $wp_query->get_queried_object();

		?>

		<h1>Category: <?php echo $category->name ?></h1>	
		<ul>
		<?php

			$cat_pages = query_posts( array(
				'cat'		=> $wp_query->get_queried_object_id(),
				'post_type'	=> 'page',
				'post_status'	=> 'publish',
				'orderby'		=> 'menu_order',
				'order' => 'ASC',
				'posts_per_page'=>-1, 
    			'numberposts'=>-1
			));
			
		?>

		<?php

		if( have_posts() ):
			while ( have_posts() ) : the_post();
			    echo '<li><a href="'.get_the_permalink().'">';
			    the_title();
			    echo '</a></li>';
			endwhile;
			else:
		?>
		<h1>No Articles available under this category</h1>
	<?php endif; ?>
		</ul>
	</div>

<?php get_footer(); ?>

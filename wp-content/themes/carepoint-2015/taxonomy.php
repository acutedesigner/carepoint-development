<?php
/**
* A Simple Category Template
*/

get_header(); ?> 

	<?php

		/*	
		*	We need to determine if the current category has a parent.
		*	If it does not then it is a landing page
		*	If it does then it is a category article listing page
		*/

		$current_category = get_queried_object();

		if($current_category->parent == 0):
		
		$args = array(
		    'orderby'           => 'name', 
		    'order'             => 'ASC',
		    // 'hide_empty'        => false, 
		    'child_of'          => $current_category->term_id
		); 

		$terms = get_terms($current_category->taxonomy, $args);

	?>

	<div class="container">
		
		<?php the_breadcrumb(); ?>

		<div class="block block-intro">
			<div class="text-block">
				<h1 class="b-title"><?php single_cat_title( '', true ); ?></h1>
				<p><?php echo category_description(); ?></p>
			</div>
			<div class="thumb-block">
				<img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(NULL, 'landscape-4x3'); ?>" />
			</div>
		</div>

	</div><!-- end of .container -->

	<?php $div = 0; if($terms): ?>

	<?php foreach($terms as $term): ?>

	<?php if( $div % 3 == 0): echo '<div class="three-up-grid">'; endif; ?>

	<?php if($div == 0): echo '<h2 class="section-header">Categories</h2>'; endif; ?>

	<?php $term_link = get_term_link( $term ); ?> 

		<div class="grid">
			<div class="block block-service-link">
				<div class="text-block-green">
					<h2><?php echo $term->name; ?></h2>
					<!-- <p><?php echo $term->description; ?></p> -->
				</div>
				<a href="<?php echo $term_link; ?>">View articles <i class="fa fa-angle-double-right"></i></a>
			</div>
		</div>

	<?php if( $div % 3 === 2): echo '</div>'; endif; ?>
	<?php if( count($terms) === $div && $div % 3 != 2): echo '</div>'; endif; ?>

	<?php $div++; endforeach; ?>	

	<!-- end of .three-up-grid -->

	<?php endif; // endif $terms; ?>

	<?php

		/*
		*	If the current category does have a parent
		*	lets show the category article listing page
		*/

		else:

	?>

	<div class="container">
		
		<?php the_breadcrumb(); ?>

		<h1 class="b-title"><?php single_cat_title( '', true ); ?></h1>
		<hr>

	</div><!-- end of .container -->

	<div class="two-column-grid container">
		<div class="left-column">

	<?php

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$category = get_query_var('care-advice-categories');
		$args = array('paged' => $paged, 'care-advice-categories' => $category, 'orderby' => 'menu_order', 'order' => 'asc' );

		$cp_query = new WP_Query( $args );

		global $wp_query;
		// Put default query object in a temp variable
		$tmp_query = $wp_query;
		// Now wipe it out completely
		$wp_query = null;
		// Re-populate the global with our custom query
		$wp_query = $cp_query;

		while ( $cp_query->have_posts() ) : $cp_query->the_post();

		// Setup the class if the post has a thumbnail image
		$class = (has_post_thumbnail() ? "block-article-image" : "block-article");

	?>

			<article class="block <?php echo $class ?>">
				
				<div class="text-block">
					<h2 class="b-title"><a href="<?php the_permalink(); ?>" class="b-inner"><?php the_title(); ?></a></h2>
					<p><?php the_excerpt(); ?></p>
				</div>

	<?php if ( has_post_thumbnail() ) { ?>
				<div class="thumb-block">
					<img src="<?php bloginfo("template_directory"); ?>/library/images/fpo_4x3.png" alt="4x3 Image" />
				</div>
	<?php } ?>

				<?php if ($term_list = wp_get_post_tags($post->ID, array("fields" => "all"))): ?>
				<div class="tag-block">
					<small>Article tags:</small>
					<div class="article-tags">
					<?php foreach($term_list as $term): ?>
						<a href="<?php echo get_atoz_letter_link($term->slug); ?>"><?php echo ucfirst($term->name); ?></a>
					<?php endforeach; ?>
					</div>
				</div>	
				<?php endif; ?>
			</article>			

	<?php endwhile; // End the loop. Whew. ?>
	<?php kriesi_pagination(); ?>
	<?php wp_reset_postdata(); ?>
	<?php // Restore original query object
			$wp_query = null;
			$wp_query = $tmp_query;
	?>

		</div><!-- end of .left-column -->
		<div class="right-column">
	<?php

		$args = array(
		    'orderby'           => 'name', 
		    'order'             => 'ASC',
		    'hide_empty'        => false, 
		    'child_of'          => $current_category->parent
		); 

		$terms = get_terms($current_category->taxonomy, $args);

	?>

		<section class="section related-posts">
			<h2 class="section-header">Related categories</h2>
			<ul class="headline-list">
	<?php
			foreach($terms as $term)
			{
				$term_link = get_term_link( $term );
				echo "<li><h3><a href='". $term_link ."'>". $term->name ."</a></h3></li>";
			}

	?>		
			</ul>
		</section>

		</div><!-- end of .right-column -->
	</div>

	<?php endif; // End the category article listings ?>


<?php get_footer(); ?>
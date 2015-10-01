<?php
/**
* A Simple Category Template
*/

get_header(); ?> 

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
		    'hide_empty'        => false, 
		    'child_of'          => $current_category->term_id
		); 

		$terms = get_terms($current_category->taxonomy, $args);

	?>

	<?php $div = 0; if($terms): ?>

	<?php foreach($terms as $term): ?>

	<?php if( $div % 3 == 0): echo '<div class="three-up-grid">'; endif; ?>

	<?php if($div == 0): echo '<h2 class="section-header">Categories</h2>'; endif; ?>

	<?php $term_link = get_term_link( $term ); ?> 

		<div class="grid">
			<div class="block block-service-link">
				<div class="text-block-blue">
					<h2><?php echo $term->name; ?></h2>
					<!-- <p><?php echo $term->description; ?></p> -->
				</div>
				<a href="<?php echo $term_link; ?>">View services <i class="fa fa-angle-double-right"></i></a>
			</div>
		</div>

	<?php if( $div % 3 === 2): echo '</div>'; endif; ?>
	<?php if( count($terms) === $div && $div % 3 != 2): echo '</div>'; endif; ?>

	<?php $div++; endforeach; ?>	

	<!-- end of .three-up-grid -->

	<?php endif; ?>

	<?php

		/*
		*	If the current category does have a parent
		*	lets show the category article listing page
		*/

		else:

	?>

	<div class="two-column-grid container">
		<div class="left-column">

	<?php

		$args = array (
			'post_type'              => array( 'care-services' ),
			'tax_query' 			 => array( 'taxonomy' => $current_category->taxonomy ),
			'pagination'             => true,
			'posts_per_page'         => '10',
			'orderby'                => 'menu_order',
			'order' => 'ASC'
		);

		$the_query = new WP_Query( $args );

		while ( have_posts() ) : the_post();

		// Setup the class if the post has a thumbnail image
		$class = (has_post_thumbnail() ? "block-article-image" : "block-article");

	?>

		<div class="block block-directory-service">
			<div class="header-block">
				<h2><?php the_title(); ?></h2>
				<div class="btn-group">
					<a href="#"><i class="fa fa-plus-circle"></i></a>
					<a href="#"><i class="fa fa-envelope-o"></i></a>
				</div>
			</div>

			<div class="two-up-grid">
				<div class="grid">
					<p>106a North Street,<br/> 
					Hornchurch, Essex, RM11 1SU<br/> 
					<strong>Tel:</strong> 01708 478712<br/> 
					<strong>Fax:</strong> 0844 871 7023</p>
				</div>
				<div class="grid">
					<p>
						<strong>Email:</strong><br/>
						<a href="#">hornchurch@acromashealthcare.com</a><br/>
						<strong>Branch Manager:</strong><br/>
						Laurence Brown
					</p>
				</div>		
			</div>
			<p>At Allied Healthcare, we care for more people at home than anyone else. We know that enabling people to continue living in the place they feel most comfortable can help them enjoy healthier, more fulfilling lives.</p>

			<div class="tag-block">
				<small>Article tags:</small>
				<div class="article-tags">
					<a href="#">Health care</a>
					<a href="#">Medicine</a>
					<a href="#">tablets</a>
				</div>
			</div>	
		</div>

	<?php endwhile; // End the loop. Whew. ?>


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
			<h2 class="section-header">Directory Service Categories</h2>
			<div class="directory-service-list">
			<?php foreach($terms as $term): $term_link = get_term_link( $term ); ?>
				<a href="<?php echo $term_link; ?>">
					<?php echo $term->name ?>
					<small>Services available: 9</small>
				</a>
			<?php endforeach; ?>
			</div>

		</section>

		</div><!-- end of .right-column -->
	</div>

	<?php endif; // End the category article listings ?>


<?php get_footer(); ?>
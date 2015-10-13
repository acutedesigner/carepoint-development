	<div class="container">
		
		<?php the_breadcrumb(); ?>

		<h1>Term: <?php echo ucfirst(get_query_var('term')); ?></h1>
		<hr />
	</div>

	<div class="container">

	<?php

		$query = new WP_Query( array(
			"post_type" => array( 'care-advice' ),
			"tag" => get_query_var('term'), 
			"posts_per_page" => -1
		) );

	?>

	<?php while ($query->have_posts()) : $query->the_post();

		// Setup the class if the post has a thumbnail image
		$class = (has_post_thumbnail() ? "block-article-image" : "block-article");

	?>

		<article class="block <?php echo $class ?>">
			
			<div class="text-block">
				<h2 class="b-title"><a href="<?php the_permalink(); ?>" class="b-inner"><?php the_title(); ?></a></h2>
				<p><?php the_excerpt(); ?></p>
			</div>

		</article>			

	<?php endwhile; ?>
	</div>

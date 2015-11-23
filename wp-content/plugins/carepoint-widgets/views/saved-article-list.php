	<div class="container">
		
		<?php the_breadcrumb(); ?>

		<h1>Your saved articles</h1>
		<hr />
	</div>

	<div class="two-column-grid container">

		<div class="left-column">
		<?php

		if(count($userposts) > 0):

			$args = array('post_type' => 'care-advice', 'order' => 'asc', 'post__in' => $userposts );

			$posts = query_posts( $args );

			$nonce = wp_create_nonce("cp_bookmark_article_nonce");

		if ( have_posts() ) :
		    while ( have_posts() ) : the_post(); ?>

			<article class="block block-directory-service">
				
				<div class="header-block">
					<h2 class="b-title"><a href="<?php the_permalink(); ?>" class="b-inner"><?php the_title(); ?></a></h2>
					<div class="btn-group">
						<a class="tooltip" title="Remove from saved article" href="<?php echo site_url('/savearticle/unbookmark/'.get_the_ID().'/'.$nonce) ?>"><i class="fa fa-trash"></i></a>
					</div>
				</div>
				<p><?php the_excerpt(); ?></p>

			</article>			

		    <?php endwhile;?>
		<?php endif; ?>

		<?php else: ?>
			<article class="block">
				<h2>Sorry you have no saved articles</h2>
			</article>
		<?php endif; ?>
			
		</div>

	</div>
<?php get_header(); ?> 

	<div class="container">
		
		<?php the_breadcrumb(); ?>

	</div>

		<div class="two-column-grid">
			<article class="left-column text">

				<?php if(have_posts()): while ( have_posts() ) : the_post(); ?>

				<h1><?php the_title(); ?></h1>	
				<?php the_content(); ?>

				<?php endwhile; else: // End the loop. Whew. ?>
					<h1>Sorry No article here</h1>
				<?php endif; ?>

			</article>			
				
			<aside class="right-column">

				
				<?php if(get_field('nhs_choices') != ""): ?>
				<div class="nhs-choices-label">
					<small>This article is sourced from:</small>
					<img src="<?php bloginfo("template_url"); ?>/library/images/nhs-choices-logo.jpg" alt="NHS Choices">
				</div>
				<?php endif; ?>
				
				<h2 class="section-header">Save &amp; Share</h2>
				<div class="social-share">
					<ul>
						<?php cp_bookmark_article_button($post->ID); ?>
						<?php cp_printpage_button($post->ID); ?>
						<?php cp_ttpdf_button($post->ID); ?>
						<li><a class="tooltip" title="Email this article" href="mailto:?subject=<?php echo htmlentities(get_the_title()); ?>&body=<?php echo htmlentities(get_the_permalink()); ?>%0A%0AFrom%20Carepoint"><i class="fa fa-envelope-o"></i></a></li>
						<li><a class="tooltip" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a class="tooltip" title="Share on Twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>

				<h2 class="section-header">Rate this article</h2>
				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

				<?php if ($term_list = wp_get_post_tags($post->ID, array("fields" => "all"))): ?>
				<h2 class="section-header">Article tags</h2>
					<div class="article-tags">
					<?php foreach($term_list as $term): ?>
						<a target="blank" href="<?php echo get_atoz_letter_link($term->slug); ?>"><?php echo ucfirst($term->name); ?></a>
					<?php endforeach; ?>
					</div>
				<?php endif; ?>

			<?php

				$related_advice = get_field('related_care_advice');
				if( $related_advice ){

			?>

				<section class="section related-posts">
					<h2 class="section-header">Related articles</h2>
					<ul class="headline-list">

			<?php

			foreach( $related_advice as $post ) {
			setup_postdata($post);

			?>

						<li><h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3></li>

			<?php } ?>
					</ul>
				</section>

			<?php } wp_reset_postdata(); ?>

			<?php

				$related_services = get_field('related_care_services');
				if( $related_services ){

			?>
				<h2 class="section-header">Related directory services</h2>
				<div class="directory-service-list">
			<?php foreach( $related_services as $post ){ ?>
					<a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
					</a>
			<?php } ?>
				</div>
			<?php } wp_reset_postdata(); ?>

			</aside>

		</div><!-- end of .two-up-grid -->

<?php get_footer(); ?> 
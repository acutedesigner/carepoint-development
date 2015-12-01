<?php get_header(); ?> 

	<div class="container">
		
		<?php the_breadcrumb(); ?>

	</div>

		<div class="two-column-grid">
			<article class="left-column text">

				<?php if(have_posts()): while ( have_posts() ) : the_post(); ?>

				<h1><?php the_title(); ?></h1>	
				<?php the_content(); ?>
				<?php if ( get_field('nhs_widget_code') ){ the_field('nhs_widget_code'); }?>
				<?php

				// Lets get the linked address if available
				$post_object = get_field('address_link');

				if( $post_object ): 

					// override $post
					$post = $post_object;
					setup_postdata( $post ); 

					?>
				    <div class="block block-contact-info">
				    	<h3><?php the_title(); ?></h3>
				    	<p>
				    	<?php 
				    		$address = ( get_field('address_line_1') ? get_field('address_line_1').'<br/>' : NULL);
				    		$address .= ( get_field('address_line_2') ? get_field('address_line_2').'<br/>' : NULL);
				    		$address .= ( get_field('address_line_3') ? get_field('address_line_3').'<br/>' : NULL);
				    		$address .= ( get_field('post_code') ? get_field('post_code') : NULL);
				    		echo $address;
				    	?>
				    	</p>
				    	<?php if(get_field('tel') || get_field('email')){ ?>
				    	<p>
				    	<?php
			    			$contact = ( get_field('tel') ? '<strong>Tel: </strong><a href="tel:'.get_field('tel').'">'.get_field('tel').'</a><br/>' : NULL);
			    			$contact .= ( get_field('email') ? '<strong>Email: </strong><a href="mailto:'.get_field('email').'">'.get_field('email').'</a>' : NULL);
			    			echo $contact;
						?>
				    	</p>
						<?php } ?>
				    </div>
				    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>

				<?php endwhile; else: // End the loop. Whew. ?>
					<h1>Sorry No article here</h1>
				<?php endif; ?>

			</article>			
				
			<aside class="right-column">

				
				<?php if(get_field('nhs_choices') != ""): ?>
				<div class="nhs-choices-label">
					<small>This content is sourced from:</small>
					<img src="<?php bloginfo("template_url"); ?>/library/images/nhs-choices-logo.jpg" alt="NHS Choices">
				</div>
				<?php endif; ?>

				<?php if(!is_page()): ?>				
				<h2 class="section-header">Save &amp; Share</h2>
				<div class="social-share">
					<ul>
						<?php cp_bookmark_article_button($post->ID); ?>
						<?php cp_printpage_button($post->ID); ?>
						<?php cp_ttpdf_button($post->ID); ?>
						<?php echo cp_emailarticle_button(); ?>
						<li><a class="tooltip" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a class="tooltip" title="Share on Twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>

				<?php cp_emailarticle_form($post->ID); ?>

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
				<?php endif; // end is_page() ?>
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
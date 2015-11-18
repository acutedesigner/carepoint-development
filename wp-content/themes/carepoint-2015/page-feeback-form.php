<?php
/**
 *
 *  Template Name: Feedback forms
 *
 */

get_header();

?>

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

			<div class="block block-service-link">
				<div class="text-block">
					<h2>Safeguarding</h2>
					<p>Short description consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</a>
				</div>
				<a href="http://www.havering.gov.uk/Pages/Category/Adult-protection.aspx" target="_blank">Access form <i class="fa fa-angle-double-right"></i></a>
			</div>

			<div class="block block-service-link">
				<div class="text-block">
					<h2>Request for social care contact:</h2>
					<p>Short description consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</a>
				</div>
				<a href="https://www.havering.gov.uk/Pages/OnlineForms/Carepoint.aspx" target="_blank">Access form <i class="fa fa-angle-double-right"></i></a>
			</div>

			<div class="block block-service-link">
				<div class="text-block">
					<h2>Site feedback: (NEED LINK)</h2>
					<p>Short description consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</a>
				</div>
				<a href="#" target="_blank">Access form <i class="fa fa-angle-double-right"></i></a>
			</div>

		</article>			
	</div>

<?php get_footer(); ?> 
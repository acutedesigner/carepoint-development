<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

    <div class="container">
		<h1 class="page-title"><?php _e( 'Not Found', 'twentythirteen' ); ?></h1>
        <hr />
    </div>

	<div class="two-column-grid">
		<article class="left-column text">
			<h2><?php _e( 'This is somewhat embarrassing, isn’t it?', 'twentythirteen' ); ?></h2>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>
		</article>			

		<aside class="right-column">

		</aside>
	</div>

<?php get_footer(); ?>
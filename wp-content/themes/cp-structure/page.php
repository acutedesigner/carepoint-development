<?php get_header(); ?>

	<div class="row">
    	<div class="eight columns">
			<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<?php if ( is_front_page() ) { ?>
				<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php } else { ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php } ?>

			<?php the_content(); ?>

			<?php endwhile; else: ?>
			<?php endif; wp_reset_query(); ?>    		
    	</div>

    	<div class="four columns">
    		<h2>Also in this category</h2>
    		<?php

    		$postId = $wp_query->get_queried_object_id();

$related = get_posts( array( 'category__in' => wp_get_post_categories($postId), 'numberposts' => 5, 'post_type' => 'page' ) );
if( $related ) foreach( $related as $post ) {
setup_postdata($post); ?>
 <ul> 
        <li>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </li>
    </ul>   
<?php }
wp_reset_postdata(); ?>
    	</div>
  	</div>

<?php get_footer(); ?>

<?php get_header(); ?>
		
<!-- COUNT RESULTS -->
<div class="results">
    <?php
    /* Search Count */
    $allsearch = &new WP_Query("s=$s&showposts=-1"); 
    $key = wp_specialchars($s, 1);
    $count = $allsearch->post_count; 
    _e('');
    _e('"<span class="search-terms">');
    echo $key;
    _e('</span>"'); 
    _e(' &mdash; found ');
    echo $count . ' '; 
    _e('articles');
    wp_reset_query(); ?>

</div>
<!-- / COUNT RESULTS -->

<?php if ($allsearch->have_posts()) : ?>
<?php while ($allsearch->have_posts()) : $allsearch->the_post(); ?>

	<!-- LIST RESULTS -->
	<section>   
	    <h3>
	        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to 
	        <?php the_title_attribute(); ?>"><?php the_title(); ?></a> - 
	        <span class="search-time"><?php the_time('F, j, Y') ?></span>
	    </h3>
	</section>
	<!-- / LIST RESULTS -->

<?php endwhile; else: ?>

<!-- 404 SEARCH -->
<div class="404-search">
<?php _e("Oops... We couldn't find what you were searching for. Please try again"); ?>
</div>
<!-- / 404 SEARCH -->

<?php endif; ?>

     </div>

<?php get_footer(); ?>


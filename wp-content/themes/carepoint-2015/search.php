<?php get_header(); ?>

<?php

/**
 * Use SearchWP's SWP_Query to perform a search using a supplemental engine
 */

$swp_query = new SWP_Query(
    array(
        's'      => $_REQUEST['s'],    // search query
        'engine' => $_REQUEST['search_type'], // search engine
    )
);

?>

    <div class="container">
        
        <div class="block block-intro">
            <h1 class="b-title">Showing results for <?php echo '"'.get_search_query().'"'; ?></h1>
            <h3><?php global $wp_query; echo 'There are '. $wp_query->found_posts.' care guidance results found.'; ?></h3>
        </div>

    </div><!-- end of .container -->

    <div class="two-column-grid container">
        <div class="left-column">

<?php

if ( ! empty( $swp_query->posts ) ) {
    foreach( $swp_query->posts as $post ) : setup_postdata( $post ); ?>
            <article class="block block-article">
                
                <div class="text-block">
                    <h2 class="b-title"><a href="<?php the_permalink(); ?>" class="b-inner"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                </div>
                
            </article>
    <?php endforeach; wp_reset_postdata();
} else {
    ?><p>No results found.</p><?php
}

?>

        </div><!-- end of .left-column -->
        <div class="right-column">
        
        <?php global $searchwp_categories; echo 'Relevanssi found ' . $wp_query->found_posts . ' hits in categories ' . implode(', ', $searchwp_categories) . '.'; ?>

        </div><!-- end of .right-column -->
    </div>


<?php get_footer(); ?>


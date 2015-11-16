<?php get_header(); ?>

<?php

/**
 * Use SearchWP's SWP_Query to perform a search using a supplemental engine
 */

if(isset($_REQUEST['cp_term']))
{
    $swp_query = new SWP_Query(
        array(
            's'      => $_REQUEST['s'],    // search query
            'engine' => $_REQUEST['search_type'], // search engine
            'posts_per_page' => 100,
            'tax_query' => array(       // tax_query support
                        array(
                            'taxonomy' => str_replace('_','-',$_REQUEST['search_type']) . '-categories',
                            'field'    => 'slug',
                            'terms'    => array( $_REQUEST['cp_term'] ),
                        ),
                    ),
        )
    );
}
else
{
    $swp_query = new SWP_Query(
        array(
            's'      => $_REQUEST['s'],    // search query
            'engine' => $_REQUEST['search_type'], // search engine
            'posts_per_page' => 100
        )
    );
}

?>

    <div class="container">
        <nav class="breadcrumbs"></nav>
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

            <section class="section related-posts">
                <h2 class="section-header">Filter results by category</h2>
                <ul class="headline-list">
                <?php

                    if(!isset($_REQUEST['cp_term']))
                    {
                        global $searchwp_categories;

                        foreach($searchwp_categories as $category)
                        {
                            echo "<li><h3><a href='". get_site_url() . '/?' . $_SERVER['QUERY_STRING'] . '&cp_term='. $category['cat-slug'] ."'>". $category['cat-name'] ."</a></h3></li>";
                        }
                    }
                    else
                    {
                        $url = explode("&cp_term", $_SERVER['QUERY_STRING']);
                        echo "<li><h3><a href='". get_site_url() . '/?' . $url[0] ."'>Show all results</a></h3></li>";
                    }
                ?>      
                </ul>

            </section>

        </div><!-- end of .right-column -->
    </div>


<?php get_footer(); ?>


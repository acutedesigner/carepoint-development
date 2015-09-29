<?php
/**
* A Simple Category Template
*/

get_header(); ?> 

<section id="primary" class="site-content">
<div id="content" role="main">

<?php
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$new_query = new WP_Query();
$new_query->query( 'showposts=1&cat='.$category_id.'&post_type=page&paged='.$paged );

?>

<?php 
// Check if there are any posts to display


echo "<h1>".print_r($categories)."</h1>";



if ( $new_query->have_posts() ) : ?>

<header class="archive-header">
<h1 class="archive-title">Category: <?php single_cat_title( '', false ); ?></h1>


<?php
// Display optional category description
 if ( category_description() ) : ?>
<div class="archive-meta"><?php echo category_description(); ?></div>
<?php endif; ?>
</header>

<?php

// The Loop
while ( $new_query->have_posts() ) : $new_query->the_post(); ?>
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>

<div class="entry">
<?php the_content(); ?>

 <p class="postmetadata"><?php
  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed');
?></p>
</div>

<?php endwhile; 

else: ?>

<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
</div>
</section>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
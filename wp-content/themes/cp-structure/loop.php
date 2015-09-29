<?php ?>
<section class="primary-content">
<?php $firstClass = 'first-post'; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
	<?php if ( ! have_posts() ) : ?>
        <article role="main" class="the-content">
            <h1><?php _e( '404 - I&#39;m sorry but the page can&#39;t be found' ); ?></h1>
            <p>Please try searching again or head back to the homepage.</p>
        </article>
    <?php endif; ?>
<?php ?>

    <h1>
        <?php if ( is_day() ) : ?><?php printf( __( '<span>Daily Archive</span> %s' ), get_the_date() ); ?>
        <?php elseif ( is_month() ) : ?><?php printf( __( '<span>Monthly Archive</span> %s' ), get_the_date('F Y') ); ?>
        <?php elseif ( is_year() ) : ?><?php printf( __( '<span>Yearly Archive</span> %s' ), get_the_date('Y') ); ?>
        <?php elseif ( is_category() ) : ?><?php echo single_cat_title(); ?>
        <?php elseif ( is_search() ) : ?><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?>
        <?php elseif ( is_home() ) : ?>Latest Posts<?php else : ?>
        <?php endif; ?>
    </h1>

<div class="latest-articles">

<?php while ( have_posts() ) : the_post(); ?>
	<?php /* How to display standard posts and search results */  ?>

        <article class="article-archive <?php echo $firstClass; ?>" id="post-<?php the_ID(); ?>">
			<?php $firstClass = ""; ?>
			<?php ?>
	            <?php the_post_thumbnail('news-home'); ?>
                <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                	<?php the_title(); ?></a></h2>

                <p><?php the_excerpt(); ?></p>

				<?php category_label(get_the_ID()); ?>

				<?php if(get_post_type( get_the_ID() ) == 'tribe_events'): ?>
					<p class="date"><?php echo "Event date: " . tribe_get_start_date(get_the_ID()); ?></p>
				<?php else: ?>
					<p class="date"><?php the_time('l, F jS, Y') ?></p>
				<?php endif; ?>
		</article>

		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

</div>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
    <ul class="navigation">
        <li class="older">
            <?php next_posts_link( __( 'Older posts' ) ); ?>
        </li> 
        <li class="newer">
            <?php previous_posts_link( __( 'Newer posts' ) ); ?>
        </li>
    </ul>
<?php endif; ?>
</section>

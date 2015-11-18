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


            </aside>

        </div><!-- end of .two-up-grid -->

<?php get_footer(); ?> 
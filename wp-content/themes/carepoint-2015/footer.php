		<div class="push"></div>
	</div><!--end .wapper-->

	<!-- Begin Footer -->
	<div class="contact-bar">
		<div class="container">
			<p>Get in touch with us on: <a href="tel:01708 776770">01708 776770</a> or online <a href="<?php echo site_url('/feedback-forms'); ?>" class="btn violet-grad">Feedback forms <i class="fa fa-commenting"></i></a></p>
		</div>
	</div>
	<footer class="footer">

<?php

    // Lets get the addresses for the footer

    $args = array(
            'post_type' => 'carepoint-adresses',
            'posts_per_page' => -1
        );
    $footer_query = new WP_Query($args);


    // We need to build a new array based on if
    // an addres has been choosen to be displayed on the footer
    $addresses = array();

    foreach ($footer_query->get_posts() as $post) {

        if(get_field('show_on_footer', $post->ID, false))
        {
            $addresses[] = $post;
        }
    }

    $count = count($addresses);

    switch ($count) {
        case 2:
            $class = 'two-up-grid';
            break;

        case 3:
            $class = 'three-up-grid';
            break;

        case 4:
            $class = 'four-up-grid';
            break;

        default:
            $class = 'container';
            break;
    }

    // Open the container
    echo '<div class="'.$class.'">';

    // This loop sets up the layout of the grid
    // depending on how many addresses need to be posted
    foreach ($addresses as $address) {

        echo ($count > 1 ? '<div class="grid">' : NULL);
        $break = ($count > 1 ? '<br>' : ', ' );
        $space = ($count > 1 ? '<br>' : '&nbsp;&nbsp;' );

        echo '          <h3>'.$address->post_title.'</h3>';
        echo '<p>';
        the_field('address_line_1', $address->ID);
        echo $break;
        the_field('address_line_2', $address->ID);
        echo $break;
        the_field('address_line_3', $address->ID);
        echo $break;
        the_field('post_code', $address->ID);
        echo '</p>';
        echo '<p>';
        echo '<p><strong>Tel: </strong>';
        the_field('tel');
        echo '<br>';
        echo '<strong>Email: </strong>';
        echo '<a href="mailto:'.get_field('email').'">'.get_field('email').'</a>';
        echo '</p>';
        echo ($count > 1 ? '</div>' : NULL);
}

    echo '</div>';

    wp_reset_postdata(); // reset the query

?>

	</footer>

	<div class="footer-logos">
		<div class="container">
		<h4>Our partners:</h4>
			<ul>
				<li><a href="https://www.havering.gov.uk/Pages/index.aspx" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-havering-council.jpg" alt=""></a></li>
				<li><a href="http://www.familymosaic.co.uk/home/index.html" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-family-mosaic.jpg" alt=""></a></li>
				<li><a href="http://www.nelft.nhs.uk" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-nelft-nhs.jpg" alt=""></a></li>
				<li><a href="http://www.healthwatch.co.uk" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-healthwatch.jpg" alt=""></a></li>
				<li><a href="http://www.haveringccg.nhs.uk" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-havering-ccg.jpg" alt=""></a></li>
			</ul>
		</div>
	</div>

	<nav class="footer-nav">
		<?php wp_nav_menu( array('theme_location' => 'footer_menu', 'container' => 'div', 'container_class' => 'container')); ?>
	</nav>
	<!-- End Footer -->

	<script type="text/javascript">var _baLocale = 'uk', _baUseCookies = true, _baMode = '<?php bloginfo("template_directory"); ?>/library/images/cp-browsealoud-logo.jpg', _baHiddenMode = false, _baHideOnLoad = false;</script>
	<script type="text/javascript" src="//www.browsealoud.com/plus/scripts/ba.js"></script>

	<script src="<?php bloginfo("template_directory"); ?>/library/js/jquery.tooltipster.min.js"></script>
	<script src="<?php bloginfo("template_directory"); ?>/library/js/bxslider/jquery.bxslider.min.js"></script>
	<link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/library/js/bxslider/jquery.bxslider.css" media="all" />
	<script src="<?php bloginfo("template_directory"); ?>/carepoint.js"></script>

		<?php wp_footer(); ?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-2744249-16', 'auto');
		  ga('send', 'pageview');

		</script>
	</body>

</html> <!-- end of site. what a ride! -->

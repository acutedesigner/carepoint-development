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
        echo '<a href="'.get_field('email').'">'.get_field('email').'</a>';
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
	<script>
		// You will need this for the menu toggle
		jQuery(document).ready(function($){
		
			//------ MAIN MENU ------//
			$('.to-main-nav').click(function(e) {
				e.preventDefault();
				$('#primary-nav').slideToggle();
			});
			$(window).resize(function(){
				var winwidth = $(window).innerWidth();
				if(winwidth > 900){
					$('#primary-nav').removeAttr("style");    
				}
			});

			//------ SEARCH FORM ------//
			$('.search-toggle').click(function(e) {
				e.preventDefault();
				$('.block-form').slideToggle();
			});
			
			$('.atoz-toggle').click(function(e){
				e.preventDefault();
				$('.block-atoz-index').slideToggle();
			});

			

			//------ EMAIL FORM ------//
			$('.email-form-button').click(function(e){
				e.preventDefault();
				$('.email-form').slideToggle();
			});

			$('.bxslider').bxSlider({
			  adaptiveHeight: true,
			  auto: true,
			  mode: 'fade',
			  captions: true,
			  controls: false
			});

			//------ TOOLTIPS ------//
			
			$('.tooltip').tooltipster({
				multiple:true
			});

			function last_child() {
				if ($.browser.msie && parseInt($.browser.version, 10) <= 8) {
					$('*:last-child').addClass('last-child');
				}
			}
			
		});

		jQuery(window).load(function(){


			// http://codepen.io/micahgodbolt/pen/FgqLc
			// NOTE! Refactor this code

			//------ EQUAL HEIGHTS HOME PAGE -----//
			
			// Get all the heights and store them in an array
			home_arr = new Array();

			jQuery('.block-thumb').find('.text-block').each(function(index){
				home_arr.push( jQuery( this ).height()+20 );
			});

			// Sort the array | Get the new height
			newheight = home_arr.sort(function(a, b){return a-b}).pop();

			// Apply the height value of the tallest to
			// all elements other elements of that type
			jQuery('.block-thumb').find('.text-block').css('min-height', newheight)


			//------ EQUAL HEIGHTS LANDING PAGES -----//
			
			// Get all the heights and store them in an array
			land_arr = new Array();

			jQuery('.text-block-green, .text-block-blue').each(function(index){
				land_arr.push( jQuery( this ).height()+20 );
			});

			console.log(land_arr.sort(function(a, b){return a-b}));

			// Sort the array | Get the new height
			newheight = land_arr.sort(function(a, b){return a-b}).pop();

			// Apply the height value of the tallest to
			// all elements other elements of that type
			jQuery('.text-block-green, .text-block-blue').css('height', newheight)



		});



	</script>

		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->

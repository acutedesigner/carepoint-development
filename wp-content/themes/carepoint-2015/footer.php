		<div class="push"></div>
	</div><!--end .wapper-->

	<!-- Begin Footer -->
	<div class="contact-bar">
		<div class="container">
			<p>Get in touch with us on: <a href="tel:01708 776770">01708 776770</a> or online <a href="<?php echo site_url('/feedback-forms'); ?>" class="btn violet-grad">Feedback forms <i class="fa fa-commenting"></i></a></p>	
		</div>
	</div>
	<footer class="footer" role="contentinfo">
		<div class="container">
			<h3>Care Point Havering</h3>
			<p>Care Point Family Mosaic, 1st Floor Holgate House, 6 Holgate Court, Western Road, Romford, RM1 3JS</p>
			<p><strong>Tel:</strong> 01708 776 770<br/><strong>Email:</strong> <a href="mailto:carepoint@familymosaic.co.uk">carepoint@familymosaic.co.uk</a></p>
		</div>
	</footer>

	<div class="footer-logos">
		<div class="container">
		<h3>Our partners:</h3>
			<ul>
				<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-havering-council.jpg" alt=""></a></li>
				<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-family-mosaic.jpg" alt=""></a></li>
				<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-nelft-nhs.jpg" alt=""></a></li>
				<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-healthwatch.jpg" alt=""></a></li>
				<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/logo-havering-ccg.jpg" alt=""></a></li>
			</ul>
		</div>
	</div>

	<nav class="footer-nav" role="navigation">
		<?php wp_nav_menu( array('theme_location' => 'footer_menu', 'container' => 'div', 'container_class' => 'container')); ?>
	</nav>
	<!-- End Footer -->

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
			  auto: true,
			  mode: 'fade',
			  speed: 4000,
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
	</script>

		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->

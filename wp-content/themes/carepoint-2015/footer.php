		<div class="push"></div>
	</div><!--end .wapper-->

	<!-- Begin Footer -->
	<div class="contact-bar">
		<div class="container">
			<p>Get in touch with us on: <a href="tel:01234567890">01708 432 000</a> or online <a href="#" class="btn violet-grad">Feedback forms <i class="fa fa-commenting"></i></a></p>	
		</div>
	</div><footer class="footer" role="contentinfo">
		<div class="container">

			<?php wp_nav_menu( array('theme_location' => 'footer_menu', 'container' => 'nav', 'container_class' => 'footer-nav')); ?>

			<div class="footer-logos">
				<ul>
					<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/accreditation-logo.jpg" alt=""></a></li>
					<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/accreditation-logo.jpg" alt=""></a></li>
					<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/accreditation-logo.jpg" alt=""></a></li>
					<li><a href=""><img src="<?php bloginfo("template_directory"); ?>/library/images/accreditation-logo.jpg" alt=""></a></li>	
				</ul>
			</div>

		</div>
	</footer>
	<!-- End Footer -->

	<script src="<?php bloginfo("template_directory"); ?>/library/js/jquery.tooltipster.min.js"></script>
	<script src="<?php bloginfo("template_directory"); ?>/library/js/modernizr.js"></script>
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

			$('.bxslider').bxSlider({
			  mode: 'fade',
			  captions: true
			});

			//------ TOOLTIPS ------//
			
			$('.tooltip').tooltipster();

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

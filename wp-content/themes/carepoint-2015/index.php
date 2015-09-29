<?php get_header(); ?>
<!-- FOR CAROUSEL -->
<div class="container">
	<ul class="bxslider">
		<li><img src="<?php bloginfo('template_url'); ?>/library/images/slider-image-1.jpg" /></li>
		<li><img src="<?php bloginfo('template_url'); ?>/library/images/slider-image-2.jpg" /></li>
		<li><img src="<?php bloginfo('template_url'); ?>/library/images/slider-image-3.jpg" /></li>
	</ul>
</div>

<div class="container">
	<div class="block block-intro">
		<div class="text-block">
			<h1 class="b-title">Welcome to Care Point</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div class="thumb-block">
			<div class="block block-text-panel">
				<h2>Safeguarding</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
				<p><a href="#" class="btn">Button</a></p> </div>
			</div>
		</div>
	</div>

	<?php dynamic_sidebar( 'home_right_1' ); ?>
	
	<!-- END OF INTRO BLOCK -->
	<div class="four-up-grid">
		<div class="grid">
			<div class="block block-thumb">
				<a href="#">
					<img src="<?php bloginfo('template_url'); ?>/library/images/img-care-for-yourself.jpg" alt="Care for yourself" />
					<div class="text-block">
						<h2 class="b-title">Care for yourself</h2>
					</div>
				</a>
			</div>
		</div>
		<div class="grid">
			<div class="block block-thumb">
				<a href="#">
					<img src="<?php bloginfo('template_url'); ?>/library/images/img-care-for-others.jpg" alt="Care for others" />
					<div class="text-block">
						<h2 class="b-title">Care for others</h2>
					</div>
				</a>
			</div>
		</div>
		<div class="grid">
			<div class="block block-thumb">
				<a href="#">
					<img src="<?php bloginfo('template_url'); ?>/library/images/img-care-advice.jpg" alt="General advice &amp; information" />
					<div class="text-block">
						<h2 class="b-title">General advice &amp; information</h2>
					</div>
				</a>
			</div>
		</div>
		<div class="grid">
			<div class="block block-thumb">
				<a href="#">
					<img src="<?php bloginfo('template_url'); ?>/library/images/img-care-services.jpg" alt="Care services directory" />
					<div class="text-block">
						<h2 class="b-title">Care services directory</h2>
					</div>
				</a>
			</div>
		</div>
	</div>
	<!-- end 4up -->
	<?php get_footer(); ?>
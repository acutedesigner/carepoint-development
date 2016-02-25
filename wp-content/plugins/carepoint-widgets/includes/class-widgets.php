<?php

class CPT_Textbox_Widget extends WP_Widget
{

	var $widget_counter = 0;
	var $sb_widget_count = 0;

	function __construct()
	{
		$options = array(

			'description' => 'To allow the text on the homepage to be updated. 2 Items Max',
			'name' 	=> 'CPT Textbox Widget',
		);

		parent::__construct('CPT_Textbox_Widget','',$options);
	}

	public function form($instance)
	{
		extract($instance);

		wp_enqueue_script( 'cpt_textbox_widget', plugins_url( '../assets/cpt-script.js' , __FILE__ ), array(), false, true );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input	class="widefat"
					id="<?php echo $this->get_field_id( 'title' ); ?>"
					name="<?php echo $this->get_field_name( 'title' ); ?>"
					type="text"
					value="<?php if(isset($title)) echo esc_attr( $title ); ?>"
			>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'content' ); ?>"
					  id="<?php echo $this->get_field_id( 'content' ); ?>"
					  rows="10" class="widefat"><?php if(isset($content)) echo esc_attr( $content ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Content Style:' ); ?></label>
			<?php

				$style_options[] = array( 'style_class' => 'text-block', 'style_name' => 'Text block' );
				$style_options[] = array( 'style_class' => 'thumb-block', 'style_name' => 'Text Panel' );

			?>
			<select name="<?php echo $this->get_field_name( 'blockstyle' ); ?>" id="blockstyle <?php echo $this->get_field_id( 'blockstyle' ); ?>">
			<?php foreach( $style_options as $style ):?>
				<option <?php echo (isset($blockstyle) && $style['style_class'] == $blockstyle ? "selected" : NULL); ?> value="<?php echo $style['style_class']; ?>"><?php echo $style['style_name']; ?></option>
			<?php endforeach; ?>
			</select>
		</p>

		<!-- Only show based on select menu -->
		<p>
			<label for="<?php echo $this->get_field_id( 'blocklink' ); ?>"><?php _e( 'Button Link:' ); ?></label>
			<input	class="widefat"
					id="blocklink <?php echo $this->get_field_id( 'blocklink' ); ?>"
					name="<?php echo $this->get_field_name( 'blocklink' ); ?>"
					type="text"
					value="<?php if(isset($blocklink)) echo esc_attr( $blocklink ); ?>"
			>
		</p>

		<?php
	}

	function widget($args,$instance)
	{

		// Get the sidebar widgets array
		$sidebars_widgets = wp_get_sidebars_widgets($args['id']);

		// Count the array
		$this->sb_widget_count = count($sidebars_widgets[$args['id']]);

		extract($instance);

		$class = array ( 'left-column' , 'right-column' );

		if($blockstyle == 'text-block')
		{
		?>

			<div class="<?php echo $class[$this->widget_counter] ?>">
				<h1 class="b-title"><?php echo $title ?></h1>
				<p><?php echo $content ?></p>
			</div>

		<?php
		}
		elseif($blockstyle == 'thumb-block')
		{
		?>

			<div class="<?php echo $class[$this->widget_counter] ?>">
				<div class="block block-text-panel">
					<h2><?php echo $title ?></h2>
					<p><?php echo $content ?></p>
					<?php if($blocklink != ""): ?><p><a href="<?php echo $blocklink; ?>" class="btn violet-grad">Read now</a></p><?php endif; ?>
				</div>
			</div>

		<?php
		}

		//Check the widget count
		if(($this->widget_counter+1) != $this->sb_widget_count)
		{
			$this->widget_counter++;
		}
		else
		{
			$this->widget_counter = 0;
		}
	}
}

class CPT_Category_Block extends WP_Widget
{
	function __construct()
	{
		$options = array(

			'description' => 'This is for the category blocks. Please ensure you have choosen a category image',
			'name' 	=> 'Care Point Category Block'
		);

		parent::__construct('CPT_Category_Block','',$options);
	}

	public function form($instance)
	{
		extract($instance);
			$cat_args = array(
			'parent '       => 0,
			'hide_empty'    => false,
		);

		$care_advice_categories = get_terms( 'care-advice-categories' , $cat_args);
		$care_services_categories = get_terms( 'care-services-categories' , $cat_args);

		$categories = array_merge( $care_services_categories, $care_advice_categories );

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'category_block' ); ?>"><?php _e( 'Select Category:' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'category_block' ); ?>" id="<?php echo $this->get_field_id( 'category_block' ); ?>">
			<?php foreach( $categories as $category ):?>
			<?php if ($category->parent == 0): ?>
				<option <?php echo (isset($category_block) && $category->term_id.':'.$category->taxonomy == $category_block ? "selected" : NULL); ?> value="<?php echo $category->term_id.':'.$category->taxonomy; ?>"><?php echo $category->name; ?></option>
			<?php endif; ?>
			<?php endforeach; ?>
			</select>
		</p>

		<?php
	}

	function widget($args,$instance)
	{
		extract($args);
		extract($instance);

		$category_block = explode(':', $category_block);

		$term = get_term_by( 'id', $category_block[0], $category_block[1] );

		?>

		<div class="grid">
			<div class="block block-thumb">
				<a href="<?php echo get_term_link( $term ) ?>">
					<img src="<?php echo z_taxonomy_image_url($term->term_id, 'square'); ?>" alt="Care for yourself" />
					<div class="text-block">
						<h2 class="b-title"><?php echo $term->name; ?></h2>
					</div>
				</a>
			</div>
		</div>

		<?php
	}
}

class CPT_Homepage_Carousel extends WP_Widget
{
	function __construct()
	{
		$options = array(

			'description' => 'This allows you to select items for the Homepage carousel.',
			'name' 	=> 'Care Point Homepage carousel'
		);

		parent::__construct('CPT_Homepage_Carousel','',$options);
	}

	function form($instance)
	{

		extract($instance);

		$selected_image = $instance['image'];
		$images = new WP_Query( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image' , 'posts_per_page' => -1 ) );


		$options = array();

		if ( $images->have_posts() ):

			for( $i = 0; $i < 2; $i++ ):

				$options[$i] = '';
				while ( $images->have_posts() ) : $images->the_post();
					$options[$i] .= '<option value="' . get_the_ID() . '" ' . selected( $selected_image, get_the_ID(), false ) . '>' . get_the_title() . '</option>';
				endwhile;

			endfor;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Select image:' ); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'image' ); ?>"><?php echo $options[0]; ?></select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input	class="widefat"
					id="<?php echo $this->get_field_id( 'title' ); ?>"
					name="<?php echo $this->get_field_name( 'title' ); ?>"
					type="text"
					value="<?php if(isset($title)) echo esc_attr( $title ); ?>"
			>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'content' ); ?>"
					  id="<?php echo $this->get_field_id( 'content' ); ?>"
					  rows="10" class="widefat"><?php if(isset($content)) echo esc_attr( $content ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:' ); ?></label>
			<input	class="widefat"
					id="<?php echo $this->get_field_id( 'link' ); ?>"
					name="<?php echo $this->get_field_name( 'link' ); ?>"
					type="text"
					value="<?php if(isset($link)) echo esc_attr( $link ); ?>"
			>
		</p>

		<?php

			// Create the array with the options
			$textblock_positions = array(
				"tbright" => "Position to the right",
				"tbleft" => "Position to the left"
			);

			// Add options to the select options
			$postitions = NULL;

			foreach($textblock_positions as $tb_value => $tb_position)
			{
				$positions .= '<option value="'.$tb_value.'" '.(isset($position) && $tb_value == $position ? 'selected' : NULL ).'>'.$tb_position.'</option>';
			}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'position' ); ?>"><?php _e( 'Position' ); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'position' ); ?>"><?php echo $positions; ?></select>
		</p>

		<?php
		else:
			echo 'There are no images in the media library. Click <a href="' . admin_url('/media-new.php') . '" title="Add Images">here</a> to add some images';
		endif;
	}

	function widget($args,$instance)
	{
		extract($instance);

	?>

		<li>
			<?php echo wp_get_attachment_image( $image, "full" ); ?>
			<?php if($content == "" && $title == ""): NULL; else: ?>
			<div class="textblock <?php echo $position; ?>">
				<h2><?php echo $title; ?></h2>
				<p><?php echo $content; ?></p>
				<?php if($link != ""): ?><a href="<?php echo $link; ?>" class="btn violet-grad">Read more</a><?php endif; ?>
			</div>
			<?php endif; ?>
		</li>

	<?php
	}
}

function cpt_register_widget() {
	register_widget('CPT_Textbox_Widget');
	register_widget('CPT_Category_Block');
	register_widget('CPT_Homepage_Carousel');
}

add_action( 'widgets_init', 'cpt_register_widget');


//------ WIDGETS ------//

function carepoint_widgets() {

	register_sidebar( array(
		'name'          => 'Homepage Carousel Items',
		'id'            => 'homepage_carousel_items',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Homepage Text blocks',
		'id'            => 'homepage_text_blocks',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Homepage Category blocks',
		'id'            => 'homepage_category_blocks',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'carepoint_widgets' );

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
			'name' 	=> 'CPT_Category_Block'		
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


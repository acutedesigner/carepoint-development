<?php

class CPT_Widgets_Widget extends WP_Widget
{

	var $widget_counter = 0;
	var $sb_widget_count = 0;

	public function __construct() {
		parent::__construct(
	 		'cpt_widgets_widget', // Base ID
			'Carepoint Widget', // Name
			array( 'description' => __('Displays one of your Widget Blocks.', 'tap-widgets') ) // Args
		);

		add_filter( 'ww_content', 'wptexturize') ;
		add_filter( 'ww_content', 'convert_smilies' );
		add_filter( 'ww_content', 'convert_chars' );
		add_filter( 'ww_content', 'wpautop' );
		add_filter( 'ww_content', 'shortcode_unautop' );
		add_filter( 'ww_content', 'do_shortcode', 11);
	}

 	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		$sb_title = $args['id'];
		// Get the sidebar widgets array
		$sidebars_widgets = wp_get_sidebars_widgets($sb_title);

		// Count the array
		$this->sb_widget_count = count($sidebars_widgets[$args['id']]);
		//echo 'Wid Counter: '.$this->widget_counter;
		//echo 'Wid Count: '.$this->sb_widget_count;

		$tapbox = "tap-box";

		// based on the current widget count, render the opening tag
		if($this->sb_widget_count == 2 && $this->widget_counter == 0 && $sb_title != 'carousel_promos' || $this->sb_widget_count == 4 && $this->widget_counter == 0 && $sb_title != 'carousel_promos' )
		{
			echo '<div class="services-4">';
			$tapbox = "tap-box-2";
		}
		else if($this->sb_widget_count == 3 && $this->widget_counter == 0 || $this->sb_widget_count == 6 && $this->widget_counter == 0 )
		{
			echo '<div class="services-6">';
		}
		else if($this->sb_widget_count == 5 && $this->widget_counter == 0)
		{
			echo '<div class="services-5">';
		}

		extract( $args );

		$id = ($instance['tap-widget-id']) ? $instance['tap-widget-id'] : 0;
		$color = $instance['color'];
		$show_title = (isset($instance['show_title'])) ? $instance['show_title'] : 1;
		$post = get_post($id);

		// 5 Widgets need a special kind of setup, so here goes...
		if($this->sb_widget_count == 5){

			switch ($this->widget_counter) {
			    case 0:
			        $before_widget = '<div class="column">'.$before_widget;
			        break;
			    case 1:
			        $after_widget = '</div>'.$after_widget;
			        break;
			    case 2:
			    	$before_widget = '<div class="tapbox hero">';
			    	$tapbox = "";
			    	break;
			    case 3:
			        $before_widget = '<div class="column">'.$before_widget;
			        break;
			    case 4:
			        $after_widget = '</div>'.$after_widget;
			        break;
			}

		}

		$image =  get_the_post_thumbnail( $id, $tapbox );

		echo $before_widget;


		if(!empty($id) && $post) {

			if($show_title) {
				// first check $instance['title'] so titles are not changes for people upgrading from an older version of the plugin
				// titles WILL change when they re-save their widget..
				$title = (isset($instance['title'])) ? $instance['title'] : $post->post_title;
				$title = apply_filters( 'widget_title', $title );
			}

			$content = apply_filters('ww_content', $post->post_content, $id);

			?>

			<?php if($show_title) { echo $before_title . $title . $after_title; } ?>
			<?php echo $this->category_label($post->ID) ?>
			<?php echo '<a class="tapbox_overlay '.$color.'" href="'.get_permalink($id).'">&nbsp;</a>'; ?>
			<?php if($image) { echo $this->remove_img_attr($image); } ?>

			<?php

				} elseif(current_user_can('manage_options')) { ?>
				<p>
					<?php if(empty($id)) {
						echo 'Please select a Tapestry Widget to show in this area.';
					} else {
						echo 'No widget block found with ID %d, please select an existing Tapestry Widget in the widget settings.', 'tap-widgets';
					} ?>
				</p>
		<?php
		}

		echo $after_widget;

		// Closing tag for even number of widgets
		if($this->widget_counter == 1 && $this->sb_widget_count == 2 && $sb_title != 'carousel_promos'
		 || $this->widget_counter == 3 && $this->sb_widget_count == 4 && $sb_title != 'carousel_promos'
		  || $this->widget_counter == 2 && $this->sb_widget_count == 3
		   || $this->widget_counter == 5 && $this->sb_widget_count == 6)
		{
			echo '</div>';
		}

		// Reset the counter if we have cleared all the widgets for a sidebar
		if(($this->widget_counter+1) != $this->sb_widget_count)
		{
			$this->widget_counter++;
		}
		else
		{
			$this->widget_counter = 0;
		}

	}

	// This is to stop the fixed height and widths distorting the images
	function remove_img_attr ($html) {
		return preg_replace('/(width|height)="\d+"\s/', "", $html);
	}

	// To create the category label
	public function category_label($id){

		$tags = get_the_category($id);

		foreach ( $tags as $tag ) {

				$link = "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug} label label-blue'>{$tag->name}</a>";
				return $link;
		}

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['tap-widget-id'] = $new_instance['tap-widget-id'];
		$instance['show_title'] = (isset($new_instance['show_title']) && $new_instance['show_title'] == 1) ? 1 : 0;
	    $instance['color'] = strip_tags($new_instance['color']);
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$posts = (array) get_posts(array(
			'post_type' => array('page'),
			'numberposts' => -1
		));

		$eventposts = (array) get_posts(array(
			'post_type' => array('tribe_events'),
			'numberposts' => -1
		));

		$show_title = (isset($instance['show_title'])) ? $instance['show_title'] : 1;
		$color = (isset($instance['color'])) ? $instance['color'] : '';
		$selected_widget_id = (isset($instance['tap-widget-id'])) ? $instance['tap-widget-id'] : 0;
		$title = ($selected_widget_id) ? get_the_title($selected_widget_id) : 'No item selected.';
		?>

		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="hidden" value="<?php echo esc_attr( $title ); ?>" />

		<p>
			<label for="<?php echo $this->get_field_id( 'tap-widget-id' ); ?>"><?php _e( 'Widget Block to show:', 'tap-widgets' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('tap-widget-id'); ?>" name="<?php echo $this->get_field_name( 'tap-widget-id' ); ?>" required>
				<option value="0" disabled <?php selected($selected_widget_id, 0); ?>><?php if(empty($posts)) { echo 'No widget blocks found'; } else { echo 'Select a widget block'; } ?></option>
				<?php foreach($posts as $p) { ?>
					<option value="<?php echo $p->ID; ?>" <?php selected($selected_widget_id, $p->ID); ?>><?php echo $p->post_title; ?></option>
				<?php } ?>
					<option>------- EVENTS -------</option>
				<?php foreach($eventposts as $ep) { ?>
					<option value="<?php echo $ep->ID; ?>" <?php selected($selected_widget_id, $ep->ID); ?>><?php echo $ep->post_title; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Color', 'wp_widget_plugin'); ?></label>
			<select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
				<?php
					$options = array('none', 'gradient', 'green', 'blue', 'red', 'purple', 'yellow', 'cyan', 'magenta', 'black');
					foreach ($options as $option)
					{
						echo '<option value="' . $option . '" id="' . $option . '"', $color == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>

		<p>
			<label><input type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked($show_title, 1); ?> /> <?php _e("Show title?", "tap-widgets"); ?></label>
		</p>

		<p class="help"><?php printf(__('Manage your widget blocks %shere%s', 'tap-widgets'), '<a href="'. admin_url('edit.php?post_type=tap-widget') .'">', '</a>'); ?></p>
		<?php
	}

}
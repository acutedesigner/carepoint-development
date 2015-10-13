<?php


/* 

	Plugin Name: PluginTwitter
	Description: This is a widget plugin
	Author: Nigel Peters
	Version: 1.0 
	
*/


class PluginTwitter extends WP_Widget{


	function __construct()
	{
	
		$options = array( 
		
			'description' => 'This is a simple Twitter Widget for Tweets',
			'name' 	=> 'PluginTwitter'			
		
		);
		
		parent::__construct('PluginTwitter','',$options);
	
	}
	
	public function form($instance)
	{
		extract($instance);
		
		?>
		
		<p>
		
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input type="text"
				class = "widefat"
				id = "<?php echo $this->get_field_id('title'); ?>"
				name = "<?php echo $this->get_field_name('title'); ?>"
				value = "<?php if(isset($title)) echo esc_attr($title); ?>" />	
		
		</p>
		
		<p>
		
			<label for="<?php echo $this->get_field_id('username'); ?>">Twitter Username :</label>
			<input type="text"
				class = "widefat"
				id = "<?php echo $this->get_field_id('username'); ?>"
				name = "<?php echo $this->get_field_name('username'); ?>"
				value = "<?php if(isset($username)) echo esc_attr($username); ?>" />
			
		</p>		
		
		<p>
		
			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Tweets:</label>
			<input 
				class = "widefat"
				id = "<?php echo $this->get_field_id('count'); ?>"
				type = "number"
				style = "width: 40px;"
				name = "<?php echo $this->get_field_name('count'); ?>"
				min = "1"
				max = "10"
				value = "<?php echo !empty($count) ? $count : 5; ?>" />
						
		</p>
		
		<?php
		
	}
	
	
	
	
	
	
	
	function widget($args,$instance)
	{
		extract($args);
		extract($instance);
		if( empty($title) ) $title = 'New Tweets';
		$data = $this->twitter($count, $username);
		
		if( false !== $data && isset($data->tweets) ) {
		
			
		echo $before_widget;
			echo $before_title;
			echo $title;
			echo $after_title;
			echo '<ul><li>' . implode($data->tweets) . '</li></ul>';
		echo $after_widget;
		
		}
	}
	
		private function twitter($count,$username)
		{
			if(empty($username)) return false;
			$tweets = get_transient('recent_tweets_widget');
			if(!$tweets)
			{
				return $this->fetch_tweets($count,$username);
			}
			return $tweets;
		}
		
		
		private function fetch_tweets($count, $username)
		{
			$tweets = wp_remote_get("http://twitter.com/statuses/user_timeline/$username.json");
			$tweets = json_decode($tweets['body']);
			
			
			
			if(isset($tweets->error)) return false;
			$data = new stdClass();
			$data->username = $username;
			$data->count = $count;
			$data->tweets = array();
			
			foreach($tweets as $tweet)
			{
				if($count-- === 0) break;
				$data->tweets[] = $this->filter_tweet($tweet->text);			
			}
			
			set_transient('recent_tweets_widget',$data, 60*5);
			return $data;
		}

		
		
		
		private function filter_tweet($tweet)
		{
			$tweet = preg_replace('/(http[^\s]+)/im', '<a href="$1">$1</a>',$tweet);
			
			$tweet = preg_replace('/@([^\s]+)/i', '<a href="http://twitter.com/$1">@$1</a>',$tweet);
			return $tweet;
		
		}
		
		
		
		
		
}














add_action('widgets_init','Plugin_register_informar');

function Plugin_register_informar()
{
	register_widget('PluginTwitter');

}






?>
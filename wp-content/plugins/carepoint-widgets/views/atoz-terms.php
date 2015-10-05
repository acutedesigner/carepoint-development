	<div class="container">
		
		<?php the_breadcrumb(); ?>

		<h1>Terms beginning with the letter: <?php echo ucfirst(get_query_var('letter')); ?></h1>
		<hr />
	</div>

	<div class="container">

<?php
	// https://wordpress.org/support/topic/how-to-list-taxonomy-terms-by-first-letter?replies=5
	$tags = get_tags();
	$groups = array();

	if( $tags && is_array( $tags ) )
	{
		foreach( $tags as $tag )
		{
			$first_letter = strtoupper( $tag->name[0] );
			$groups[ $first_letter ][] = $tag;
		}

		if( !empty( $groups[ucfirst(get_query_var('letter'))] ) )
		{	
			echo '<ul class="headline-list">';
			foreach( $groups[ucfirst(get_query_var('letter'))] as $letter)
			{
				echo '<li><h3><a href="'.get_site_url().'/tag/'.get_query_var('letter').'/'.$letter->slug.'">'.ucfirst($letter->name).'</a></h3></li>'; 
			}
			echo '</ul>';
		}
		else
		{
			echo '<h2>Sorry. No terms exist for the letter '.ucfirst(get_query_var('letter')).'</h2>';
		}
	}	
		
?>			
	</div>

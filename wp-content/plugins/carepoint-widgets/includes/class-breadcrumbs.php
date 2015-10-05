<?php

//------ BREAD CRUMBS -------//

function get_taxonomy_parents($parent, $taxonomy)
{
	$parent_tax = get_term( $parent, $taxonomy );
	$parent_tax_link = get_term_link( $parent_tax );

	if($parent_tax->parent != 0)
	{
		get_taxonomy_parents($parent_tax->parent, $parent_tax->taxonomy);
	}

	echo '<li><a href="'.$parent_tax_link.'">'.$parent_tax->name.'</a></li>';
}


function the_breadcrumb()
{
	echo '<nav class="breadcrumbs">';
	echo '	<ul>';
	if(!is_home())
	{

		echo '<li><a href="'.get_option('home').'">Home</a></li>';

		if(is_tax())
		{

			$current_tax = get_queried_object();

				// check if it has a parent
				if($current_tax->parent != 0)
				{
					get_taxonomy_parents($current_tax->parent, $current_tax->taxonomy);					
				}

			// Add the current term last
			echo '<li>'.$current_tax->name.'</li>';

		}

		// if Single

		if(is_single())
		{
			global $post;
			//get the term of the current post
			//
			$post_type = get_post_type( $post );
			echo '<li>'.the_title().'</li>';			
		}

	}
	echo '	</ul>';
	echo '</nav>';
}

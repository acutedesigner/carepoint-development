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

function search_cp_url()
{
	$url = array_filter(explode("/", $_SERVER["REQUEST_URI"]));
	foreach ($url as $key => $item)
	{
		if ($item == 'tag'){
			return TRUE;
		}
	}
}

function the_breadcrumb()
{
	echo '<nav class="breadcrumbs">';
	echo '	<ul>';
	if(!is_home())
	{

		echo '<li><a href="'.get_option('home').'">Home</a></li>';

		if(is_page())
		{
			echo '<li>'.$current_tax->name.'</li>';
		}

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

		if(is_single())
		{
			$url = array_filter(explode("/", $_SERVER["HTTP_REFERER"]));
			//printme($url);

			if(in_array("tag",$url))
			{
			    // Get the
			    
				$term = array_pop($url);

				$letter = array_pop($url);

				echo '<li class="atoz-toggle"><a href="">A to Z</a></li>';
				echo '<li><a href="'.get_site_url().'/tag/'.$letter.'">'.ucfirst($letter).'</a></li>';
				echo '<li><a href="'.get_atoz_letter_link($term).'">'.ucfirst($term).'</a></li>';

			}
			elseif(strpos(end($url),'search') !== false)
			{
				// Display crumbs for search results
				echo '<li><a href="'.get_site_url().'/'.end($url).'">Search results</a></li>';
			}
			else
			{
				// Displaying the crumbs for links coming from categories
				global $post;

				//get the terms of the current post				
				$single_terms = get_the_terms( $post->ID, $post->post_type.'-categories', array( 'parent' => 0 ) );

				$url_term = array_pop($url);
				
				foreach ($single_terms as $term) {

					// Display crumb for link from category
					if($term->slug == $url_term)
					{
						get_taxonomy_parents($term->parent, $term->taxonomy);
						echo '<li><a href="'.get_term_link( $term ).'">'.$term->name.'</a></li>';
						break;
					}
					// Display crumb for link from anywhere else
					elseif(empty($url_term))
					{
						get_taxonomy_parents($term->parent, $term->taxonomy);
						echo '<li><a href="'.get_term_link( $term ).'">'.$term->name.'</a></li>';
						break;
					}

				}

			}


			//$post_type = get_post_type( $post );
			echo '<li>'.the_title().'</li>';			
		}

	}

	if( get_query_var('letter') )
	{
		echo '<li><a href="'.get_option('home').'">Home</a></li>';
		echo '<li><a href="">A to Z</a></li>';
		// get the current letter		
		echo '<li><a href="'.get_site_url().'/tag/'.get_query_var('letter').'">'.ucfirst(get_query_var('letter')).'</a></li>';
		if(get_query_var('term'))
		{
			echo '<li>'.ucfirst(get_query_var('term')).'</li>';
		}
	}

		// if Single

	echo '	</ul>';
	echo '</nav>';
}

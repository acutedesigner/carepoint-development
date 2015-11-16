<?php

//------- MENU PAGES ---------//


function register_my_menus() {
  register_nav_menus(
	array(
	  'primary_menu' => __( 'Primary Menu' ),
	  'header_menu' => __( 'Header Menu' ),
	  'footer_menu' => __( 'Footer Menu' )
	)
  );
}

add_action( 'init', 'register_my_menus' );

//------ IMAGE SIZES ------//

add_image_size( 'landscape-4x3', 600, 450 );
add_image_size( 'landscape-16x9', 1280, 720 );
add_image_size( 'square', 600, 600, array( 'left', 'top' ) );

function atoz_letter_link($term)
{
	/*
	 * Here we change the permalink to show a letter before the term
	 * domain / tag / LETTER / taxonomy
	*/
	$letter = substr($term->slug, 0,1);
			
	$link = explode('/', get_term_link($term));

	$newlink = get_site_url(). '/' . $link[4] . '/' . $letter . '/' . $link[5];
	return $newlink;
}


function custom_rating_image_extension() {
    return 'png';
}
add_filter( 'wp_postratings_image_extension', 'custom_rating_image_extension' );

/**
 * 
 * 1: Get a list of tags beginning with the letter $foo
 * 2: From that get a list of articles that are tagged with the term $bar
 * 3: The list of articles need to be able to be filtered by advice or title
 * 
 */

// add_action('wp_loaded', function(){
//         $post_types = get_post_types( array( 'public' => true ), 'names' ); 
//         print_r($post_types);
// });

// add_filter( 'nav_menu_link_attributes', 'add_active_class', 10, 3 );

// function add_active_class( $atts, $item, $args ) {
// 	if($item->type == 'taxonomy' && is_tax())
// 	{
// 		$url = array_filter(explode("/", $_SERVER["REQUEST_URI"])); // use array filter to remove empty values
// 		$url = array_pop($url);
// 		$category = get_the_category($url);
// 		printme($category);		
// 		$atts['class'] = 'active';
// 	}
// 		return $atts;
// }

function my_searchwp_results( $results, $attributes ) {
	
	// available $attributes are:
	//
	//    $attributes['terms']          the search terms
	//    $attributes['page']           the current page
	//    $attributes['order']          the results order
	//    $attributes['foundPosts']     the number of found posts
	//    $attributes['maxNumPages']    the total number of pages of results
	//    $attributes['engine']         the engine in use
	
	// modify $results in any way you'd like

	global $searchwp_categories;

	foreach ($results as $result) {
    	$cats = get_the_terms( $result->ID, $result->post_type.'-categories' );
		foreach ($cats as $cat) {
			printme($cat);
			$searchwp_categories[$cat->name] = true;
		}
    }

    $searchwp_categories = array_keys($searchwp_categories);
    sort($searchwp_categories);

	return $results;
}
add_filter( 'searchwp_results', 'my_searchwp_results', 10, 2 );


//------ DEBUGGING ------//

function inspect_wp_query() 
{
  echo '<pre>';
    print_r($GLOBALS['wp_query']);
  echo '</pre>';
}

// // If you're looking at other variables you might need to use different hooks
// // this can sometimes be a little tricky.
// // Take a look at the Action Reference: http://codex.wordpress.org/Plugin_API/Action_Reference
// add_action( 'shutdown', 'inspect_wp_query', 999 ); // Query on public facing pages
// add_action( 'admin_footer', 'inspect_wp_query', 999 ); // Query in admin UI

function printme($array)
{
	echo '<pre>';
		print_r($array);
	echo '</pre>';	
}

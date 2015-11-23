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


function my_searchwp_results( $results, $attributes ) {
	
	global $searchwp_categories;
	global $searchwp_result_count;

	$searchwp_result_count = $attributes['foundPosts'];

    $search_type = str_replace('_','-',$_REQUEST['search_type']);

	foreach ($results as $result) {
    	$cats = get_the_terms( $result->ID, $result->post_type.'-categories' );

        
        if($search_type == $result->post_type && $search_type != 'everything')
        {
            foreach ((array)$cats as $cat) {
                $searchwp_categories[$cat->name] = array(
                        'cat-name' => $cat->name,
                        'cat-tax' => $cat->taxonomy,
                        'cat-slug' => $cat->slug
                    );
            }            
        }
        elseif($search_type == 'everything')
        {
            foreach ((array)$cats as $cat) {
                $searchwp_categories[$cat->name] = array(
                        'cat-name' => $cat->name,
                        'cat-tax' => $cat->taxonomy,
                        'cat-slug' => $cat->slug
                    );
            }            
        }

    }

	return $results;
}
add_filter( 'searchwp_results', 'my_searchwp_results', 10, 2 );


function kriesi_pagination($pages = '', $range = 2)
{  
    $showitems = ($range * 2)+1;  

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
     global $wp_query;
     $pages = $wp_query->max_num_pages;
     if(!$pages)
     {
         $pages = 1;
     }
    }   

    if(1 != $pages)
    {
     echo "<div class='pagination'>";
     if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
     if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

     for ($i=1; $i <= $pages; $i++)
     {
         if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
         {
             echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
         }
     }

     if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
     if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
     echo "</div>\n";
    }
}

if( function_exists('acf_add_options_page') ) {
 
    $page = acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'  => false
    ));
 
}

if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page( 'Footer' );
}

/*
*  Create an advanced sub page called 'Footer' that sits under the General options menu
*/

if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page(array(
        'title' => 'Footer',
        'parent' => 'options-general.php',
        'capability' => 'manage_options'
    ));
}

// Let's stop WordPress re-ordering my categories/taxonomies when I select them    
function stop_reordering_my_categories($args) {
    $args['checked_ontop'] = false;
    return $args;
}

// Let's initiate it by hooking into the Terms Checklist arguments with our function above
add_filter('wp_terms_checklist_args','stop_reordering_my_categories');

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

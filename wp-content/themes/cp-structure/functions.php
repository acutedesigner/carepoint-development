<?php

//------- MENU PAGES ---------//


function register_my_menus() {
  register_nav_menus(
	array(
	  'main_menu' => __( 'Main Menu' ),
	  'header_menu' => __( 'Header Menu' )
	)
  );
}


// Our custom post type function
function create_posttype() {

	register_post_type( 'movies',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Movies' ),
				'singular_name' => __( 'Movie' )
			),
			'public' => true,
			'has_archive' => false,
			'hierarchical' => false,
			'taxonomies' => array('genre',),
			'rewrite' => array('slug' => 'movies'),
			'capability_type'     => 'page'
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
add_action( 'init', 'register_my_menus' );

//------ PAGE META BOXES ------//

add_action( 'init', 'page_meta_boxes' );

function page_meta_boxes(){	 
	// Add category metabox to page 
	register_taxonomy_for_object_type('category', 'page');  	
	register_taxonomy_for_object_type('category', 'movies');  	

// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Genres' ),
		'all_items'         => __( 'All Genres' ),
		'parent_item'       => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item'         => __( 'Edit Genre' ),
		'update_item'       => __( 'Update Genre' ),
		'add_new_item'      => __( 'Add New Genre' ),
		'new_item_name'     => __( 'New Genre Name' ),
		'menu_name'         => __( 'Genre' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'movies' ), $args );
}

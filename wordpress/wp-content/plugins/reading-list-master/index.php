<?php
/**
 * @package Reading_List
 * @version 0.1
 */
/*
Plugin Name: Reading List
Plugin URI: http://andrewspittle.net/projects/reading-list
Description: Track the books you read right from the WordPress Dashboard.
Author: Andrew Spittle
Version: 0.1
Author URI: http://andrewspittle.net/
*/

/**
 * Start up our custom post type and hook it in to the init action when that fires.
 *
 * @since Reading List 0.1
 */

add_action( 'init', 'rl_create_post_type' );

function rl_create_post_type() {
	$labels = array(
		'name' 							=> __( 'Books', 'readinglist' ),
		'singular_name' 				=> __( 'Book', 'readinglist' ),
		'search_items'					=> __( 'Search Books', 'readinglist' ),
		'all_items'						=> __( 'All Books', 'readinglist' ),
		'edit_item'						=> __( 'Edit Book', 'readinglist' ),
		'update_item' 					=> __( 'Update Book', 'readinglist' ),
		'add_new_item' 					=> __( 'Add New Book', 'readinglist' ),
		'new_item_name' 				=> __( 'New Book', 'readinglist' ),
		'menu_name' 					=> __( 'Books', 'readinglist' ),
	);
	
	$args = array (
		'labels' 		=> $labels,
		'public' 		=> true,
		'menu_position' => 20,
		'has_archive' 	=> true,
		'rewrite'		=> array( 'slug' => 'books' ),
		'supports' 		=> array( 'title', 'thumbnail', 'editor' )
	);
	register_post_type( 'rl_book', $args );
}

/**
 * Create our custom taxonomies. One hierarchical one for genres and a flat one for authors.
 *
 * @since Reading List 0.1
 */

/* Hook in to the init action and call rl_create_book_taxonomies when it fires. */
add_action( 'init', 'rl_create_book_taxonomies', 0 );

function rl_create_book_taxonomies() {
	// Add new taxonomy, keep it non-hierarchical (like tags)
	$labels = array(
		'name' 							=> __( 'Authors', 'readinglist' ),
		'singular_name' 				=> __( 'Author', 'readinglist' ),
		'search_items' 					=> __( 'Search Authors', 'readinglist' ),
		'all_items' 					=> __( 'All Authors', 'readinglist' ),
		'edit_item' 					=> __( 'Edit Author', 'readinglist' ), 
		'update_item' 					=> __( 'Update Author', 'readinglist' ),
		'add_new_item' 					=> __( 'Add New Author', 'readinglist' ),
		'new_item_name' 				=> __( 'New Author Name', 'readinglist' ),
		'separate_items_with_commas' 	=> __( 'Separate authors with commas', 'readinglist' ),
		'choose_from_most_used' 		=> __( 'Choose from the most used authors', 'readinglist' ),
		'menu_name' 					=> __( 'Authors', 'readinglist' ),
	); 	
		
	register_taxonomy( 'book-author', array( 'rl_book' ), array(
		'hierarchical' 		=> false,
		'labels' 			=> $labels,
		'show_ui' 			=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'rewrite' 			=> array( 'slug' => 'book-author' ),
	));
}

/**
 * Add custom meta box for tracking the page numbers of the book.
 *
 * Props to Justin Tadlock: http://wp.smashingmagazine.com/2011/10/04/create-custom-post-meta-boxes-wordpress/
 *
 * @since Reading List 1.0
 *
*/



?>
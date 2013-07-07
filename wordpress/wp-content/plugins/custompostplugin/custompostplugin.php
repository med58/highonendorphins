<?php
/*
Plugin Name: Custom Post
Plugin URI: http://www.highonendorphins.com
Description: Creates Custom Posts
Version: 1.0
Author: Mark Dennin
Author URI: http://www.highonendorphins.com/about
License: GPL2
*/

function my_custom_post_tape() {
	$labels = array(
		'name'               => _x( 'Tapes', 'post type general name' ),
		'singular_name'      => _x( 'Tape', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Tape' ),
		'edit_item'          => __( 'Edit Tape' ),
		'new_item'           => __( 'New Tape' ),
		'all_items'          => __( 'All Tapes' ),
		'view_item'          => __( 'View Tape' ),
		'search_items'       => __( 'Search Tapes' ),
		'not_found'          => __( 'No tapes found' ),
		'not_found_in_trash' => __( 'No tapes found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Tapes'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our tapes and tape specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'tape', $args );	
}
add_action( 'init', 'my_custom_post_tape' );

?>
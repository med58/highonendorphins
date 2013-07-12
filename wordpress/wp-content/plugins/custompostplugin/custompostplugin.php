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

add_action('init', 'my_custom_post_tape');

function my_custom_post_tape() {
	$labels = array(
		'name'               => __( 'Tapes', 'post type general name' ),
		'singular_name'      => __( 'Tape', 'post type singular name' ),
		'add_new'            => __( 'Add New', 'tape' ),
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
		'supports'      => array( 'title', 'editor', 'thumbnail', /*'excerpt',*/ 'comments'),
		'has_archive'   => true,
	);
	register_post_type( 'tape', $args );	
}

add_action( 'load-post.php', 'tp_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'tp_post_meta_boxes_setup' );

function tp_post_meta_boxes_setup() {

	add_action( 'add_meta_boxes', 'add_tp_meta_boxes');
	add_action( 'save_post', 'tp_ratings_save_meta', 10, 1 );
}


function add_tp_meta_boxes() {

	add_meta_box(
		'tp-ratings',
		'Ratings',
		'tp_ratings_meta_box',
		'tp',
		'side',
		'default'
	);
}

function tp_ratings_meta_box() { 
	global $post;

	// Noncename needed to verify where the data originated
7
    echo '<input type="hidden" name="tpmeta_noncename" id="tpmeta_noncename" value="' .
8
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
9
     
10
    // Get the location data if its already been entered
11
    $location = get_post_meta($post->ID, '_location', true);
12
     
13
    // Echo out the field
14
    echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';
15
 
16
}




?>
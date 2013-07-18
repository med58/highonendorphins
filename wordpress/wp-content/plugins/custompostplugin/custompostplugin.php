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
		'register_meta_box_cb' => 'add_tp_meta_boxes'
	);
	register_post_type( 'tape', $args );	
}

/* Define the custom box */

add_action( 'add_meta_boxes', 'ratings_add_custom_box' );

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'ratings_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function ratings_add_custom_box() {
    $screens = array( 'post', 'page' );
    foreach ($screens as $screen) {
        add_meta_box(
            'ratings_sectionid',
            __( 'Ratings', 'ratings_textdomain' ),
            'ratings_inner_custom_box',
            $screen
        );
    }
}

/* Prints the box content */
function ratings_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'ratings_noncename' );

  // The actual fields for data entry
  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
  echo '<label for="ratings_new_field">';
       _e("Enter a rating", 'ratings_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="ratings_new_field" name="ratings_new_field" value="'.esc_attr($value).'" size="25" />';
}

/* When the post is saved, saves our custom data */
function ratings_save_postdata( $post_id ) {

  // First we need to check if the current user is authorised to do this action. 
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['ratings_noncename'] ) || ! wp_verify_nonce( $_POST['ratings_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Thirdly we can save the value to the database

  //if saving in a custom table, get post_ID
  $post_ID = $_POST['post_ID'];
  //sanitize user input
  $mydata = sanitize_text_field( $_POST['ratings_new_field'] );

  // Do something with $mydata 
  // either using 
  add_post_meta($post_ID, '_my_meta_value_key', $mydata, true) or
    update_post_meta($post_ID, '_my_meta_value_key', $mydata);
  // or a custom table (see Further Reading section below)
}

	
// 	 add_action( 'add_meta_boxes', 'add_tp_meta_boxes');
	

// function add_tp_meta_box() {

// 	add_meta_box(
// 		'tp_ratings',
// 		'Ratings',
// 		'tp_ratings',
// 		'tp',
// 		'side',
// 		'default'
// 	);

// }

// function tp_ratings() { 
// 	global $post;

// 	// Noncename needed to verify where the data originated
// 	echo '<input type="hidden" name="tpmeta_noncename" id="tpmeta_noncename" value="' .
//     wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
     
//     // Get the ratings data if its already been entered
//     $ratings = get_post_meta($post->ID, '_ratings', true);
     
//     // Echo out the field
//     echo '<input type="text" name="_ratings" value="' . $ratings  . '" class="widefat" />';
 
// }

// // Save the Metabox Data
// function save_tp_meta($post_id, $post) {

//     // verify this came from the our screen and with proper authorization,
//     // because save_post can be triggered at other times
//     if ( !wp_verify_nonce( $_POST['tpmeta_noncename'], plugin_basename(__FILE__) )) {

//     return $post->ID;
//     }

//     // Is the user allowed to edit the post or page?
//     if ( !current_user_can( 'edit_post', $post->ID ))

//         return $post->ID;

//     // OK, we're authenticated: we need to find and save the data

//     // We'll put it into an array to make it easier to loop though.

     

//     $tp_meta['_ratings'] = $_POST['_ratings'];

//     // Add values of $tp_meta as custom fields
//     foreach ($tp_meta as $key => $value) { // Cycle through the $tp_meta array!

//         if( $post->post_type == 'revision' ) return; // Don't store custom data twice

//         $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)

//         if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value

//             update_post_meta($post->ID, $key, $value);

//         } else { // If the custom field doesn't have a value

//             add_post_meta($post->ID, $key, $value);

//         }

//         if(!$value) delete_post_meta($post->ID, $key); // Delete if blank

//     }

// }

 
// add_action('save_post', 'save_tp_meta', 1, 2); // save the custom fields




?>
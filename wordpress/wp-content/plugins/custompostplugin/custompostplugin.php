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

	add_action( 'add_meta_boxes', 'tp_add_post_meta_boxes');
	add_action( 'save_post', 'tp_ratings_save_meta', 10, 2 );
}


function tp_addpost_meta_boxes() {

	add_meta_box(
		'tp-ratings',
		esc_html__( 'Ratings', 'example'),
		'tp_ratings_meta_box',
		'tp',
		'side',
		'default'
	);
}

function tp_ratings_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'tp_ratings_nonce' ); ?>

	<p> 
		<label for="tp-ratings"><?php _e( "Add the rating of the video.", 'example' ); ?></label>
		<br />
		<input class="widefat" type="text" name="tp-ratings" id="tp-ratings" value="<?php echo esc_attr( get_post_meta( $object->ID, 'tp_ratings', true ) ); ?>" size="30" />
	</p>
<?php }

/* Save the meta box's data. */
function tp_ratings_save_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['tp_ratings_nonce'] ) || !wp_verify_nonce( $_POST['tp_ratings_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['tp-ratings'] ) ? sanitize_html_class( $_POST['tp-ratings'] ) : '' );

	/* Get the meta key. */
	$meta_key = 'tp_ratings';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
} 



?>
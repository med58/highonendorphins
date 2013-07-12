<?php
// Block direct requests
if ( !defined('ABSPATH') ) {
	exit();
}

// ------------- Functions ------------- 

function sci_social_shortcode_init($attr, $content){
	wp_register_style( 'contact-info.css', SCI_URL.'css/contact-info-frondend.css', array(), '1.0' );
	wp_enqueue_style( 'contact-info.css');
	$attr = shortcode_atts(
		array(
			'orientation' => 'horizontal',
		), $attr
	);

	// Links
	$twitter_link 	= get_option('qs_contact_twitter');
	$facebook_link 	= get_option('qs_contact_facebook');
	$youtube_link	= get_option('qs_contact_youtube');
	$google_link 	= get_option('qs_contact_google');
	$linkedin_link 	= get_option('qs_contact_linkedin');

	// Icons
	$twitter_icon 	= get_option('qs_contact_twitter_icon');
	$facebook_icon 	= get_option('qs_contact_facebook_icon');
	$youtube_icon 	= get_option('qs_contact_youtube_icon');
	$google_icon 	= get_option('qs_contact_google_icon');
	$linkedin_icon 	= get_option('qs_contact_linkedin_icon');

	extract($attr);

	$result = '<div class="sci-social-icons"><ul class="sci-social-icons-'.$orientation.'">'; 
		if (!empty($twitter_link)) {
			$result .= '<li><a href="'. $twitter_link .'" target="_blank"><img src="'. $twitter_icon .'" alt="Twitter"></a></li>';
		}
		if (!empty($facebook_link)) {
			$result .= '<li><a href="'. $facebook_link .'" target="_blank"><img src="'. $facebook_icon .'" alt="Facebook"></a></li>';
		}
		if (!empty($youtube_link)) {
			$result .= '<li><a href="'. $youtube_link .'" target="_blank"><img src="'. $youtube_icon .'" alt="YouTube"></a></li>';
		} 
		if (!empty($google_link)) {
			$result .= '<li><a href="'. $google_link .'" target="_blank"><img src="'. $google_icon .'" alt="Google+"></a></li>'; 
		} 
		if (!empty($linkedin_link)) {
			$result .= '<li><a href="'. $linkedin_link .'" target="_blank"><img src="'. $linkedin_icon .'" alt="LinkedIn"></a></li>';
		}
	$result .= '</ul></div>';

	return $result;
}
add_shortcode('sci_social', 'sci_social_shortcode_init');
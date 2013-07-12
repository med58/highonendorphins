<?php
// Block direct requests
if ( !defined('ABSPATH') ) {
	exit();
}

class SCI_Info_Widget extends WP_Widget {

	function __construct() {
		$params = array(
			'name' 			=> 'Simple Contact Info',
			'description' 	=> __('Displays contact (phone, fax, email) information.', 'simple-contact-info'),
		);

		parent::__construct('SCI_Info_Widget', '', $params);
	}

	public function form($instance) {
		extract($instance);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title", 'simple-contact-info'); ?>:</label>
			<input 
				class="wadfat"
				name="<?php echo $this->get_field_name( 'title' ); ?>" 
				id="<?php echo $this->get_field_id( 'title' ); ?>"
				value="<?php if(!empty($title)) {echo esc_attr($title);} else {echo '';} ?>"
				type="text" />
		</p>
		<hr />
		<h4><?php _e("Show", 'simple-contact-info'); ?>:</h4>
		<p>
			<input 
				type="checkbox" 
				class="checkbox" 
				id="<?php echo $this->get_field_id( 'show_phone' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_phone' ); ?>" 
				<?php if (isset($show_phone) && ($show_phone == 'on')) { echo 'checked="checked"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'show_phone' ); ?>"> <?php _e("Phone number", 'simple-contact-info'); ?></label>
			<br />
			<input 
				type="checkbox" 
				class="checkbox" 
				id="<?php echo $this->get_field_id( 'show_phone_label' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_phone_label' ); ?>" 
				<?php if (isset($show_phone_label) && ($show_phone_label == 'on')) { echo 'checked="checked"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'show_phone_label' ); ?>"> <?php _e("Phone label", 'simple-contact-info'); ?></label>
		</p>
		<hr align="center" width="100px"/>
		<p>
			<input 
				type="checkbox" 
				class="checkbox" 
				id="<?php echo $this->get_field_id( 'show_fax' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_fax' ); ?>" 
				<?php if ((isset($show_fax)) && ($show_fax == 'on')) { echo 'checked="checked"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'show_fax' ); ?>"> <?php _e("Fax number", 'simple-contact-info'); ?></label>
			<br />
			<input 
				type="checkbox" 
				class="checkbox" 
				id="<?php echo $this->get_field_id( 'show_fax_label' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_fax_label' ); ?>" 
				<?php if (isset($show_fax_label) && ($show_fax_label == 'on')) { echo 'checked="checked"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'show_fax_label' ); ?>"> <?php _e("Fax label", 'simple-contact-info'); ?></label>
		</p>
		<hr align="center" width="100px"/>
		<p>
			<input 
				type="checkbox" 
				class="checkbox" 
				id="<?php echo $this->get_field_id( 'show_email' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_email' ); ?>" 
				<?php if (isset($show_email) && ($show_email == 'on')) { echo 'checked="checked"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'show_email' ); ?>"> <?php _e("Email", 'simple-contact-info'); ?></label>
			<br />
			<input 
				type="checkbox" 
				class="checkbox" 
				id="<?php echo $this->get_field_id( 'show_email_label' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_email_label' ); ?>" 
				<?php if (isset($show_email_label) && ($show_email_label == 'on')) { echo 'checked="checked"'; } ?>>
			<label for="<?php echo $this->get_field_id( 'show_email_label' ); ?>"> <?php _e("Email label", 'simple-contact-info'); ?></label>
		</p>
		<?php
	}

	public function widget($args, $instance) {
    	$phone 		= get_option('qs_contact_phone');
		$fax 		= get_option('qs_contact_fax');
		$email		= get_option('qs_contact_email');
		extract($args);
		extract($instance);
		?>
		<?php echo $before_widget; ?>
			<div class="sci-contact">
				<?php if (!empty($title)) {
					echo $before_title . $title . $after_title;
				}?>
				<?php if (!empty($phone) && ((isset($show_phone)) && ($show_phone == 'on'))) : ?><p class="sci-address-phone"><?php if (isset($show_phone_label) && $show_phone_label == 'on') : ?><span><?php _e("Phone:"); ?> </span><?php endif; ?><?php echo $phone; ?></p><?php endif; ?>
				<?php if (!empty($fax) && ((isset($show_fax)) && ($show_fax == 'on'))) : ?><p class="sci-address-fax"><?php if (isset($show_fax_label) && $show_fax_label == 'on') : ?><span><?php _e("Fax:"); ?> </span><?php endif; ?><?php echo $fax; ?></p><?php endif; ?>
				<?php if (!empty($email) && ((isset($show_email)) && ($show_email == 'on'))) : ?><p class="sci-address-email"><?php if (isset($show_email_label) && $show_email_label == 'on') : ?><span><?php _e("Email:"); ?> </span><?php endif; ?><a href="mailto:<?php echo $email; ?>" rel="nofollow"><?php echo $email; ?></a></p><?php endif; ?>
			</div>
		<?php echo $after_widget; ?>
		<?php
	}
}

// Load the widget on widgets_init
function sci_widget_info_init() {
	register_widget('SCI_Info_Widget');
}
add_action('widgets_init', 'sci_widget_info_init');
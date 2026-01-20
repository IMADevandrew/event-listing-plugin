<?php
/**
 * Event Metaboxes and Custom Fields
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register event metaboxes
 */
function event_listing_register_metaboxes() {
	add_meta_box(
		'event_details',
		__( 'Event Details', 'event-listing' ),
		'event_listing_render_event_details_metabox',
		'event',
		'normal',
		'high'
	);

	add_meta_box(
		'event_venue',
		__( 'Venue Information', 'event-listing' ),
		'event_listing_render_venue_metabox',
		'event',
		'normal',
		'high'
	);

	add_meta_box(
		'event_contact',
		__( 'Contact Information', 'event-listing' ),
		'event_listing_render_contact_metabox',
		'event',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'event_listing_register_metaboxes' );

/**
 * Render event details metabox
 */
function event_listing_render_event_details_metabox( $post ) {
	wp_nonce_field( 'event_listing_nonce', 'event_listing_nonce' );

	$start_date = get_post_meta( $post->ID, '_event_start_date', true );
	$start_time = get_post_meta( $post->ID, '_event_start_time', true );
	$end_date   = get_post_meta( $post->ID, '_event_end_date', true );
	$end_time   = get_post_meta( $post->ID, '_event_end_time', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="event_start_date"><?php _e( 'Start Date', 'event-listing' ); ?></label></th>
			<td>
				<input type="date" id="event_start_date" name="event_start_date" value="<?php echo esc_attr( $start_date ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_start_time"><?php _e( 'Start Time', 'event-listing' ); ?></label></th>
			<td>
				<input type="time" id="event_start_time" name="event_start_time" value="<?php echo esc_attr( $start_time ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_end_date"><?php _e( 'End Date', 'event-listing' ); ?></label></th>
			<td>
				<input type="date" id="event_end_date" name="event_end_date" value="<?php echo esc_attr( $end_date ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_end_time"><?php _e( 'End Time', 'event-listing' ); ?></label></th>
			<td>
				<input type="time" id="event_end_time" name="event_end_time" value="<?php echo esc_attr( $end_time ); ?>" />
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Render venue metabox
 */
function event_listing_render_venue_metabox( $post ) {
	$venue_name    = get_post_meta( $post->ID, '_event_venue_name', true );
	$venue_address = get_post_meta( $post->ID, '_event_venue_address', true );
	$venue_city    = get_post_meta( $post->ID, '_event_venue_city', true );
	$venue_state   = get_post_meta( $post->ID, '_event_venue_state', true );
	$venue_zip     = get_post_meta( $post->ID, '_event_venue_zip', true );
	$venue_phone   = get_post_meta( $post->ID, '_event_venue_phone', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="event_venue_name"><?php _e( 'Venue Name', 'event-listing' ); ?></label></th>
			<td>
				<input type="text" id="event_venue_name" name="event_venue_name" class="widefat" value="<?php echo esc_attr( $venue_name ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_venue_address"><?php _e( 'Address', 'event-listing' ); ?></label></th>
			<td>
				<input type="text" id="event_venue_address" name="event_venue_address" class="widefat" value="<?php echo esc_attr( $venue_address ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_venue_city"><?php _e( 'City', 'event-listing' ); ?></label></th>
			<td>
				<input type="text" id="event_venue_city" name="event_venue_city" class="widefat" value="<?php echo esc_attr( $venue_city ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_venue_state"><?php _e( 'State', 'event-listing' ); ?></label></th>
			<td>
				<input type="text" id="event_venue_state" name="event_venue_state" value="<?php echo esc_attr( $venue_state ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_venue_zip"><?php _e( 'ZIP Code', 'event-listing' ); ?></label></th>
			<td>
				<input type="text" id="event_venue_zip" name="event_venue_zip" value="<?php echo esc_attr( $venue_zip ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_venue_phone"><?php _e( 'Venue Phone', 'event-listing' ); ?></label></th>
			<td>
				<input type="tel" id="event_venue_phone" name="event_venue_phone" value="<?php echo esc_attr( $venue_phone ); ?>" />
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Render contact metabox
 */
function event_listing_render_contact_metabox( $post ) {
	$contact_name  = get_post_meta( $post->ID, '_event_contact_name', true );
	$contact_email = get_post_meta( $post->ID, '_event_contact_email', true );
	$contact_phone = get_post_meta( $post->ID, '_event_contact_phone', true );
	$contact_url   = get_post_meta( $post->ID, '_event_contact_url', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="event_contact_name"><?php _e( 'Contact Name', 'event-listing' ); ?></label></th>
			<td>
				<input type="text" id="event_contact_name" name="event_contact_name" class="widefat" value="<?php echo esc_attr( $contact_name ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_contact_email"><?php _e( 'Email', 'event-listing' ); ?></label></th>
			<td>
				<input type="email" id="event_contact_email" name="event_contact_email" class="widefat" value="<?php echo esc_attr( $contact_email ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_contact_phone"><?php _e( 'Phone', 'event-listing' ); ?></label></th>
			<td>
				<input type="tel" id="event_contact_phone" name="event_contact_phone" value="<?php echo esc_attr( $contact_phone ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="event_contact_url"><?php _e( 'Website', 'event-listing' ); ?></label></th>
			<td>
				<input type="url" id="event_contact_url" name="event_contact_url" class="widefat" value="<?php echo esc_attr( $contact_url ); ?>" />
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save event metabox data
 */
function event_listing_save_metabox_data( $post_id ) {
	// Verify nonce
	if ( ! isset( $_POST['event_listing_nonce'] ) || ! wp_verify_nonce( $_POST['event_listing_nonce'], 'event_listing_nonce' ) ) {
		return;
	}

	// Check if user has permission
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Prevent autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Save event details
	$fields = array(
		'event_start_date'    => '_event_start_date',
		'event_start_time'    => '_event_start_time',
		'event_end_date'      => '_event_end_date',
		'event_end_time'      => '_event_end_time',
		'event_venue_name'    => '_event_venue_name',
		'event_venue_address' => '_event_venue_address',
		'event_venue_city'    => '_event_venue_city',
		'event_venue_state'   => '_event_venue_state',
		'event_venue_zip'     => '_event_venue_zip',
		'event_venue_phone'   => '_event_venue_phone',
		'event_contact_name'  => '_event_contact_name',
		'event_contact_email' => '_event_contact_email',
		'event_contact_phone' => '_event_contact_phone',
		'event_contact_url'   => '_event_contact_url',
	);

	foreach ( $fields as $field_key => $meta_key ) {
		if ( isset( $_POST[ $field_key ] ) ) {
			$value = sanitize_text_field( $_POST[ $field_key ] );
			update_post_meta( $post_id, $meta_key, $value );
		}
	}
}
add_action( 'save_post_event', 'event_listing_save_metabox_data' );

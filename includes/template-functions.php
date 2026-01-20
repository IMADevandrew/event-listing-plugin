<?php
/**
 * Template Functions for Event Display
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get event start date formatted
 */
function event_listing_get_start_date( $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$start_date = get_post_meta( $post_id, '_event_start_date', true );
	$start_time = get_post_meta( $post_id, '_event_start_time', true );

	if ( ! $start_date ) {
		return '';
	}

	$formatted = date( 'F j, Y', strtotime( $start_date ) );
	if ( $start_time ) {
		$formatted .= ' @ ' . date( 'g:i A', strtotime( $start_time ) );
	}

	return $formatted;
}

/**
 * Get event end date formatted
 */
function event_listing_get_end_date( $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$end_date = get_post_meta( $post_id, '_event_end_date', true );
	$end_time = get_post_meta( $post_id, '_event_end_time', true );

	if ( ! $end_date ) {
		return '';
	}

	$formatted = date( 'F j, Y', strtotime( $end_date ) );
	if ( $end_time ) {
		$formatted .= ' @ ' . date( 'g:i A', strtotime( $end_time ) );
	}

	return $formatted;
}

/**
 * Get venue information
 */
function event_listing_get_venue( $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$venue = array(
		'name'    => get_post_meta( $post_id, '_event_venue_name', true ),
		'address' => get_post_meta( $post_id, '_event_venue_address', true ),
		'city'    => get_post_meta( $post_id, '_event_venue_city', true ),
		'state'   => get_post_meta( $post_id, '_event_venue_state', true ),
		'zip'     => get_post_meta( $post_id, '_event_venue_zip', true ),
		'phone'   => get_post_meta( $post_id, '_event_venue_phone', true ),
	);

	return $venue;
}

/**
 * Get formatted venue address
 */
function event_listing_get_venue_address_formatted( $post_id = null ) {
	$venue = event_listing_get_venue( $post_id );

	if ( ! $venue['address'] ) {
		return '';
	}

	$address = $venue['address'];
	if ( $venue['city'] ) {
		$address .= ', ' . $venue['city'];
	}
	if ( $venue['state'] ) {
		$address .= ', ' . $venue['state'];
	}
	if ( $venue['zip'] ) {
		$address .= ' ' . $venue['zip'];
	}

	return $address;
}

/**
 * Get contact information
 */
function event_listing_get_contact( $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	$contact = array(
		'name'  => get_post_meta( $post_id, '_event_contact_name', true ),
		'email' => get_post_meta( $post_id, '_event_contact_email', true ),
		'phone' => get_post_meta( $post_id, '_event_contact_phone', true ),
		'url'   => get_post_meta( $post_id, '_event_contact_url', true ),
	);

	return $contact;
}

/**
 * Get upcoming events
 */
function event_listing_get_upcoming_events( $limit = 10 ) {
	$args = array(
		'post_type'      => 'event',
		'posts_per_page' => $limit,
		'orderby'        => 'meta_value',
		'meta_key'       => '_event_start_date',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => '_event_start_date',
				'value'   => current_time( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATE',
			),
		),
	);

	return new WP_Query( $args );
}

/**
 * Get past events
 */
function event_listing_get_past_events( $limit = 10 ) {
	$args = array(
		'post_type'      => 'event',
		'posts_per_page' => $limit,
		'orderby'        => 'meta_value',
		'meta_key'       => '_event_start_date',
		'order'          => 'DESC',
		'meta_query'     => array(
			array(
				'key'     => '_event_start_date',
				'value'   => current_time( 'Y-m-d' ),
				'compare' => '<',
				'type'    => 'DATE',
			),
		),
	);

	return new WP_Query( $args );
}

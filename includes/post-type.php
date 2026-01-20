<?php
/**
 * Register Event Custom Post Type
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Event post type
 */
function event_listing_register_post_type() {
	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'event-listing' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'event-listing' ),
		'menu_name'             => __( 'Events', 'event-listing' ),
		'name_admin_bar'        => __( 'Event', 'event-listing' ),
		'archives'              => __( 'Event Archives', 'event-listing' ),
		'attributes'            => __( 'Event Attributes', 'event-listing' ),
		'parent_item_colon'     => __( 'Parent Event:', 'event-listing' ),
		'all_items'             => __( 'All Events', 'event-listing' ),
		'add_new_item'          => __( 'Add New Event', 'event-listing' ),
		'add_new'               => __( 'Add New', 'event-listing' ),
		'new_item'              => __( 'New Event', 'event-listing' ),
		'edit_item'             => __( 'Edit Event', 'event-listing' ),
		'update_item'           => __( 'Update Event', 'event-listing' ),
		'view_item'             => __( 'View Event', 'event-listing' ),
		'view_items'            => __( 'View Events', 'event-listing' ),
		'search_items'          => __( 'Search Event', 'event-listing' ),
		'not_found'             => __( 'Not found', 'event-listing' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'event-listing' ),
		'featured_image'        => __( 'Featured Image', 'event-listing' ),
		'set_featured_image'    => __( 'Set featured image', 'event-listing' ),
		'remove_featured_image' => __( 'Remove featured image', 'event-listing' ),
		'use_featured_image'    => __( 'Use as featured image', 'event-listing' ),
		'insert_into_item'      => __( 'Insert into Event', 'event-listing' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Event', 'event-listing' ),
		'items_list'            => __( 'Events list', 'event-listing' ),
		'items_list_navigation' => __( 'Events list navigation', 'event-listing' ),
		'filter_items_list'     => __( 'Filter Events list', 'event-listing' ),
	);

	$args = array(
		'label'               => __( 'Event', 'event-listing' ),
		'description'         => __( 'Custom post type for managing events', 'event-listing' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'comments' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-calendar-alt',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'show_in_rest'        => true,
		'rest_base'           => 'events',
		'can_export'          => true,
		'has_archive'         => 'events',
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array(
			'slug'       => 'event',
			'with_front' => true,
		),
	);

	register_post_type( 'event', $args );
}

/**
 * Register event categories taxonomy
 */
function event_listing_register_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Event Categories', 'Taxonomy General Name', 'event-listing' ),
		'singular_name'              => _x( 'Event Category', 'Taxonomy Singular Name', 'event-listing' ),
		'menu_name'                  => __( 'Categories', 'event-listing' ),
		'all_items'                  => __( 'All Categories', 'event-listing' ),
		'parent_item'                => __( 'Parent Category', 'event-listing' ),
		'parent_item_colon'          => __( 'Parent Category:', 'event-listing' ),
		'new_item_name'              => __( 'New Category Name', 'event-listing' ),
		'add_new_item'               => __( 'Add New Category', 'event-listing' ),
		'edit_item'                  => __( 'Edit Category', 'event-listing' ),
		'update_item'                => __( 'Update Category', 'event-listing' ),
		'view_item'                  => __( 'View Category', 'event-listing' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'event-listing' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'event-listing' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'event-listing' ),
		'popular_items'              => __( 'Popular Categories', 'event-listing' ),
		'search_items'               => __( 'Search Categories', 'event-listing' ),
		'not_found'                  => __( 'Not Found', 'event-listing' ),
		'no_terms'                   => __( 'No categories', 'event-listing' ),
		'items_list'                 => __( 'Categories list', 'event-listing' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'event-listing' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rest_base'         => 'event-categories',
		'rewrite'           => array(
			'slug'       => 'event-category',
			'with_front' => true,
		),
	);

	register_taxonomy( 'event_category', array( 'event' ), $args );
}
add_action( 'init', 'event_listing_register_taxonomy', 0 );

<?php
/**
 * Plugin Name: Event Listing
 * Plugin URI: https://example.com/event-listing
 * Description: A comprehensive WordPress plugin for managing and displaying events with custom post type functionality.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: event-listing
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'EVENT_LISTING_VERSION', '1.0.0' );
define( 'EVENT_LISTING_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EVENT_LISTING_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'EVENT_LISTING_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Load plugin includes
 */
require_once EVENT_LISTING_PLUGIN_DIR . 'includes/post-type.php';
require_once EVENT_LISTING_PLUGIN_DIR . 'includes/metaboxes.php';
require_once EVENT_LISTING_PLUGIN_DIR . 'includes/template-functions.php';
require_once EVENT_LISTING_PLUGIN_DIR . 'includes/shortcodes.php';

/**
 * Initialize plugin on WordPress init hook
 */
function event_listing_init() {
	// Register custom post type
	event_listing_register_post_type();
	
	// Register metaboxes
	event_listing_register_metaboxes();
}
add_action( 'init', 'event_listing_init' );

/**
 * Enqueue scripts and styles
 */
function event_listing_enqueue_assets() {
	// CSS
	wp_enqueue_style(
		'event-listing-styles',
		EVENT_LISTING_PLUGIN_URL . 'assets/css/event-listing.css',
		array(),
		EVENT_LISTING_VERSION
	);

	// JavaScript
	wp_enqueue_script(
		'event-listing-scripts',
		EVENT_LISTING_PLUGIN_URL . 'assets/js/event-listing.js',
		array( 'jquery' ),
		EVENT_LISTING_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'event_listing_enqueue_assets' );

/**
 * Plugin activation
 */
function event_listing_activate() {
	event_listing_register_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'event_listing_activate' );

/**
 * Plugin deactivation
 */
function event_listing_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'event_listing_deactivate' );

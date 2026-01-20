<?php
/**
 * Shortcode: [event_listing]
 * Displays upcoming events
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Upcoming events shortcode
 */
function event_listing_upcoming_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'limit'    => 10,
			'category' => '',
			'layout'   => 'list', // 'list' or 'grid'
		),
		$atts,
		'event_listing'
	);

	$args = array(
		'post_type'      => 'event',
		'posts_per_page' => intval( $atts['limit'] ),
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

	if ( ! empty( $atts['category'] ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'event_category',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $atts['category'] ),
			),
		);
	}

	$query = new WP_Query( $args );
	$layout = $atts['layout'] === 'grid' ? 'event-listing-grid' : 'event-listing-list';

	ob_start();
	?>
	<div class="event-listing-container <?php echo esc_attr( $layout ); ?>">
		<?php
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				event_listing_display_event_item();
			}
			wp_reset_postdata();
		} else {
			echo '<p>' . __( 'No upcoming events found.', 'event-listing' ) . '</p>';
		}
		?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'event_listing', 'event_listing_upcoming_shortcode' );

/**
 * Display single event item
 */
function event_listing_display_event_item() {
	$post_id = get_the_ID();
	$venue   = event_listing_get_venue( $post_id );
	$contact = event_listing_get_contact( $post_id );
	?>
	<div class="event-listing-item">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="event-listing-thumbnail">
				<?php the_post_thumbnail( 'medium' ); ?>
			</div>
		<?php endif; ?>

		<h3>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>

		<div class="event-listing-meta">
			<div class="event-listing-meta-item">
				<span class="event-listing-meta-icon">📅</span>
				<span><?php echo esc_html( event_listing_get_start_date( $post_id ) ); ?></span>
			</div>

			<?php if ( ! empty( $venue['name'] ) ) : ?>
				<div class="event-listing-meta-item">
					<span class="event-listing-meta-icon">📍</span>
					<span><?php echo esc_html( $venue['name'] ); ?></span>
				</div>
			<?php endif; ?>
		</div>

		<?php
		$excerpt = get_the_excerpt();
		if ( ! empty( $excerpt ) ) {
			echo '<div class="event-listing-excerpt">' . wp_kses_post( $excerpt ) . '</div>';
		}
		?>

		<?php if ( ! empty( $venue['address'] ) ) : ?>
			<div class="event-listing-venue">
				<h4><?php _e( 'Venue', 'event-listing' ); ?></h4>
				<p>
					<strong><?php echo esc_html( $venue['name'] ); ?></strong><br />
					<?php echo esc_html( event_listing_get_venue_address_formatted( $post_id ) ); ?>
					<?php if ( ! empty( $venue['phone'] ) ) : ?>
						<br /><?php echo esc_html( $venue['phone'] ); ?>
					<?php endif; ?>
				</p>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $contact['email'] ) || ! empty( $contact['phone'] ) ) : ?>
			<div class="event-listing-contact">
				<h4><?php _e( 'Contact', 'event-listing' ); ?></h4>
				<?php if ( ! empty( $contact['name'] ) ) : ?>
					<p><strong><?php echo esc_html( $contact['name'] ); ?></strong></p>
				<?php endif; ?>
				<?php if ( ! empty( $contact['email'] ) ) : ?>
					<p>
						<?php _e( 'Email:', 'event-listing' ); ?>
						<a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>">
							<?php echo esc_html( $contact['email'] ); ?>
						</a>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $contact['phone'] ) ) : ?>
					<p>
						<?php _e( 'Phone:', 'event-listing' ); ?>
						<a href="tel:<?php echo esc_attr( $contact['phone'] ); ?>">
							<?php echo esc_html( $contact['phone'] ); ?>
						</a>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="event-listing-button">
			<?php _e( 'View Event', 'event-listing' ); ?>
		</a>
	</div>
	<?php
}

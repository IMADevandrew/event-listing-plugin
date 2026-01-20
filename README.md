# Event Listing WordPress Plugin

A comprehensive WordPress plugin for managing and displaying events with a custom post type.

## Features

- **Custom Event Post Type**: Full-featured "event" post type with all standard WordPress capabilities
- **Event Details**: Store start/end dates and times for each event
- **Venue Information**: Capture venue name, address, city, state, and ZIP code
- **Contact Information**: Store contact person details, email, phone, and website
- **Event Categories**: Organize events with hierarchical taxonomy
- **Shortcodes**: Display upcoming events with `[event_listing]` shortcode
- **Responsive Design**: Mobile-friendly event listing layout
- **Template Functions**: Helper functions to retrieve and display event data

## Installation

1. Upload the `event-listing-plugin` folder to `/wp-content/plugins/`
2. Activate the plugin through the WordPress admin dashboard
3. Go to **Events** in the admin menu to start creating events

## Usage

### Creating Events

1. Navigate to **Events** in the WordPress admin menu
2. Click **Add New Event**
3. Fill in the event details:
   - **Title**: Event name
   - **Description**: Full event description (editor)
   - **Event Details**: Start/end dates and times
   - **Venue Information**: Venue details
   - **Contact Information**: Contact person information
4. Assign event categories as needed
5. Add a featured image if desired
6. Publish the event

### Displaying Events

#### Using the Shortcode

Add the following shortcode to any page or post:

```
[event_listing limit="10" layout="list"]
```

**Shortcode Parameters:**
- `limit` (integer): Number of events to display (default: 10)
- `category` (string): Filter by event category slug (optional)
- `layout` (string): Display layout - "list" or "grid" (default: list)

#### Examples

Display 5 upcoming events in grid layout:
```
[event_listing limit="5" layout="grid"]
```

Display events from a specific category:
```
[event_listing category="conferences" limit="15"]
```

### Template Functions

Use these functions in your theme templates:

**Get Event Start Date**
```php
echo event_listing_get_start_date( $post_id );
// Returns: "January 20, 2026 @ 2:00 PM"
```

**Get Event End Date**
```php
echo event_listing_get_end_date( $post_id );
```

**Get Venue Information**
```php
$venue = event_listing_get_venue( $post_id );
echo $venue['name'];
echo $venue['address'];
echo $venue['city'];
```

**Get Formatted Venue Address**
```php
echo event_listing_get_venue_address_formatted( $post_id );
// Returns: "123 Main St, New York, NY 10001"
```

**Get Contact Information**
```php
$contact = event_listing_get_contact( $post_id );
echo $contact['name'];
echo $contact['email'];
echo $contact['phone'];
echo $contact['url'];
```

**Get Upcoming Events Query**
```php
$upcoming = event_listing_get_upcoming_events( 10 );
if ( $upcoming->have_posts() ) {
    while ( $upcoming->have_posts() ) {
        $upcoming->the_post();
        // Display event
    }
    wp_reset_postdata();
}
```

**Get Past Events Query**
```php
$past = event_listing_get_past_events( 10 );
if ( $past->have_posts() ) {
    while ( $past->have_posts() ) {
        $past->the_post();
        // Display event
    }
    wp_reset_postdata();
}
```

## File Structure

```
event-listing-plugin/
├── event-listing.php              # Main plugin file
├── README.md                       # This file
├── includes/
│   ├── post-type.php             # Custom post type registration
│   ├── metaboxes.php             # Metabox fields and saving
│   ├── template-functions.php    # Template helper functions
│   └── shortcodes.php            # Shortcode definitions
├── assets/
│   ├── css/
│   │   └── event-listing.css     # Plugin styles
│   └── js/
│       └── event-listing.js      # Plugin scripts
└── templates/                     # Custom template files
```

## Customization

### Styling

Edit `assets/css/event-listing.css` to customize the appearance of event listings. The plugin uses the following CSS classes:

- `.event-listing-container`: Main container
- `.event-listing-item`: Individual event item
- `.event-listing-meta`: Event metadata (date, venue)
- `.event-listing-venue`: Venue information section
- `.event-listing-contact`: Contact information section
- `.event-listing-button`: View event button

### Custom Templates

Create custom templates in your theme by copying template files from the plugin and modifying them.

## Requirements

- WordPress 5.0+
- PHP 7.4+

## Support

For issues, feature requests, or contributions, please contact the plugin author.

## Changelog

### Version 1.0.0
- Initial release
- Custom event post type
- Event details, venue, and contact metaboxes
- Event categories taxonomy
- Shortcode for displaying events
- Template functions for custom implementation
- Responsive CSS styling

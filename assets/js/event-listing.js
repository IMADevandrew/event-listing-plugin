/**
 * Event Listing JavaScript
 */

(function( $ ) {
	'use strict';

	$(document).ready( function() {
		// Add event filters if needed
		$( '.event-listing-container' ).on( 'click', '.event-listing-filter', function() {
			var filter = $(this).data( 'filter' );
			var category = $(this).data( 'category' );

			// Filter events based on category
			$( '.event-listing-item' ).show();

			if ( category ) {
				$( '.event-listing-item' ).each( function() {
					if ( ! $(this).hasClass( 'category-' + category ) ) {
						$(this).hide();
					}
				});
			}
		});

		// Smooth scroll to event details
		$( 'a[href^="#event-"]' ).on( 'click', function( e ) {
			e.preventDefault();
			var target = $( this.getAttribute( 'href' ) );
			if ( target.length ) {
				$( 'html, body' ).stop().animate({
					scrollTop: target.offset().top - 100
				}, 1000 );
			}
		});
	});

})( jQuery );

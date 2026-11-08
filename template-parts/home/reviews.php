<?php
/**
 * Template Part: Homepage Google reviews
 *
 * Renders nothing for visitors until Google reviews are connected in
 * WP Admin, Settings, Google reviews (see inc/google-reviews.php).
 *
 * @package Datalkemi
 * @since   2.3.0
 */

if ( function_exists( 'datalkemi_render_google_reviews' ) ) {
	echo datalkemi_render_google_reviews(); // phpcs:ignore WordPress.Security.EscapeOutput
}

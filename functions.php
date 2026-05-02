<?php
/**
 * Datalkemi Theme Functions
 */

defined( 'ABSPATH' ) || exit;

define( 'DATALKEMI_VERSION', '1.1.0' );
define( 'DATALKEMI_DIR', get_stylesheet_directory() );
define( 'DATALKEMI_URI', get_stylesheet_directory_uri() );

// ── Load includes ──────────────────────────────────────────────────────────
require_once DATALKEMI_DIR . '/inc/enqueue.php';
require_once DATALKEMI_DIR . '/inc/menus.php';
require_once DATALKEMI_DIR . '/inc/post-types.php';
require_once DATALKEMI_DIR . '/inc/service-data.php';
require_once DATALKEMI_DIR . '/inc/client-portal.php';
require_once DATALKEMI_DIR . '/inc/configurator-data.php';

// ── Theme setup ────────────────────────────────────────────────────────────
function datalkemi_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	load_child_theme_textdomain( 'datalkemi', DATALKEMI_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'datalkemi_setup' );

// ── Excerpt length ─────────────────────────────────────────────────────────
function datalkemi_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'datalkemi_excerpt_length' );

// ── Custom excerpt "read more" link ────────────────────────────────────────
function datalkemi_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'datalkemi_excerpt_more' );

// ── Body class additions ───────────────────────────────────────────────────
function datalkemi_body_classes( array $classes ): array {
	if ( is_user_logged_in() ) {
		$user = wp_get_current_user();
		if ( in_array( 'client', (array) $user->roles, true ) ) {
			$classes[] = 'is-client';
		}
	}
	return $classes;
}
add_filter( 'body_class', 'datalkemi_body_classes' );

// ── Disable comments site-wide ─────────────────────────────────────────────
function datalkemi_disable_comments( $open, $post_id ) {
	return false;
}
add_filter( 'comments_open', 'datalkemi_disable_comments', 20, 2 );
add_filter( 'pings_open',    'datalkemi_disable_comments', 20, 2 );

// ── Configurator AJAX handler ───────────────────────────────────────────────
function datalkemi_configurator_submit() {
	check_ajax_referer( 'dk_configurator_submit', 'nonce' );

	$name    = sanitize_text_field( $_POST['name']    ?? '' );
	$email   = sanitize_email(      $_POST['email']   ?? '' );
	$company = sanitize_text_field( $_POST['company'] ?? '' );
	$notes   = sanitize_textarea_field( $_POST['notes'] ?? '' );
	$summary = sanitize_textarea_field( $_POST['summary'] ?? '' );
	$total   = absint( $_POST['total'] ?? 0 );

	if ( ! $name || ! is_email( $email ) ) {
		wp_send_json_error( 'Invalid submission.' );
	}

	$admin_email = get_option( 'admin_email' );
	$subject     = 'New Project Quote £' . number_format( $total ) . ' ' . $name;

	$body  = "New project quote request received via the Datalkemi configurator.\n\n";
	$body .= "Name:    {$name}\n";
	$body .= "Email:   {$email}\n";
	$body .= "Company: {$company}\n\n";
	$body .= $summary . "\n\n";
	if ( $notes ) {
		$body .= "Additional notes:\n{$notes}\n\n";
	}
	$body .= "---\nReply to this email to follow up with " . $name . " directly.\n";

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	];

	$sent = wp_mail( $admin_email, $subject, $body, $headers );

	// Confirmation to client
	$client_body  = "Hi {$name},\n\n";
	$client_body .= "Thank you for configuring your project with Datalkemi.\n\n";
	$client_body .= "We have received your estimated quote of £" . number_format( $total ) . " and will review it personally.\n";
	$client_body .= "A member of our team will be in touch within one business day.\n\n";
	$client_body .= $summary . "\n\n";
	$client_body .= "Questions? Just reply to this email.\n\nThe Datalkemi Team\nhttps://datalkemi.com\n";

	wp_mail( $email, 'Your Datalkemi Project Quote', $client_body, [ 'Content-Type: text/plain; charset=UTF-8' ] );

	if ( $sent ) {
		wp_send_json_success( 'Quote sent.' );
	} else {
		wp_send_json_error( 'Mail failed.' );
	}
}
add_action( 'wp_ajax_dk_submit_configurator',        'datalkemi_configurator_submit' );
add_action( 'wp_ajax_nopriv_dk_submit_configurator', 'datalkemi_configurator_submit' );

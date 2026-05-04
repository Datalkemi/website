<?php
/**
 * Newsletter AJAX handler  -  HubSpot Forms API integration.
 *
 * Required constants in wp-config.php:
 *
 *   define( 'DATALKEMI_HUBSPOT_PORTAL_ID',           '443133574' );
 *   define( 'DATALKEMI_HUBSPOT_NEWSLETTER_FORM_ID',  '9c2c3b72-57b2-4db9-8ce9-6ab40e48d133' );
 *   define( 'DATALKEMI_HUBSPOT_REGION',              'ap1' );   // informational; not used in endpoint URL
 *   define( 'DATALKEMI_ABN',                         '' );      // leave empty until ABN is confirmed
 *
 * HubSpot endpoint:
 *   POST https://api.hsforms.com/submissions/v3/integration/submit/{PORTAL_ID}/{FORM_GUID}
 *   Content-Type: application/json
 *
 * Rate limiting: max 3 submissions per IP per hour via WP transients.
 * Honeypot: field name "website_url"  -  silently rejected if non-empty.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_ajax_datalkemi_newsletter',        'datalkemi_newsletter_submit' );
add_action( 'wp_ajax_nopriv_datalkemi_newsletter', 'datalkemi_newsletter_submit' );

function datalkemi_newsletter_submit(): void {

	check_ajax_referer( 'dk_newsletter_submit', 'nonce' );

	// Honeypot  -  silent success so bots think the submission worked.
	if ( ! empty( $_POST['website_url'] ) ) {
		wp_send_json_success( 'subscribed' );
	}

	$email = sanitize_email( $_POST['email'] ?? '' );

	if ( ! is_email( $email ) ) {
		wp_send_json_error( 'invalid_email' );
	}

	// Rate limiting: 3 submissions per IP per hour.
	$ip         = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0' );
	$rate_key   = 'dk_nl_rate_' . md5( $ip );
	$rate_count = (int) get_transient( $rate_key );

	if ( $rate_count >= 3 ) {
		wp_send_json_error( 'rate_limited' );
	}

	set_transient( $rate_key, $rate_count + 1, HOUR_IN_SECONDS );

	// Resolve HubSpot credentials.
	$portal_id = defined( 'DATALKEMI_HUBSPOT_PORTAL_ID' )          ? DATALKEMI_HUBSPOT_PORTAL_ID          : '';
	$form_id   = defined( 'DATALKEMI_HUBSPOT_NEWSLETTER_FORM_ID' ) ? DATALKEMI_HUBSPOT_NEWSLETTER_FORM_ID : '';

	if ( ! $portal_id || ! $form_id ) {
		error_log( 'Datalkemi newsletter: DATALKEMI_HUBSPOT_PORTAL_ID or DATALKEMI_HUBSPOT_NEWSLETTER_FORM_ID not configured.' );
		wp_send_json_error( 'not_configured' );
	}

	$endpoint  = "https://api.hsforms.com/submissions/v3/integration/submit/{$portal_id}/{$form_id}";
	$page_uri  = esc_url_raw( sanitize_text_field( $_POST['page_uri']  ?? home_url() ) );
	$page_name = sanitize_text_field( $_POST['page_name'] ?? get_bloginfo( 'name' ) );

	$payload = wp_json_encode( [
		'fields'  => [
			[ 'name' => 'email', 'value' => $email ],
		],
		'context' => [
			'pageUri'  => $page_uri,
			'pageName' => $page_name,
		],
	] );

	$response = wp_remote_post( $endpoint, [
		'headers' => [ 'Content-Type' => 'application/json' ],
		'body'    => $payload,
		'timeout' => 10,
	] );

	if ( is_wp_error( $response ) ) {
		error_log( 'Datalkemi newsletter: wp_remote_post error  -  ' . $response->get_error_message() );
		wp_send_json_error( 'request_failed' );
	}

	$status = (int) wp_remote_retrieve_response_code( $response );

	if ( $status === 200 ) {
		wp_send_json_success( 'subscribed' );
	}

	error_log( 'Datalkemi newsletter: HubSpot returned HTTP ' . $status . '  -  ' . wp_remote_retrieve_body( $response ) );
	wp_send_json_error( 'hubspot_error' );
}

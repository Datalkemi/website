<?php
/**
 * Datalkemi  -  Transactional email via Brevo REST API
 *
 * Uses wp_remote_post() instead of SMTP so there are no auth issues.
 * Add ONE constant to wp-config.php (remove any old DK_SMTP_* lines):
 *
 *   define( 'DK_BREVO_API_KEY',  'xkeysib-xxxxxxxx...' );  // Brevo → Settings → SMTP & API → API Keys tab
 *   define( 'DK_MAIL_FROM',      'info@datalkemi.com' );
 *   define( 'DK_MAIL_FROM_NAME', 'Datalkemi' );
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'DK_BREVO_API_KEY' ) ) {
	return; // silently skip if not configured
}

/**
 * Intercept wp_mail() and send via Brevo transactional email API.
 * Returning non-null short-circuits WordPress's built-in mailer.
 */
add_filter( 'pre_wp_mail', 'datalkemi_send_via_brevo_api', 10, 2 );

function datalkemi_send_via_brevo_api( $null, array $atts ): bool|null {
	$to      = is_array( $atts['to'] ) ? $atts['to'] : array_map( 'trim', explode( ',', $atts['to'] ) );
	$subject = $atts['subject'] ?? '';
	$message = $atts['message'] ?? '';
	$headers = is_array( $atts['headers'] ) ? $atts['headers'] : explode( "\n", str_replace( "\r\n", "\n", $atts['headers'] ) );

	// Build recipient list
	$recipients = array_values( array_filter( array_map( function ( $email ) {
		$email = trim( $email );
		return $email ? [ 'email' => $email ] : null;
	}, $to ) ) );

	if ( empty( $recipients ) ) {
		return false;
	}

	// Parse Reply-To from headers
	$reply_to = null;
	foreach ( $headers as $header ) {
		if ( stripos( $header, 'Reply-To:' ) === 0 ) {
			$raw = trim( substr( $header, 9 ) );
			// Handle "Name <email>" or bare email
			if ( preg_match( '/^(.*?)<(.+?)>$/', $raw, $m ) ) {
				$reply_to = [ 'name' => trim( $m[1] ), 'email' => trim( $m[2] ) ];
			} else {
				$reply_to = [ 'email' => $raw ];
			}
			break;
		}
	}

	// Detect HTML content
	$is_html   = ( $message !== strip_tags( $message ) );
	$content_key = $is_html ? 'htmlContent' : 'textContent';

	$from_name  = defined( 'DK_MAIL_FROM_NAME' ) ? DK_MAIL_FROM_NAME : get_option( 'blogname' );
	$from_email = defined( 'DK_MAIL_FROM' )      ? DK_MAIL_FROM      : get_option( 'admin_email' );

	$body = [
		'sender'     => [ 'name' => $from_name, 'email' => $from_email ],
		'to'         => $recipients,
		'subject'    => $subject,
		$content_key => $message,
	];

	if ( $reply_to ) {
		$body['replyTo'] = $reply_to;
	}

	$response = wp_remote_post( 'https://api.brevo.com/v3/smtp/email', [
		'headers' => [
			'api-key'      => DK_BREVO_API_KEY,
			'Content-Type' => 'application/json',
			'Accept'       => 'application/json',
		],
		'body'    => wp_json_encode( $body ),
		'timeout' => 15,
	] );

	if ( is_wp_error( $response ) ) {
		error_log( '[Datalkemi Brevo API] Request error: ' . $response->get_error_message() );
		return false;
	}

	$code     = (int) wp_remote_retrieve_response_code( $response );
	$api_body = wp_remote_retrieve_body( $response );

	if ( $code === 201 ) {
		error_log( '[Datalkemi Brevo API] Sent OK to: ' . implode( ', ', $to ) );
		return true;
	}

	error_log( '[Datalkemi Brevo API] Failed (HTTP ' . $code . '): ' . $api_body );
	return false;
}

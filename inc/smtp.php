<?php
/**
 * Datalkemi SMTP Configuration
 *
 * Credentials are defined in wp-config.php — never stored here.
 * Required constants (add these to wp-config.php):
 *
 *   define( 'DK_SMTP_HOST',      'smtp-relay.brevo.com' );
 *   define( 'DK_SMTP_PORT',      587 );
 *   define( 'DK_SMTP_USER',      'your-brevo-login@email.com' );
 *   define( 'DK_SMTP_PASS',      'your-brevo-smtp-key' );
 *   define( 'DK_MAIL_FROM',      'info@datalkemi.com' );
 *   define( 'DK_MAIL_FROM_NAME', 'Datalkemi' );
 */

defined( 'ABSPATH' ) || exit;

// Only hook if credentials are present
if ( ! defined( 'DK_SMTP_HOST' ) || ! defined( 'DK_SMTP_PASS' ) ) {
	return;
}

add_action( 'phpmailer_init', 'datalkemi_configure_smtp' );

// Capture and log any mail failures (disable in production once confirmed working)
add_action( 'wp_mail_failed', function ( WP_Error $error ) {
	error_log( '[Datalkemi SMTP] wp_mail failed: ' . $error->get_error_message() );
	error_log( '[Datalkemi SMTP] Error data: ' . print_r( $error->get_error_data(), true ) );
} );

function datalkemi_configure_smtp( PHPMailer\PHPMailer\PHPMailer $mailer ): void {
	$mailer->isSMTP();
	$mailer->Host       = DK_SMTP_HOST;
	$mailer->Port       = defined( 'DK_SMTP_PORT' ) ? (int) DK_SMTP_PORT : 587;
	$mailer->SMTPAuth   = true;
	$mailer->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
	$mailer->Username   = DK_SMTP_USER;
	$mailer->Password   = DK_SMTP_PASS;
	$mailer->From       = defined( 'DK_MAIL_FROM' )      ? DK_MAIL_FROM      : get_option( 'admin_email' );
	$mailer->FromName   = defined( 'DK_MAIL_FROM_NAME' ) ? DK_MAIL_FROM_NAME : get_option( 'blogname' );

	// Verbose debug — writes SMTP conversation to PHP error log
	// Remove once email is confirmed working
	$mailer->SMTPDebug  = 2;
	$mailer->Debugoutput = function( string $msg, int $level ): void {
		error_log( '[Datalkemi SMTP debug] ' . trim( $msg ) );
	};
}

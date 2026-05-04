<?php
/**
 * Template Part: Footer  -  Newsletter signup (middle band)
 *
 * Submits via AJAX to wp_ajax_datalkemi_newsletter (inc/newsletter.php).
 * Falls back to a standard POST when JavaScript is unavailable.
 *
 * Heading options  -  rendering Option A:
 *
 * A (active): Practical insights for finance businesses building better systems.
 *
 * B: Ideas and examples from finance and data projects, sent occasionally.
 *
 * C: How finance businesses use software and data to work better. Sent monthly.
 *
 * @package Datalkemi
 * @since   2.0.0
 */

$hs_portal  = defined( 'DATALKEMI_HUBSPOT_PORTAL_ID' )           && DATALKEMI_HUBSPOT_PORTAL_ID           ? true : false;
$hs_form    = defined( 'DATALKEMI_HUBSPOT_NEWSLETTER_FORM_ID' )  && DATALKEMI_HUBSPOT_NEWSLETTER_FORM_ID  ? true : false;
$show_notice = ( ! $hs_portal || ! $hs_form ) && current_user_can( 'manage_options' );
?>

<div class="ft-newsletter">
	<div class="ft-container">
		<div class="ft-newsletter-inner">

			<div class="ft-newsletter-heading">
				<h3 class="ft-newsletter-title">
					<?php
					/*
					 * Heading  -  rendering Option A.
					 *
					 * A (active): Practical insights for finance businesses building better systems.
					 * B: Ideas and examples from finance and data projects, sent occasionally.
					 * C: How finance businesses use software and data to work better. Sent monthly.
					 */
					esc_html_e( 'Practical insights for finance businesses building better systems.', 'datalkemi' );
					?>
				</h3>
			</div>

			<div class="ft-newsletter-form-wrap">

				<?php if ( $show_notice ) : ?>
					<p class="ft-admin-notice" role="alert">
						<?php esc_html_e( 'HubSpot newsletter form not configured.', 'datalkemi' ); ?>
					</p>
				<?php endif; ?>

				<form
					class="ft-newsletter-form"
					method="post"
					action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
					novalidate
				>
					<input type="hidden" name="action" value="datalkemi_newsletter">
					<input type="hidden" name="nonce"  value="<?php echo esc_attr( wp_create_nonce( 'dk_newsletter_submit' ) ); ?>">

					<!-- Honeypot: hidden from real users, filled only by bots -->
					<input
						type="text"
						name="website_url"
						value=""
						autocomplete="off"
						tabindex="-1"
						aria-hidden="true"
						class="ft-honeypot"
					>

					<div class="ft-newsletter-field-row">
						<label for="ft-nl-email" class="screen-reader-text">
							<?php esc_html_e( 'Email address', 'datalkemi' ); ?>
						</label>
						<input
							type="email"
							id="ft-nl-email"
							name="email"
							class="ft-newsletter-input"
							placeholder="<?php esc_attr_e( 'your@email.com', 'datalkemi' ); ?>"
							required
							autocomplete="email"
						>
						<button type="submit" class="ft-newsletter-btn">
							<?php esc_html_e( 'Subscribe', 'datalkemi' ); ?>
						</button>
					</div>

					<p class="ft-newsletter-privacy">
						<?php esc_html_e( 'We use your email only for occasional insights. Unsubscribe anytime.', 'datalkemi' ); ?>
					</p>

					<div class="ft-newsletter-feedback" aria-live="polite" aria-atomic="true"></div>

				</form>

			</div><!-- /.ft-newsletter-form-wrap -->

		</div><!-- /.ft-newsletter-inner -->
	</div><!-- /.ft-container -->
</div><!-- /.ft-newsletter -->

<?php
/**
 * Template Part: Homepage — Final CTA
 *
 * Closing call-to-action section. Heading options — rendering Option A:
 *
 * A (active): Let's see if we are a good fit.
 *
 * B: The right system starts with a conversation.
 *
 * C: Thirty minutes to understand your problem. No obligation.
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-final-cta" aria-labelledby="final-cta-heading">
	<div class="hp-container">

		<h2 id="final-cta-heading" class="hp-final-cta-heading">
			<?php esc_html_e( "Let’s see if we are a good fit.", 'datalkemi' ); ?>
		</h2>

		<a
			href="BOOKING_URL_PLACEHOLDER"
			class="hp-btn-primary"
		>
			<?php esc_html_e( 'Book a discovery call', 'datalkemi' ); ?>
		</a>

		<p class="hp-final-note">
			<?php esc_html_e( '30-minute call. No obligation. Perth-based, working Australia-wide.', 'datalkemi' ); ?>
		</p>

	</div><!-- /.hp-container -->
</section><!-- /.hp-final-cta -->

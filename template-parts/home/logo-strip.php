<?php
/**
 * Template Part: Homepage Logo Strip
 *
 * Section heading options — rendering Option A:
 *
 * A (active): Trusted by businesses that take their systems seriously.
 *
 * B: Businesses that have replaced guesswork with engineered systems.
 *
 * C: Working with finance and operations teams across Australia.
 *
 * Client logo images should be placed at:
 * /assets/img/clients/client-1.svg through client-6.svg
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-logos">
	<div class="hp-container">

		<p class="hp-logos-label">
			<?php esc_html_e( 'Trusted by businesses that take their systems seriously.', 'datalkemi' ); ?>
		</p>

		<div class="hp-logos-grid">

			<?php for ( $i = 1; $i <= 6; $i++ ) : ?>
				<div class="hp-logo-item">
					<img
						src="<?php echo esc_url( DATALKEMI_URI . '/assets/img/clients/client-' . $i . '.svg' ); ?>"
						loading="lazy"
						alt="<?php
							/* translators: %d: client logo number */
							echo esc_attr( sprintf( __( 'Client logo %d', 'datalkemi' ), $i ) );
						?>"
						width="160"
						height="40"
					/>
				</div>
			<?php endfor; ?>

		</div><!-- /.hp-logos-grid -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-logos -->

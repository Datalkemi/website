<?php
/**
 * Template Part: Footer — Legal row (bottom band)
 *
 * ABN line renders only when DATALKEMI_ABN constant is defined and non-empty.
 * Client Portal is a plain utility link, not a button.
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<div class="ft-legal">
	<div class="ft-container">
		<div class="ft-legal-inner">

			<div class="ft-legal-left">
				<span class="ft-copy">
					&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php esc_html_e( 'Datalkemi. All rights reserved.', 'datalkemi' ); ?>
				</span>

				<?php if ( defined( 'DATALKEMI_ABN' ) && '' !== DATALKEMI_ABN ) : ?>
					<span class="ft-legal-sep" aria-hidden="true">&middot;</span>
					<span class="ft-abn">
						<?php
						/* translators: %s: ABN number */
						echo esc_html( sprintf( __( 'ABN: %s', 'datalkemi' ), DATALKEMI_ABN ) );
						?>
					</span>
				<?php endif; ?>

				<span class="ft-legal-sep" aria-hidden="true">&middot;</span>
				<span class="ft-location">
					<?php esc_html_e( 'Perth, Western Australia', 'datalkemi' ); ?>
				</span>
			</div><!-- /.ft-legal-left -->

			<div class="ft-legal-right">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">
					<?php esc_html_e( 'Privacy policy', 'datalkemi' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">
					<?php esc_html_e( 'Terms of service', 'datalkemi' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>">
					<?php esc_html_e( 'Cookie policy', 'datalkemi' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/client-portal/' ) ); ?>" class="ft-portal-link">
					<?php esc_html_e( 'Client portal', 'datalkemi' ); ?>
				</a>
			</div><!-- /.ft-legal-right -->

		</div><!-- /.ft-legal-inner -->
	</div><!-- /.ft-container -->
</div><!-- /.ft-legal -->

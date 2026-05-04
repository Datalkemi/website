<?php
/**
 * Template Part: Homepage Logo Strip
 *
 * Real client logo files (PNG) are in /assets/img/clients/.
 * Add or remove entries from the $logos array as clients change.
 *
 * @package Datalkemi
 * @since   2.0.0
 */

$logos = [
	[
		'file' => 'KRZ-ColourLogo-FinalPNG.png',
		'alt'  => 'KRZ',
	],
	[
		'file' => 'OzViz_Migration_Logo_Transparent.png',
		'alt'  => 'OzViz Migration',
	],
	[
		'file' => 'Logo.png',
		'alt'  => 'Client',
	],
];
?>

<section class="hp-logos">
	<div class="hp-container">

		<p class="hp-logos-label">
			<?php esc_html_e( 'Working with businesses across Australia.', 'datalkemi' ); ?>
		</p>

		<div class="hp-logos-grid">

			<?php foreach ( $logos as $logo ) : ?>
				<div class="hp-logo-item">
					<img
						src="<?php echo esc_url( DATALKEMI_URI . '/assets/img/clients/' . $logo['file'] ); ?>"
						loading="lazy"
						alt="<?php echo esc_attr( $logo['alt'] ); ?>"
						height="40"
					/>
				</div>
			<?php endforeach; ?>

		</div><!-- /.hp-logos-grid -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-logos -->

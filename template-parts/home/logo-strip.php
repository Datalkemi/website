<?php
/**
 * Template Part: Homepage Logo Strip
 *
 * Client logo files (trimmed PNG, 240px tall) are in /assets/img/clients/.
 * Each logo sits on a white tile so colour marks read in both themes.
 * Add or remove entries from the $logos array as clients change.
 *
 * @package Datalkemi
 * @since   2.0.0
 */

$logos = [
	[
		'file' => 'krz-engineering.png',
		'alt'  => 'KRZ Engineering',
	],
	[
		'file' => 'ozviz-migration.png',
		'alt'  => 'OzViz Migration',
	],
	[
		'file' => 'motive-motors.png',
		'alt'  => 'Motive Motors',
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
						height="48"
					/>
				</div>
			<?php endforeach; ?>

		</div><!-- /.hp-logos-grid -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-logos -->

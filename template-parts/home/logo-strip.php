<?php
/**
 * Template Part: Homepage Logo Strip
 *
 * Client logo files (trimmed PNG, 240px tall) are in /assets/img/clients/.
 * Each logo sits on a white tile so colour marks read in both themes.
 * The strip scrolls continuously: the list is rendered twice and the
 * track is translated by half its width, so the loop is seamless.
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
	[
		'file' => 'cp-study-centre.png',
		'alt'  => 'CP Study Centre',
	],
];
?>

<section class="hp-logos">
	<div class="hp-container">

		<p class="hp-logos-label">
			<?php esc_html_e( 'Working with businesses across Australia.', 'datalkemi' ); ?>
		</p>

		<div class="hp-logos-marquee" aria-label="<?php esc_attr_e( 'Client logos', 'datalkemi' ); ?>">
			<div class="hp-logos-track">
				<?php for ( $pass = 0; $pass < 2; $pass++ ) : ?>
					<div class="hp-logos-grid" <?php echo $pass ? 'aria-hidden="true"' : ''; ?>>
						<?php foreach ( $logos as $logo ) : ?>
							<div class="hp-logo-item">
								<img
									src="<?php echo esc_url( DATALKEMI_URI . '/assets/img/clients/' . $logo['file'] ); ?>"
									alt="<?php echo $pass ? '' : esc_attr( $logo['alt'] ); ?>"
									height="48"
								/>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endfor; ?>
			</div>
		</div><!-- /.hp-logos-marquee -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-logos -->

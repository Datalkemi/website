<?php
/**
 * Product screenshots that follow the site theme.
 *
 * Each screen has four files in assets/img/products/:
 *   exnami-{screen}-light.jpg and exnami-{screen}-dark.jpg     desktop, 2000 x 1118
 *   exnami-{screen}-light-m.jpg and exnami-{screen}-dark-m.jpg phone, 800 x 1058
 * Both versions are printed and CSS shows the one that matches the
 * data-theme attribute on <html>. Images are lazy loaded, so the hidden
 * version is never downloaded.
 *
 * @package Datalkemi
 * @since   2.6.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Prints a light and a dark <picture> for one product screen.
 *
 * @param string $screen File stem, for example 'exnami-dashboard'.
 * @param string $alt    Alt text describing the screen.
 */
function datalkemi_product_shot( string $screen, string $alt ): void {
	$base = DATALKEMI_URI . '/assets/img/products/' . $screen;
	foreach ( [ 'light', 'dark' ] as $theme ) {
		?>
		<picture class="dk-shot dk-shot--<?php echo esc_attr( $theme ); ?>">
			<source media="(max-width: 640px)" srcset="<?php echo esc_url( $base . '-' . $theme . '-m.jpg' ); ?>" width="800" height="1058">
			<img src="<?php echo esc_url( $base . '-' . $theme . '.jpg' ); ?>" alt="<?php echo esc_attr( $alt ); ?>" width="2000" height="1118" loading="lazy" decoding="async">
		</picture>
		<?php
	}
}

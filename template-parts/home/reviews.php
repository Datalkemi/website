<?php
/**
 * Template Part: Homepage Google reviews
 *
 * Shows the Trustindex "Widgets for Google Reviews" slider, which pulls the
 * live reviews from the Google Business Profile. If that plugin is not
 * active, falls back to the theme's own rating section (inc/google-reviews.php).
 *
 * @package Datalkemi
 * @since   2.3.0
 */

$dk_trustindex = shortcode_exists( 'trustindex' ) ? do_shortcode( '[trustindex no-registration=google]' ) : '';
// The widget's own autoplay stops at the last review. Turn it off; main.js
// runs a looping autoplay instead (see "Google reviews slider").
$dk_trustindex = preg_replace( '/data-pager-autoplay-timeout="\d+"/', 'data-pager-autoplay-timeout="0"', $dk_trustindex );

if ( '' !== trim( $dk_trustindex ) ) : ?>
	<section class="dk-reviews dk-reviews--trustindex" aria-labelledby="dk-reviews-title">
		<div class="dk-container">
			<div class="dk-reviews-head">
				<div>
					<p class="section-eyebrow"><?php esc_html_e( 'Google reviews', 'datalkemi' ); ?></p>
					<h2 id="dk-reviews-title" class="dk-reviews-title"><?php esc_html_e( 'What clients say', 'datalkemi' ); ?></h2>
				</div>
			</div>
			<div class="dk-reviews-widget">
				<?php echo $dk_trustindex; // phpcs:ignore WordPress.Security.EscapeOutput -- plugin shortcode output ?>
			</div>
		</div>
	</section>
<?php
elseif ( function_exists( 'datalkemi_render_google_reviews' ) ) :
	echo datalkemi_render_google_reviews(); // phpcs:ignore WordPress.Security.EscapeOutput
endif;

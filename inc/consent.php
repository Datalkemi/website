<?php
/**
 * Cookie consent.
 *
 * HubSpot's tracking script (added by the HubSpot plugin) sets analytics and
 * marketing cookies, so it is held back until the visitor accepts. The tag is
 * printed as inert text/plain with its address in data-dk-src, and
 * assets/js/consent.js swaps in a live script once consent is given.
 *
 * The visitor's choice is stored in the browser (localStorage key
 * dk-consent), not in a cookie. The banner markup is printed in footer.php.
 *
 * @package Datalkemi
 * @since   2.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hold back consent-gated scripts until the visitor opts in.
 */
add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {
	$gated = false !== strpos( (string) $src, 'hs-scripts.com' )
		|| false !== strpos( (string) $handle, 'leadin-script-loader' );
	if ( ! $gated || false !== strpos( $tag, 'data-dk-consent' ) ) {
		return $tag;
	}
	// Only the external loader, never its inline settings block
	if ( false === strpos( $tag, ' src=' ) ) {
		return $tag;
	}
	$tag = preg_replace( '/\s(async|defer)(?=[\s>])/', '', $tag );
	$tag = str_replace( ' src=', ' type="text/plain" data-dk-consent="analytics" data-dk-src=', $tag );
	return $tag;
}, 99, 3 );

/**
 * Keep caching and JS optimisers from rewriting or combining the held-back tag.
 */
add_filter( 'litespeed_optimize_js_excludes', function ( $excludes ) {
	$excludes   = (array) $excludes;
	$excludes[] = 'hs-scripts.com';
	$excludes[] = 'consent.js';
	return $excludes;
} );

/**
 * The banner, printed once in the footer.
 */
function datalkemi_consent_banner() {
	?>
	<div class="dk-consent" id="dk-consent" role="region" aria-labelledby="dk-consent-title" hidden>
		<div class="dk-consent-inner">
			<p class="dk-consent-title" id="dk-consent-title"><?php esc_html_e( 'Cookies on this site', 'datalkemi' ); ?></p>
			<p class="dk-consent-text">
				<?php esc_html_e( 'We use HubSpot analytics cookies to understand which pages are useful and to follow up on enquiries. They only load if you accept. The site works the same either way.', 'datalkemi' ); ?>
				<a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>"><?php esc_html_e( 'Cookie policy', 'datalkemi' ); ?></a>
			</p>
			<div class="dk-consent-actions">
				<button type="button" class="dk-btn dk-btn-outline" data-dk-consent-choice="essential"><?php esc_html_e( 'Essential only', 'datalkemi' ); ?></button>
				<button type="button" class="dk-btn dk-btn-primary" data-dk-consent-choice="all"><?php esc_html_e( 'Accept all', 'datalkemi' ); ?></button>
			</div>
		</div>
	</div>
	<?php
}

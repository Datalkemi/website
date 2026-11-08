<?php
/**
 * Google reviews from the Google Business Profile, through the Places API (New).
 *
 * Setup lives in WP Admin, Settings, Google reviews: an API key with the
 * Places API (New) enabled, and the business's Place ID (the page can look
 * it up by name). Constants DATALKEMI_GOOGLE_PLACES_KEY and
 * DATALKEMI_GOOGLE_PLACE_ID in wp-config.php override the saved values.
 *
 * The API returns up to five reviews, chosen by Google. Responses are cached
 * for 12 hours, and the last good response is kept so the section survives
 * a failed refresh. Nothing renders until reviews are available.
 *
 * Display follows the Google Maps Platform attribution rules: reviews are
 * shown as returned, with the author's name, photo and link, and a
 * "Reviews from Google Maps" credit.
 *
 * @package Datalkemi
 * @since   2.3.0
 */

defined( 'ABSPATH' ) || exit;

const DATALKEMI_REVIEWS_CACHE = 'datalkemi_google_reviews';
const DATALKEMI_REVIEWS_LAST  = 'datalkemi_google_reviews_last';
const DATALKEMI_REVIEWS_ERROR = 'datalkemi_google_reviews_error';

/* --------------------------------------------------------------------------
   Settings
   -------------------------------------------------------------------------- */

function datalkemi_reviews_settings() {
	$key   = defined( 'DATALKEMI_GOOGLE_PLACES_KEY' ) && DATALKEMI_GOOGLE_PLACES_KEY ? DATALKEMI_GOOGLE_PLACES_KEY : (string) get_option( 'datalkemi_google_places_key', '' );
	$place = defined( 'DATALKEMI_GOOGLE_PLACE_ID' ) && DATALKEMI_GOOGLE_PLACE_ID ? DATALKEMI_GOOGLE_PLACE_ID : (string) get_option( 'datalkemi_google_place_id', '' );
	return [
		'key'      => trim( $key ),
		'place_id' => trim( $place ),
		'enabled'  => (bool) get_option( 'datalkemi_google_reviews_enabled', 1 ),
		'key_from_constant'   => defined( 'DATALKEMI_GOOGLE_PLACES_KEY' ) && DATALKEMI_GOOGLE_PLACES_KEY,
		'place_from_constant' => defined( 'DATALKEMI_GOOGLE_PLACE_ID' ) && DATALKEMI_GOOGLE_PLACE_ID,
	];
}

/* --------------------------------------------------------------------------
   Places API calls
   -------------------------------------------------------------------------- */

/**
 * Fetch the place and its reviews. Returns a normalised array or WP_Error.
 */
function datalkemi_fetch_google_place( $key, $place_id ) {
	$url = 'https://places.googleapis.com/v1/places/' . rawurlencode( $place_id ) . '?languageCode=en';
	$res = wp_remote_get( $url, [
		'timeout' => 12,
		'headers' => [
			'X-Goog-Api-Key'   => $key,
			'X-Goog-FieldMask' => 'id,displayName,rating,userRatingCount,googleMapsUri,reviews',
			'Referer'          => home_url( '/' ),
		],
	] );
	if ( is_wp_error( $res ) ) {
		return $res;
	}
	$code = (int) wp_remote_retrieve_response_code( $res );
	$body = json_decode( wp_remote_retrieve_body( $res ), true );
	if ( 200 !== $code || ! is_array( $body ) ) {
		$msg = is_array( $body ) && ! empty( $body['error']['message'] ) ? $body['error']['message'] : 'HTTP ' . $code;
		return new WP_Error( 'dk_places_http', $msg );
	}

	$reviews = [];
	foreach ( (array) ( $body['reviews'] ?? [] ) as $r ) {
		$text = $r['text']['text'] ?? ( $r['originalText']['text'] ?? '' );
		$reviews[] = [
			'author'     => (string) ( $r['authorAttribution']['displayName'] ?? '' ),
			'author_uri' => (string) ( $r['authorAttribution']['uri'] ?? '' ),
			'photo'      => (string) ( $r['authorAttribution']['photoUri'] ?? '' ),
			'rating'     => (int) ( $r['rating'] ?? 0 ),
			'text'       => (string) $text,
			'when'       => (string) ( $r['relativePublishTimeDescription'] ?? '' ),
			'uri'        => (string) ( $r['googleMapsUri'] ?? '' ),
		];
	}

	return [
		'id'       => (string) ( $body['id'] ?? $place_id ),
		'name'     => (string) ( $body['displayName']['text'] ?? '' ),
		'rating'   => isset( $body['rating'] ) ? (float) $body['rating'] : 0.0,
		'count'    => (int) ( $body['userRatingCount'] ?? 0 ),
		'maps_uri' => (string) ( $body['googleMapsUri'] ?? '' ),
		'reviews'  => $reviews,
		'fetched'  => time(),
	];
}

/**
 * Look up a business by name to find its Place ID.
 */
function datalkemi_search_google_places( $key, $query ) {
	$res = wp_remote_post( 'https://places.googleapis.com/v1/places:searchText', [
		'timeout' => 12,
		'headers' => [
			'Content-Type'     => 'application/json',
			'X-Goog-Api-Key'   => $key,
			'X-Goog-FieldMask' => 'places.id,places.displayName,places.formattedAddress,places.rating,places.userRatingCount',
			'Referer'          => home_url( '/' ),
		],
		// Service-area businesses hide their address, and Google leaves them
		// out of text search unless they are asked for explicitly.
		'body'    => wp_json_encode( [ 'textQuery' => $query, 'languageCode' => 'en', 'regionCode' => 'AU', 'includePureServiceAreaBusinesses' => true ] ),
	] );
	if ( is_wp_error( $res ) ) {
		return $res;
	}
	$code = (int) wp_remote_retrieve_response_code( $res );
	$body = json_decode( wp_remote_retrieve_body( $res ), true );
	if ( 200 !== $code ) {
		$msg = is_array( $body ) && ! empty( $body['error']['message'] ) ? $body['error']['message'] : 'HTTP ' . $code;
		return new WP_Error( 'dk_places_search', $msg );
	}
	$out = [];
	foreach ( (array) ( $body['places'] ?? [] ) as $p ) {
		$out[] = [
			'id'      => (string) ( $p['id'] ?? '' ),
			'name'    => (string) ( $p['displayName']['text'] ?? '' ),
			'address' => (string) ( $p['formattedAddress'] ?? '' ),
			'rating'  => isset( $p['rating'] ) ? (float) $p['rating'] : null,
			'count'   => (int) ( $p['userRatingCount'] ?? 0 ),
		];
	}
	return $out;
}

/**
 * Cached reviews for display. Returns null when not configured or empty.
 */
function datalkemi_get_google_reviews( $force = false ) {
	$s = datalkemi_reviews_settings();
	if ( ! $s['enabled'] || ! $s['key'] || ! $s['place_id'] ) {
		return null;
	}
	if ( ! $force ) {
		$cached = get_transient( DATALKEMI_REVIEWS_CACHE );
		if ( is_array( $cached ) ) {
			return $cached;
		}
	}
	$data = datalkemi_fetch_google_place( $s['key'], $s['place_id'] );
	if ( is_wp_error( $data ) ) {
		update_option( DATALKEMI_REVIEWS_ERROR, [ 'message' => $data->get_error_message(), 'time' => time() ], false );
		$last = get_option( DATALKEMI_REVIEWS_LAST );
		// Try again in an hour rather than on every page view
		set_transient( DATALKEMI_REVIEWS_CACHE, is_array( $last ) ? $last : [], HOUR_IN_SECONDS );
		return is_array( $last ) ? $last : null;
	}
	delete_option( DATALKEMI_REVIEWS_ERROR );
	update_option( DATALKEMI_REVIEWS_LAST, $data, false );
	set_transient( DATALKEMI_REVIEWS_CACHE, $data, 12 * HOUR_IN_SECONDS );
	return $data;
}

/* --------------------------------------------------------------------------
   Rendering
   -------------------------------------------------------------------------- */

function datalkemi_review_stars( $rating, $size = 16 ) {
	$rating = max( 0, min( 5, (float) $rating ) );
	$pct    = round( $rating / 5 * 100, 1 );
	$star   = '<svg viewBox="0 0 24 24" width="' . (int) $size . '" height="' . (int) $size . '" aria-hidden="true"><path d="M12 2.8l2.8 5.9 6.4.8-4.7 4.4 1.2 6.4L12 17.2l-5.7 3.1 1.2-6.4L2.8 9.5l6.4-.8z"/></svg>';
	$row    = str_repeat( $star, 5 );
	/* translators: %s: rating out of 5 */
	$label  = sprintf( __( 'Rated %s out of 5', 'datalkemi' ), rtrim( rtrim( number_format( $rating, 1 ), '0' ), '.' ) );
	return '<span class="dk-stars" role="img" aria-label="' . esc_attr( $label ) . '">'
		. '<span class="dk-stars-base">' . $row . '</span>'
		. '<span class="dk-stars-fill" style="width:' . esc_attr( $pct ) . '%">' . $row . '</span>'
		. '</span>';
}

function datalkemi_render_review_card( $r, $hidden = false ) {
	$initial = $r['author'] ? mb_strtoupper( mb_substr( $r['author'], 0, 1 ) ) : 'G';
	ob_start();
	?>
	<figure class="dk-review"<?php echo $hidden ? ' aria-hidden="true"' : ''; ?>>
		<?php echo datalkemi_review_stars( $r['rating'], 15 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<blockquote class="dk-review-text"><?php echo nl2br( esc_html( $r['text'] ) ); ?></blockquote>
		<figcaption class="dk-review-author">
			<?php if ( $r['photo'] ) : ?>
				<img class="dk-review-photo" src="<?php echo esc_url( $r['photo'] ); ?>" alt="" width="36" height="36" loading="lazy" referrerpolicy="no-referrer">
			<?php else : ?>
				<span class="dk-review-photo dk-review-initial" aria-hidden="true"><?php echo esc_html( $initial ); ?></span>
			<?php endif; ?>
			<span class="dk-review-meta">
				<?php if ( $r['author_uri'] ) : ?>
					<a class="dk-review-name" href="<?php echo esc_url( $r['author_uri'] ); ?>" target="_blank" rel="noopener noreferrer"<?php echo $hidden ? ' tabindex="-1"' : ''; ?>><?php echo esc_html( $r['author'] ); ?></a>
				<?php else : ?>
					<span class="dk-review-name"><?php echo esc_html( $r['author'] ); ?></span>
				<?php endif; ?>
				<span class="dk-review-when"><?php echo esc_html( $r['when'] ); ?></span>
			</span>
		</figcaption>
	</figure>
	<?php
	return ob_get_clean();
}

/**
 * The full reviews section. $data is injectable for previews and tests.
 */
function datalkemi_render_google_reviews( $data = null, $args = [] ) {
	$args = wp_parse_args( $args, [ 'eyebrow' => __( 'Google reviews', 'datalkemi' ), 'title' => __( 'What clients say', 'datalkemi' ) ] );
	if ( null === $data ) {
		$data = datalkemi_get_google_reviews();
	}

	$reviews = array_values( array_filter( (array) ( $data['reviews'] ?? [] ), function ( $r ) { return '' !== trim( $r['text'] ); } ) );
	$has_rating = ! empty( $data['rating'] ) && ! empty( $data['count'] );

	// With no review text yet, a rating summary still shows when Google has one.
	if ( ! $reviews && ! $has_rating ) {
		if ( current_user_can( 'manage_options' ) ) {
			return '<section class="dk-reviews dk-reviews--setup"><div class="dk-container"><p class="dk-reviews-setup">'
				. esc_html__( 'Google reviews are not connected yet. This note is only visible to administrators.', 'datalkemi' )
				. ' <a href="' . esc_url( admin_url( 'options-general.php?page=datalkemi-google-reviews' ) ) . '">' . esc_html__( 'Connect Google reviews', 'datalkemi' ) . '</a></p></div></section>';
		}
		return '';
	}

	$scroll    = count( $reviews ) >= 3;
	$write_url = 'https://search.google.com/local/writereview?placeid=' . rawurlencode( $data['id'] );

	ob_start();
	?>
	<section class="dk-reviews<?php echo $reviews ? '' : ' dk-reviews--compact'; ?>" aria-labelledby="dk-reviews-title">
		<div class="dk-container">
			<div class="dk-reviews-head">
				<div>
					<p class="section-eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
					<h2 id="dk-reviews-title" class="dk-reviews-title"><?php echo esc_html( $args['title'] ); ?></h2>
				</div>
				<div class="dk-reviews-summary">
					<span class="dk-reviews-score"><?php echo esc_html( number_format( (float) $data['rating'], 1 ) ); ?></span>
					<span class="dk-reviews-score-meta">
						<?php echo datalkemi_review_stars( $data['rating'], 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<span class="dk-reviews-count">
							<?php
							/* translators: %s: number of reviews */
							echo esc_html( sprintf( _n( '%s review on Google', '%s reviews on Google', (int) $data['count'], 'datalkemi' ), number_format_i18n( (int) $data['count'] ) ) );
							?>
						</span>
					</span>
				</div>
			</div>
		</div>

		<?php if ( $reviews ) : ?>
		<div class="dk-reviews-marquee<?php echo $scroll ? ' is-scrolling' : ''; ?>">
			<div class="dk-reviews-track">
				<?php foreach ( $reviews as $r ) { echo datalkemi_render_review_card( $r ); } // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<?php if ( $scroll ) { foreach ( $reviews as $r ) { echo datalkemi_render_review_card( $r, true ); } } // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</div>
		</div>
		<?php endif; ?>

		<div class="dk-container">
			<div class="dk-reviews-foot">
				<div class="dk-reviews-actions">
					<?php if ( $data['maps_uri'] ) : ?>
						<a class="dk-btn dk-btn-outline" href="<?php echo esc_url( $data['maps_uri'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo $reviews ? esc_html__( 'Read all reviews', 'datalkemi' ) : esc_html__( 'Read our reviews on Google', 'datalkemi' ); ?></a>
					<?php endif; ?>
					<a class="dk-btn dk-btn-primary" href="<?php echo esc_url( $write_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Leave a review', 'datalkemi' ); ?></a>
				</div>
				<p class="dk-reviews-credit"><?php echo $reviews ? esc_html__( 'Reviews from Google Maps', 'datalkemi' ) : esc_html__( 'Rating from Google Maps', 'datalkemi' ); ?></p>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}

add_shortcode( 'datalkemi_google_reviews', function ( $atts ) {
	$atts = shortcode_atts( [ 'title' => '', 'eyebrow' => '' ], $atts );
	$args = array_filter( [ 'title' => $atts['title'], 'eyebrow' => $atts['eyebrow'] ] );
	return datalkemi_render_google_reviews( null, $args );
} );

/* --------------------------------------------------------------------------
   Admin: Settings, Google reviews
   -------------------------------------------------------------------------- */

add_action( 'admin_menu', function () {
	add_options_page( __( 'Google reviews', 'datalkemi' ), __( 'Google reviews', 'datalkemi' ), 'manage_options', 'datalkemi-google-reviews', 'datalkemi_reviews_admin_page' );
} );

function datalkemi_reviews_admin_url( $args = [] ) {
	return add_query_arg( $args, admin_url( 'options-general.php?page=datalkemi-google-reviews' ) );
}

function datalkemi_reviews_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$s      = datalkemi_reviews_settings();
	$last   = get_option( DATALKEMI_REVIEWS_LAST );
	$error  = get_option( DATALKEMI_REVIEWS_ERROR );
	$found  = get_transient( 'datalkemi_places_search_' . get_current_user_id() );
	$notice = isset( $_GET['dk_notice'] ) ? sanitize_key( $_GET['dk_notice'] ) : '';
	$msgs   = [
		'saved'     => __( 'Settings saved.', 'datalkemi' ),
		'refreshed' => __( 'Reviews refreshed from Google.', 'datalkemi' ),
		'picked'    => __( 'Business selected and reviews loaded.', 'datalkemi' ),
		'searched'  => __( 'Search complete. Pick your business below.', 'datalkemi' ),
		'nokey'     => __( 'Save an API key first.', 'datalkemi' ),
		'failed'    => __( 'Google returned an error. See the status below.', 'datalkemi' ),
	];
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Google reviews', 'datalkemi' ); ?></h1>
		<?php if ( $notice && isset( $msgs[ $notice ] ) ) : ?>
			<div class="notice <?php echo in_array( $notice, [ 'nokey', 'failed' ], true ) ? 'notice-error' : 'notice-success'; ?> is-dismissible"><p><?php echo esc_html( $msgs[ $notice ] ); ?></p></div>
		<?php endif; ?>

		<p><?php esc_html_e( 'Shows your Google Business Profile rating and up to five reviews, chosen by Google, as a scrolling row on the homepage. Use the shortcode [datalkemi_google_reviews] to place it on any other page.', 'datalkemi' ); ?></p>

		<h2><?php esc_html_e( '1. API key', 'datalkemi' ); ?></h2>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'dk_reviews_save' ); ?>
			<input type="hidden" name="action" value="dk_reviews_save">
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="dk-key"><?php esc_html_e( 'Places API key', 'datalkemi' ); ?></label></th>
					<td>
						<?php if ( $s['key_from_constant'] ) : ?>
							<p><?php esc_html_e( 'Set in wp-config.php.', 'datalkemi' ); ?></p>
						<?php else : ?>
							<input type="password" id="dk-key" name="dk_key" class="regular-text" autocomplete="off" placeholder="<?php echo $s['key'] ? esc_attr__( 'Saved. Paste a new key to replace it.', 'datalkemi' ) : 'AIza...'; ?>">
							<p class="description"><?php esc_html_e( 'Google Cloud console: enable "Places API (New)", create an API key, and restrict it to that API.', 'datalkemi' ); ?></p>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dk-place"><?php esc_html_e( 'Place ID', 'datalkemi' ); ?></label></th>
					<td>
						<?php if ( $s['place_from_constant'] ) : ?>
							<p><code><?php echo esc_html( $s['place_id'] ); ?></code> <?php esc_html_e( '(set in wp-config.php)', 'datalkemi' ); ?></p>
						<?php else : ?>
							<input type="text" id="dk-place" name="dk_place" class="regular-text" value="<?php echo esc_attr( $s['place_id'] ); ?>" placeholder="ChIJ...">
							<p class="description"><?php esc_html_e( 'Leave blank and use the search below if you do not know it.', 'datalkemi' ); ?></p>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Show on the site', 'datalkemi' ); ?></th>
					<td><label><input type="checkbox" name="dk_enabled" value="1" <?php checked( $s['enabled'] ); ?>> <?php esc_html_e( 'Display the reviews section', 'datalkemi' ); ?></label></td>
				</tr>
			</table>
			<?php submit_button( __( 'Save settings', 'datalkemi' ) ); ?>
		</form>

		<h2><?php esc_html_e( '2. Find your business', 'datalkemi' ); ?></h2>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'dk_reviews_search' ); ?>
			<input type="hidden" name="action" value="dk_reviews_search">
			<input type="text" name="dk_query" class="regular-text" value="Datalkemi">
			<?php submit_button( __( 'Search Google', 'datalkemi' ), 'secondary', 'submit', false ); ?>
		</form>
		<?php if ( is_array( $found ) ) : ?>
			<?php if ( empty( $found ) ) : ?>
				<p><?php esc_html_e( 'No matching businesses. Check the name matches your Business Profile exactly.', 'datalkemi' ); ?></p>
			<?php else : ?>
				<table class="widefat striped" style="max-width:860px;margin-top:1rem;">
					<tbody>
					<?php foreach ( $found as $p ) : ?>
						<tr>
							<td><strong><?php echo esc_html( $p['name'] ); ?></strong><br><span class="description"><?php echo esc_html( $p['address'] ); ?></span></td>
							<td><?php echo null === $p['rating'] ? esc_html__( 'No reviews yet', 'datalkemi' ) : esc_html( $p['rating'] . ' from ' . $p['count'] ); ?></td>
							<td>
								<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
									<?php wp_nonce_field( 'dk_reviews_pick' ); ?>
									<input type="hidden" name="action" value="dk_reviews_pick">
									<input type="hidden" name="dk_place" value="<?php echo esc_attr( $p['id'] ); ?>">
									<?php submit_button( __( 'Use this business', 'datalkemi' ), 'primary small', 'submit', false ); ?>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		<?php endif; ?>

		<h2><?php esc_html_e( '3. Status', 'datalkemi' ); ?></h2>
		<table class="form-table" role="presentation">
			<tr><th scope="row"><?php esc_html_e( 'Business', 'datalkemi' ); ?></th><td><?php echo is_array( $last ) && $last['name'] ? esc_html( $last['name'] ) : esc_html__( 'Not connected', 'datalkemi' ); ?></td></tr>
			<?php if ( is_array( $last ) ) : ?>
				<tr><th scope="row"><?php esc_html_e( 'Rating', 'datalkemi' ); ?></th><td><?php echo esc_html( number_format( (float) $last['rating'], 1 ) . ' from ' . (int) $last['count'] . ' reviews, ' . count( $last['reviews'] ) . ' shown' ); ?></td></tr>
				<tr><th scope="row"><?php esc_html_e( 'Last updated', 'datalkemi' ); ?></th><td><?php echo esc_html( wp_date( 'j M Y, g:i a', (int) $last['fetched'] ) ); ?></td></tr>
			<?php endif; ?>
			<?php if ( is_array( $error ) ) : ?>
				<tr><th scope="row"><?php esc_html_e( 'Last error', 'datalkemi' ); ?></th><td><?php echo esc_html( $error['message'] . ' (' . wp_date( 'j M Y, g:i a', (int) $error['time'] ) . ')' ); ?></td></tr>
			<?php endif; ?>
		</table>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'dk_reviews_refresh' ); ?>
			<input type="hidden" name="action" value="dk_reviews_refresh">
			<?php submit_button( __( 'Refresh now', 'datalkemi' ), 'secondary', 'submit', false ); ?>
		</form>
	</div>
	<?php
}

add_action( 'admin_post_dk_reviews_save', function () {
	if ( ! current_user_can( 'manage_options' ) ) { wp_die( 'Forbidden', 403 ); }
	check_admin_referer( 'dk_reviews_save' );
	$key = isset( $_POST['dk_key'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['dk_key'] ) ) ) : '';
	if ( '' !== $key ) {
		update_option( 'datalkemi_google_places_key', $key, false );
	}
	if ( isset( $_POST['dk_place'] ) ) {
		update_option( 'datalkemi_google_place_id', trim( sanitize_text_field( wp_unslash( $_POST['dk_place'] ) ) ), false );
	}
	update_option( 'datalkemi_google_reviews_enabled', empty( $_POST['dk_enabled'] ) ? 0 : 1, false );
	delete_transient( DATALKEMI_REVIEWS_CACHE );
	wp_safe_redirect( datalkemi_reviews_admin_url( [ 'dk_notice' => 'saved' ] ) );
	exit;
} );

add_action( 'admin_post_dk_reviews_search', function () {
	if ( ! current_user_can( 'manage_options' ) ) { wp_die( 'Forbidden', 403 ); }
	check_admin_referer( 'dk_reviews_search' );
	$s = datalkemi_reviews_settings();
	if ( ! $s['key'] ) {
		wp_safe_redirect( datalkemi_reviews_admin_url( [ 'dk_notice' => 'nokey' ] ) );
		exit;
	}
	$query = isset( $_POST['dk_query'] ) ? sanitize_text_field( wp_unslash( $_POST['dk_query'] ) ) : '';
	$found = datalkemi_search_google_places( $s['key'], $query );
	if ( is_wp_error( $found ) ) {
		update_option( DATALKEMI_REVIEWS_ERROR, [ 'message' => $found->get_error_message(), 'time' => time() ], false );
		wp_safe_redirect( datalkemi_reviews_admin_url( [ 'dk_notice' => 'failed' ] ) );
		exit;
	}
	set_transient( 'datalkemi_places_search_' . get_current_user_id(), $found, 15 * MINUTE_IN_SECONDS );
	wp_safe_redirect( datalkemi_reviews_admin_url( [ 'dk_notice' => 'searched' ] ) );
	exit;
} );

add_action( 'admin_post_dk_reviews_pick', function () {
	if ( ! current_user_can( 'manage_options' ) ) { wp_die( 'Forbidden', 403 ); }
	check_admin_referer( 'dk_reviews_pick' );
	$place = isset( $_POST['dk_place'] ) ? sanitize_text_field( wp_unslash( $_POST['dk_place'] ) ) : '';
	update_option( 'datalkemi_google_place_id', $place, false );
	delete_transient( 'datalkemi_places_search_' . get_current_user_id() );
	$data = datalkemi_get_google_reviews( true );
	wp_safe_redirect( datalkemi_reviews_admin_url( [ 'dk_notice' => $data ? 'picked' : 'failed' ] ) );
	exit;
} );

add_action( 'admin_post_dk_reviews_refresh', function () {
	if ( ! current_user_can( 'manage_options' ) ) { wp_die( 'Forbidden', 403 ); }
	check_admin_referer( 'dk_reviews_refresh' );
	$data = datalkemi_get_google_reviews( true );
	wp_safe_redirect( datalkemi_reviews_admin_url( [ 'dk_notice' => $data && ! get_option( DATALKEMI_REVIEWS_ERROR ) ? 'refreshed' : 'failed' ] ) );
	exit;
} );

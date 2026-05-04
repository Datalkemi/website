<?php
/**
 * Enqueue scripts and styles
 */

defined( 'ABSPATH' ) || exit;

function datalkemi_enqueue_assets() {
	// Parent theme (Astra)
	wp_enqueue_style(
		'astra-parent-style',
		get_template_directory_uri() . '/style.css',
		[],
		DATALKEMI_VERSION
	);

	// Child theme styles
	wp_enqueue_style(
		'datalkemi-style',
		DATALKEMI_URI . '/style.css',
		[ 'astra-parent-style' ],
		DATALKEMI_VERSION
	);

	// Google Fonts Inter
	wp_enqueue_style(
		'datalkemi-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		[],
		null
	);

	// Component + override styles
	wp_enqueue_style(
		'datalkemi-main',
		DATALKEMI_URI . '/assets/css/main.css',
		[ 'datalkemi-style' ],
		DATALKEMI_VERSION
	);

	// Homepage-only stylesheet
	if ( is_front_page() ) {
		wp_enqueue_style(
			'datalkemi-home',
			DATALKEMI_URI . '/assets/css/home.css',
			[ 'datalkemi-main' ],
			DATALKEMI_VERSION
		);
	}

	// Footer stylesheet — site-wide
	wp_enqueue_style(
		'datalkemi-footer',
		DATALKEMI_URI . '/assets/css/footer.css',
		[ 'datalkemi-main' ],
		DATALKEMI_VERSION
	);

	// Main JS
	wp_enqueue_script(
		'datalkemi-main-js',
		DATALKEMI_URI . '/assets/js/main.js',
		[],
		DATALKEMI_VERSION,
		true
	);

	// Localize AJAX data (contact form + reactions + newsletter)
	wp_localize_script( 'datalkemi-main-js', 'DK_AJAX', [
		'url'              => admin_url( 'admin-ajax.php' ),
		'contact_nonce'    => wp_create_nonce( 'dk_contact_submit' ),
		'reaction_nonce'   => wp_create_nonce( 'dk_post_reaction' ),
	] );
}
add_action( 'wp_enqueue_scripts', 'datalkemi_enqueue_assets' );

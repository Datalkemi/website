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

	// Google Fonts — Inter
	wp_enqueue_style(
		'datalkemi-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		[],
		null
	);

	// Main JS
	wp_enqueue_script(
		'datalkemi-main',
		DATALKEMI_URI . '/assets/js/main.js',
		[],
		DATALKEMI_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'datalkemi_enqueue_assets' );

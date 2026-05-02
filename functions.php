<?php
/**
 * Datalkemi Theme Functions
 */

defined( 'ABSPATH' ) || exit;

define( 'DATALKEMI_VERSION', '1.0.0' );
define( 'DATALKEMI_DIR', get_stylesheet_directory() );
define( 'DATALKEMI_URI', get_stylesheet_directory_uri() );

// ── Load includes ──────────────────────────────────────────────────────────
require_once DATALKEMI_DIR . '/inc/enqueue.php';
require_once DATALKEMI_DIR . '/inc/menus.php';
require_once DATALKEMI_DIR . '/inc/post-types.php';

// ── Theme setup ────────────────────────────────────────────────────────────
function datalkemi_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
	add_theme_support( 'custom-logo', [
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );
	load_child_theme_textdomain( 'datalkemi', DATALKEMI_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'datalkemi_setup' );

// ── Excerpt length ─────────────────────────────────────────────────────────
function datalkemi_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'datalkemi_excerpt_length' );

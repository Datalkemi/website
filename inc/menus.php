<?php
/**
 * Register navigation menus
 */

defined( 'ABSPATH' ) || exit;

function datalkemi_register_menus() {
	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'datalkemi' ),
		'footer'  => __( 'Footer Menu', 'datalkemi' ),
	] );
}
add_action( 'init', 'datalkemi_register_menus' );

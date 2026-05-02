<?php
/**
 * Register navigation menus
 */

defined( 'ABSPATH' ) || exit;

function datalkemi_register_menus() {
	register_nav_menus( [
		'primary' => __( 'Primary Navigation', 'datalkemi' ),
		'footer'  => __( 'Footer Navigation', 'datalkemi' ),
		'portal'  => __( 'Client Portal Navigation', 'datalkemi' ),
	] );
}
add_action( 'init', 'datalkemi_register_menus' );

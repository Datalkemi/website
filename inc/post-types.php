<?php
/**
 * Register Custom Post Types: Projects & Testimonials
 */

defined( 'ABSPATH' ) || exit;

// ── Projects ───────────────────────────────────────────────────────────────
function datalkemi_register_projects_cpt() {
	$labels = [
		'name'               => __( 'Projects', 'datalkemi' ),
		'singular_name'      => __( 'Project', 'datalkemi' ),
		'add_new'            => __( 'Add New Project', 'datalkemi' ),
		'add_new_item'       => __( 'Add New Project', 'datalkemi' ),
		'edit_item'          => __( 'Edit Project', 'datalkemi' ),
		'view_item'          => __( 'View Project', 'datalkemi' ),
		'all_items'          => __( 'All Projects', 'datalkemi' ),
		'search_items'       => __( 'Search Projects', 'datalkemi' ),
		'not_found'          => __( 'No projects found.', 'datalkemi' ),
		'not_found_in_trash' => __( 'No projects found in Trash.', 'datalkemi' ),
	];

	register_post_type( 'project', [
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
		'has_archive'        => true,
		'rewrite'            => [ 'slug' => 'projects' ],
		'menu_icon'          => 'dashicons-portfolio',
		'show_in_menu'       => true,
	] );
}
add_action( 'init', 'datalkemi_register_projects_cpt' );

// ── Testimonials ───────────────────────────────────────────────────────────
function datalkemi_register_testimonials_cpt() {
	$labels = [
		'name'               => __( 'Testimonials', 'datalkemi' ),
		'singular_name'      => __( 'Testimonial', 'datalkemi' ),
		'add_new'            => __( 'Add New Testimonial', 'datalkemi' ),
		'add_new_item'       => __( 'Add New Testimonial', 'datalkemi' ),
		'edit_item'          => __( 'Edit Testimonial', 'datalkemi' ),
		'all_items'          => __( 'All Testimonials', 'datalkemi' ),
		'not_found'          => __( 'No testimonials found.', 'datalkemi' ),
	];

	register_post_type( 'testimonial', [
		'labels'             => $labels,
		'public'             => false,
		'show_ui'            => true,
		'show_in_rest'       => true,
		'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'rewrite'            => false,
		'menu_icon'          => 'dashicons-format-quote',
		'show_in_menu'       => true,
	] );
}
add_action( 'init', 'datalkemi_register_testimonials_cpt' );

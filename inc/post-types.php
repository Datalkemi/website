<?php
/**
 * Register Custom Post Types: Projects, Testimonials, Services, Team Members
 */

defined( 'ABSPATH' ) || exit;

// ── Projects ───────────────────────────────────────────────────────────────
function datalkemi_register_projects_cpt() {
	register_post_type( 'project', [
		'labels' => [
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
		],
		'public'         => true,
		'show_in_rest'   => true,
		'supports'       => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
		'has_archive'    => true,
		'rewrite'        => [ 'slug' => 'projects' ],
		'menu_icon'      => 'dashicons-portfolio',
		'show_in_menu'   => true,
	] );

	// Project industry taxonomy
	register_taxonomy( 'project_industry', 'project', [
		'labels' => [
			'name'              => __( 'Industries', 'datalkemi' ),
			'singular_name'     => __( 'Industry', 'datalkemi' ),
			'add_new_item'      => __( 'Add New Industry', 'datalkemi' ),
			'new_item_name'     => __( 'New Industry Name', 'datalkemi' ),
		],
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => [ 'slug' => 'industry' ],
	] );

	// Project type taxonomy
	register_taxonomy( 'project_type', 'project', [
		'labels' => [
			'name'              => __( 'Project Types', 'datalkemi' ),
			'singular_name'     => __( 'Project Type', 'datalkemi' ),
			'add_new_item'      => __( 'Add New Type', 'datalkemi' ),
		],
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'rewrite'           => [ 'slug' => 'project-type' ],
	] );
}
add_action( 'init', 'datalkemi_register_projects_cpt' );

// ── Services ────────────────────────────────────────────────────────────────
function datalkemi_register_services_cpt() {
	register_post_type( 'service', [
		'labels' => [
			'name'               => __( 'Services', 'datalkemi' ),
			'singular_name'      => __( 'Service', 'datalkemi' ),
			'add_new'            => __( 'Add New Service', 'datalkemi' ),
			'add_new_item'       => __( 'Add New Service', 'datalkemi' ),
			'edit_item'          => __( 'Edit Service', 'datalkemi' ),
			'view_item'          => __( 'View Service', 'datalkemi' ),
			'all_items'          => __( 'All Services', 'datalkemi' ),
			'not_found'          => __( 'No services found.', 'datalkemi' ),
		],
		'public'         => true,
		'show_in_rest'   => true,
		'supports'       => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ],
		'has_archive'    => false,
		'rewrite'        => [ 'slug' => 'services' ],
		'menu_icon'      => 'dashicons-hammer',
		'show_in_menu'   => true,
		'menu_position'  => 5,
	] );
}
add_action( 'init', 'datalkemi_register_services_cpt' );

// ── Team Members ────────────────────────────────────────────────────────────
function datalkemi_register_team_cpt() {
	register_post_type( 'team_member', [
		'labels' => [
			'name'           => __( 'Team Members', 'datalkemi' ),
			'singular_name'  => __( 'Team Member', 'datalkemi' ),
			'add_new'        => __( 'Add Team Member', 'datalkemi' ),
			'add_new_item'   => __( 'Add Team Member', 'datalkemi' ),
			'edit_item'      => __( 'Edit Team Member', 'datalkemi' ),
			'all_items'      => __( 'All Team Members', 'datalkemi' ),
			'not_found'      => __( 'No team members found.', 'datalkemi' ),
		],
		'public'         => false,
		'show_ui'        => true,
		'show_in_rest'   => true,
		'supports'       => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ],
		'rewrite'        => false,
		'menu_icon'      => 'dashicons-groups',
		'show_in_menu'   => true,
		'menu_position'  => 6,
	] );
}
add_action( 'init', 'datalkemi_register_team_cpt' );

// ── Testimonials ────────────────────────────────────────────────────────────
function datalkemi_register_testimonials_cpt() {
	register_post_type( 'testimonial', [
		'labels' => [
			'name'           => __( 'Testimonials', 'datalkemi' ),
			'singular_name'  => __( 'Testimonial', 'datalkemi' ),
			'add_new'        => __( 'Add New Testimonial', 'datalkemi' ),
			'add_new_item'   => __( 'Add New Testimonial', 'datalkemi' ),
			'edit_item'      => __( 'Edit Testimonial', 'datalkemi' ),
			'all_items'      => __( 'All Testimonials', 'datalkemi' ),
			'not_found'      => __( 'No testimonials found.', 'datalkemi' ),
		],
		'public'       => false,
		'show_ui'      => true,
		'show_in_rest' => true,
		'supports'     => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'rewrite'      => false,
		'menu_icon'    => 'dashicons-format-quote',
		'show_in_menu' => true,
		'menu_position'=> 7,
	] );
}
add_action( 'init', 'datalkemi_register_testimonials_cpt' );

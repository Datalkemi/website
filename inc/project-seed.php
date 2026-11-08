<?php
/**
 * One-time project seeding.
 *
 * Reads inc/project-data.php and creates or updates a published Project for
 * each entry, with meta, taxonomy terms, and a featured image from
 * assets/img/projects/{slug}.jpg. Runs once per DATALKEMI_PROJECTS_VERSION.
 *
 * @package Datalkemi
 * @since   2.1.0
 */

defined( 'ABSPATH' ) || exit;

function datalkemi_seed_projects() {
	if ( ! post_type_exists( 'project' ) ) {
		return;
	}

	$projects = require DATALKEMI_DIR . '/inc/project-data.php';
	if ( ! is_array( $projects ) || ! defined( 'DATALKEMI_PROJECTS_VERSION' ) ) {
		return;
	}
	if ( (int) get_option( 'datalkemi_projects_seed_version' ) >= DATALKEMI_PROJECTS_VERSION ) {
		return;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	foreach ( $projects as $p ) {
		$existing = get_page_by_path( $p['slug'], OBJECT, 'project' );

		if ( ! empty( $p['remove'] ) ) {
			if ( $existing ) {
				$thumb_id = get_post_thumbnail_id( $existing->ID );
				if ( $thumb_id ) {
					wp_delete_attachment( $thumb_id, true );
				}
				wp_delete_post( $existing->ID, true );
			}
			continue;
		}

		$postarr = [
			'post_type'    => 'project',
			'post_status'  => 'publish',
			'post_name'    => $p['slug'],
			'post_title'   => $p['title'],
			'post_excerpt' => $p['excerpt'],
			'post_content' => trim( $p['content'] ),
			'post_date'    => $p['end'] . ' 09:00:00',
		];
		if ( $existing ) {
			$postarr['ID'] = $existing->ID;
			$post_id       = wp_update_post( $postarr, true );
		} else {
			$post_id = wp_insert_post( $postarr, true );
		}

		if ( is_wp_error( $post_id ) || ! $post_id ) {
			continue;
		}

		update_post_meta( $post_id, '_project_category',   $p['category'] );
		update_post_meta( $post_id, '_project_tech_stack', $p['tech'] );
		update_post_meta( $post_id, '_project_live_url',   $p['live_url'] );
		update_post_meta( $post_id, '_project_status',     'completed' );
		update_post_meta( $post_id, '_project_end_date',   $p['end'] );
		update_post_meta( $post_id, '_project_hosting',    isset( $p['hosting'] ) ? $p['hosting'] : '' );

		wp_set_object_terms( $post_id, $p['industry'], 'project_industry' );
		wp_set_object_terms( $post_id, $p['type'],     'project_type' );

		$image         = DATALKEMI_DIR . '/assets/img/projects/' . $p['slug'] . '.jpg';
		$image_version = isset( $p['image_version'] ) ? (int) $p['image_version'] : 1;
		if ( has_post_thumbnail( $post_id ) && (int) get_post_meta( $post_id, '_project_image_version', true ) !== $image_version ) {
			wp_delete_attachment( get_post_thumbnail_id( $post_id ), true );
			delete_post_thumbnail( $post_id );
		}
		if ( file_exists( $image ) && ! has_post_thumbnail( $post_id ) ) {
			$bits = wp_upload_bits( basename( $image ), null, file_get_contents( $image ) );
			if ( empty( $bits['error'] ) ) {
				$attachment_id = wp_insert_attachment( [
					'post_mime_type' => 'image/jpeg',
					'post_title'     => $p['title'],
					'post_status'    => 'inherit',
				], $bits['file'], $post_id );
				if ( ! is_wp_error( $attachment_id ) && $attachment_id ) {
					wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $bits['file'] ) );
					set_post_thumbnail( $post_id, $attachment_id );
					update_post_meta( $post_id, '_project_image_version', $image_version );
				}
			}
		}
	}

	update_option( 'datalkemi_projects_seed_version', DATALKEMI_PROJECTS_VERSION );
}
add_action( 'init', 'datalkemi_seed_projects', 30 );

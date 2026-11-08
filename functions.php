<?php
/**
 * Datalkemi Theme Functions
 */

defined( 'ABSPATH' ) || exit;

define( 'DATALKEMI_VERSION', '1.1.0' );
define( 'DATALKEMI_DIR', get_stylesheet_directory() );
define( 'DATALKEMI_URI', get_stylesheet_directory_uri() );

// ── Load includes ──────────────────────────────────────────────────────────
require_once DATALKEMI_DIR . '/inc/enqueue.php';
require_once DATALKEMI_DIR . '/inc/menus.php';
require_once DATALKEMI_DIR . '/inc/post-types.php';
require_once DATALKEMI_DIR . '/inc/service-data.php';
require_once DATALKEMI_DIR . '/inc/client-portal.php';
require_once DATALKEMI_DIR . '/inc/admin-clients.php';
require_once DATALKEMI_DIR . '/inc/configurator-data.php';
require_once DATALKEMI_DIR . '/inc/smtp.php';
require_once DATALKEMI_DIR . '/inc/seo-home.php';
require_once DATALKEMI_DIR . '/inc/newsletter.php';
require_once DATALKEMI_DIR . '/inc/project-seed.php';

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

/**
 * Reading settings guard.
 * The Insights page must be the Posts page so /insights/ renders the blog
 * archive (home.php). The content installer once left this pointing at the
 * Blog page, so correct it a single time on an existing install.
 */
function datalkemi_ensure_posts_page() {
	if ( get_option( 'datalkemi_posts_page_v1' ) ) {
		return;
	}
	$insights = get_page_by_path( 'insights' );
	if ( $insights && (int) get_option( 'page_for_posts' ) !== (int) $insights->ID ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_for_posts', $insights->ID );
	}
	update_option( 'datalkemi_posts_page_v1', 1 );
}
add_action( 'init', 'datalkemi_ensure_posts_page', 20 );

/**
 * The posts page is Insights. The legacy /blog/ page created by an earlier
 * content install redirects there permanently.
 */
function datalkemi_redirect_blog_page() {
	if ( is_page( 'blog' ) ) {
		wp_safe_redirect( home_url( '/insights/' ), 301 );
		exit;
	}
}
add_action( 'template_redirect', 'datalkemi_redirect_blog_page' );

/**
 * Astra ships its own scroll-to-top button. The theme renders one in
 * footer.php, so the parent's is switched off to avoid two buttons.
 */
add_filter( 'astra_get_option_scroll-to-top-enable', '__return_false' );

/**
 * Product pages guard, version 3.
 * Makes sure the Exnami page and the Our Products landing page exist with
 * their templates, and that the primary menu has an "Our Products" item
 * with Exnami beneath it, placed before Services. Runs once per version.
 */
function datalkemi_ensure_product_pages() {
	if ( (int) get_option( 'datalkemi_product_pages_version' ) >= 3 ) {
		return;
	}

	$pages = [
		'exnami'   => [ 'Exnami',       'page-exnami.php' ],
		'products' => [ 'Our Products', 'page-products.php' ],
	];
	$ids = [];
	foreach ( $pages as $slug => $def ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			$ids[ $slug ] = $page->ID;
			if ( get_post_meta( $page->ID, '_wp_page_template', true ) !== $def[1] ) {
				update_post_meta( $page->ID, '_wp_page_template', $def[1] );
			}
			continue;
		}
		$page_id = wp_insert_post( [
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => $slug,
			'post_title'   => $def[0],
			'post_content' => '',
		], true );
		if ( ! is_wp_error( $page_id ) && $page_id ) {
			update_post_meta( $page_id, '_wp_page_template', $def[1] );
			$ids[ $slug ] = $page_id;
		}
	}

	$locations = get_nav_menu_locations();
	$menu_id   = isset( $locations['primary'] ) ? (int) $locations['primary'] : 0;
	if ( $menu_id && ! empty( $ids['products'] ) && ! empty( $ids['exnami'] ) ) {
		$items      = wp_get_nav_menu_items( $menu_id ) ?: [];
		$parent_id  = 0;
		$after      = 0;
		foreach ( $items as $item ) {
			if ( (int) $item->menu_item_parent === 0 && (int) $item->object_id === (int) $ids['products'] ) {
				$parent_id = $item->ID;
			}
			if ( (int) $item->menu_item_parent === 0 && $item->title === 'Projects' ) {
				$after = (int) $item->menu_order;
			}
		}
		if ( ! $parent_id ) {
			// Shift every top level item after Projects down by one
			foreach ( $items as $item ) {
				if ( (int) $item->menu_item_parent === 0 && (int) $item->menu_order > $after ) {
					wp_update_post( [ 'ID' => $item->ID, 'menu_order' => (int) $item->menu_order + 1 ] );
				}
			}
			$parent_id = wp_update_nav_menu_item( $menu_id, 0, [
				'menu-item-title'     => 'Our Products',
				'menu-item-url'       => home_url( '/products/' ),
				'menu-item-status'    => 'publish',
				'menu-item-type'      => 'post_type',
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $ids['products'],
				'menu-item-position'  => $after + 1,
			] );
		}
		// Place Our Products directly before Services among the top level items
		if ( $parent_id && ! is_wp_error( $parent_id ) ) {
			$top = array_values( array_filter( wp_get_nav_menu_items( $menu_id ) ?: [], function ( $i ) {
				return (int) $i->menu_item_parent === 0;
			} ) );
			usort( $top, function ( $a, $b ) { return (int) $a->menu_order <=> (int) $b->menu_order; } );
			$ordered = [];
			$product = null;
			foreach ( $top as $i ) {
				if ( (int) $i->ID === (int) $parent_id ) { $product = $i; continue; }
				$ordered[] = $i;
			}
			if ( $product ) {
				$pos = count( $ordered );
				foreach ( $ordered as $k => $i ) {
					if ( $i->title === 'Services' ) { $pos = $k; break; }
				}
				array_splice( $ordered, $pos, 0, [ $product ] );
				foreach ( $ordered as $k => $i ) {
					if ( (int) $i->menu_order !== $k + 1 ) {
						wp_update_post( [ 'ID' => $i->ID, 'menu_order' => $k + 1 ] );
					}
				}
			}
		}

		if ( $parent_id && ! is_wp_error( $parent_id ) ) {
			$has_child = false;
			foreach ( $items as $item ) {
				if ( (int) $item->menu_item_parent === (int) $parent_id && (int) $item->object_id === (int) $ids['exnami'] ) {
					$has_child = true;
				}
			}
			if ( ! $has_child ) {
				wp_update_nav_menu_item( $menu_id, 0, [
					'menu-item-title'     => 'Exnami',
					'menu-item-url'       => home_url( '/exnami/' ),
					'menu-item-status'    => 'publish',
					'menu-item-type'      => 'post_type',
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $ids['exnami'],
					'menu-item-parent-id' => $parent_id,
				] );
			}
		}
	}

	update_option( 'datalkemi_product_pages_version', 3 );
}
add_action( 'init', 'datalkemi_ensure_product_pages', 25 );

// ── Excerpt length ─────────────────────────────────────────────────────────
function datalkemi_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'datalkemi_excerpt_length' );

// ── Custom excerpt "read more" link ────────────────────────────────────────
function datalkemi_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'datalkemi_excerpt_more' );

// ── Body class additions ───────────────────────────────────────────────────
function datalkemi_body_classes( array $classes ): array {
	if ( is_user_logged_in() ) {
		$user = wp_get_current_user();
		if ( in_array( 'client', (array) $user->roles, true ) ) {
			$classes[] = 'is-client';
		}
	}
	return $classes;
}
add_filter( 'body_class', 'datalkemi_body_classes' );

// ── Disable comments on pages and CPTs (allow on posts) ───────────────────
function datalkemi_disable_comments_non_posts( $open, $post_id ) {
	return get_post_type( $post_id ) === 'post' ? $open : false;
}
add_filter( 'comments_open', 'datalkemi_disable_comments_non_posts', 20, 2 );
add_filter( 'pings_open',    'datalkemi_disable_comments_non_posts', 20, 2 );

// ── Configurator AJAX handler ───────────────────────────────────────────────
function datalkemi_configurator_submit() {
	check_ajax_referer( 'dk_configurator_submit', 'nonce' );

	$name    = sanitize_text_field( $_POST['name']    ?? '' );
	$email   = sanitize_email(      $_POST['email']   ?? '' );
	$company = sanitize_text_field( $_POST['company'] ?? '' );
	$notes   = sanitize_textarea_field( $_POST['notes'] ?? '' );
	$summary = sanitize_textarea_field( $_POST['summary'] ?? '' );
	$total   = absint( $_POST['total'] ?? 0 ); // AUD
	$display = sanitize_text_field( $_POST['display'] ?? ( 'A$' . number_format( $total ) ) );
	$purpose = sanitize_text_field( $_POST['purpose'] ?? '' );

	if ( ! $name || ! is_email( $email ) ) {
		wp_send_json_error( 'Invalid submission.' );
	}

	$admin_email = get_option( 'admin_email' );
	$subject     = 'New project estimate ' . $display . ( $purpose ? ' for a ' . lcfirst( $purpose ) : '' ) . ' from ' . $name;

	$body  = "New project quote request received via the Datalkemi configurator.\n\n";
	$body .= "Name:    {$name}\n";
	$body .= "Email:   {$email}\n";
	$body .= "Company: {$company}\n\n";
	$body .= $summary . "\n\n";
	if ( $notes ) {
		$body .= "Additional notes:\n{$notes}\n\n";
	}
	$body .= "---\nReply to this email to follow up with " . $name . " directly.\n";

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	];

	$sent = wp_mail( $admin_email, $subject, $body, $headers );

	// Confirmation to client
	$client_body  = "Hi {$name},\n\n";
	$client_body .= "Thank you for configuring your project with Datalkemi.\n\n";
	$client_body .= "We have received your estimate of " . $display . " and will review it personally.\n";
	$client_body .= "A member of our team will be in touch within one business day.\n\n";
	$client_body .= $summary . "\n\n";
	$client_body .= "Questions? Just reply to this email.\n\nThe Datalkemi Team\nhttps://datalkemi.com\n";

	wp_mail( $email, 'Your Datalkemi project estimate', $client_body, [ 'Content-Type: text/plain; charset=UTF-8' ] );

	if ( $sent ) {
		wp_send_json_success( 'Quote sent.' );
	} else {
		wp_send_json_error( 'Mail failed.' );
	}
}
add_action( 'wp_ajax_dk_submit_configurator',        'datalkemi_configurator_submit' );
add_action( 'wp_ajax_nopriv_dk_submit_configurator', 'datalkemi_configurator_submit' );

// ── Contact form AJAX ───────────────────────────────────────────────────────
function datalkemi_contact_submit() {
	check_ajax_referer( 'dk_contact_submit', 'nonce' );

	// Honeypot
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_error( 'Invalid submission.' );
	}

	$name    = sanitize_text_field( $_POST['name']    ?? '' );
	$email   = sanitize_email(      $_POST['email']   ?? '' );
	$company = sanitize_text_field( $_POST['company'] ?? '' );
	$service = sanitize_text_field( $_POST['service'] ?? '' );
	$message = sanitize_textarea_field( $_POST['message'] ?? '' );

	if ( ! $name || ! is_email( $email ) || ! $message ) {
		wp_send_json_error( 'Please fill in all required fields.' );
	}

	$admin_email = get_option( 'admin_email' );
	$subject     = 'New Enquiry: ' . $name . ( $service ? ' (' . $service . ')' : '' );

	$body  = "New contact enquiry from datalkemi.com\n\n";
	$body .= "Name:    {$name}\n";
	$body .= "Email:   {$email}\n";
	if ( $company ) $body .= "Company: {$company}\n";
	if ( $service ) $body .= "Service: {$service}\n";
	$body .= "\nMessage:\n{$message}\n";
	$body .= "\n---\nReply to this email to contact {$name} directly.\n";

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	];

	$sent = wp_mail( $admin_email, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( 'Message sent.' );
	} else {
		wp_send_json_error( 'Could not send. Please email info@datalkemi.com directly.' );
	}
}
add_action( 'wp_ajax_dk_contact_submit',        'datalkemi_contact_submit' );
add_action( 'wp_ajax_nopriv_dk_contact_submit', 'datalkemi_contact_submit' );

// ── Get a Quote page form AJAX (replaces the old mailto fallback) ───────────
function datalkemi_quote_submit() {
	check_ajax_referer( 'dk_quote_submit', 'nonce' );

	// Honeypot
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_error( 'Invalid submission.' );
	}

	$name        = sanitize_text_field( $_POST['name']        ?? '' );
	$company     = sanitize_text_field( $_POST['company']     ?? '' );
	$email       = sanitize_email(      $_POST['email']       ?? '' );
	$phone       = sanitize_text_field( $_POST['phone']       ?? '' );
	$service     = sanitize_text_field( $_POST['service']     ?? '' );
	$budget      = sanitize_text_field( $_POST['budget']      ?? '' );
	$timeline    = sanitize_text_field( $_POST['timeline']    ?? '' );
	$source      = sanitize_text_field( $_POST['source']      ?? '' );
	$description = sanitize_textarea_field( $_POST['description'] ?? '' );

	if ( ! $name || ! is_email( $email ) || ! $service || ! $description ) {
		wp_send_json_error( 'Please fill in all required fields.' );
	}

	$admin_email = get_option( 'admin_email' );
	$subject     = 'New Project Brief: ' . $name . ' (' . $service . ')';

	$body  = "New project brief from datalkemi.com/get-a-quote\n\n";
	$body .= "Name:     {$name}\n";
	$body .= "Email:    {$email}\n";
	if ( $company )  $body .= "Company:  {$company}\n";
	if ( $phone )    $body .= "Phone:    {$phone}\n";
	$body .= "Service:  {$service}\n";
	if ( $budget )   $body .= "Budget:   {$budget}\n";
	if ( $timeline ) $body .= "Timeline: {$timeline}\n";
	if ( $source )   $body .= "Source:   {$source}\n";
	$body .= "\nProject:\n{$description}\n";
	$body .= "\n---\nReply to this email to contact {$name} directly.\n";

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	];

	$sent = wp_mail( $admin_email, $subject, $body, $headers );

	if ( ! $sent ) {
		error_log( '[Datalkemi quote form] admin notification failed for ' . $email );
		wp_send_json_error( 'Could not send. Please email info@datalkemi.com directly.' );
	}

	// Confirmation to the client (best effort, does not affect the result)
	$client_body  = "Hi {$name},\n\n";
	$client_body .= "Thanks for sending your project brief to Datalkemi. A senior team member will review it and reply within one business day.\n\n";
	$client_body .= "What you told us:\n";
	$client_body .= "Service:  {$service}\n";
	if ( $budget )   $client_body .= "Budget:   {$budget}\n";
	if ( $timeline ) $client_body .= "Timeline: {$timeline}\n";
	$client_body .= "\nQuestions in the meantime? Just reply to this email.\n\nThe Datalkemi Team\nhttps://datalkemi.com\n";
	wp_mail( $email, 'We received your project brief', $client_body, [ 'Content-Type: text/plain; charset=UTF-8' ] );

	wp_send_json_success( 'Brief sent.' );
}
add_action( 'wp_ajax_dk_quote_submit',        'datalkemi_quote_submit' );
add_action( 'wp_ajax_nopriv_dk_quote_submit', 'datalkemi_quote_submit' );

// ── Post reactions (likes / dislikes) ──────────────────────────────────────
function datalkemi_post_reaction() {
	check_ajax_referer( 'dk_post_reaction', 'nonce' );

	$post_id  = absint( $_POST['post_id']  ?? 0 );
	$reaction = sanitize_key( $_POST['reaction'] ?? '' );

	if ( ! $post_id || ! in_array( $reaction, [ 'like', 'dislike' ], true ) ) {
		wp_send_json_error( 'Invalid request.' );
	}

	$cookie_key = 'dk_voted_' . $post_id;
	if ( ! empty( $_COOKIE[ $cookie_key ] ) ) {
		wp_send_json_error( 'already_voted' );
	}

	$meta_key = 'dk_' . $reaction . '_count';
	$count    = (int) get_post_meta( $post_id, $meta_key, true );
	update_post_meta( $post_id, $meta_key, ++$count );

	setcookie( $cookie_key, $reaction, time() + ( 30 * DAY_IN_SECONDS ), COOKIEPATH, COOKIE_DOMAIN );

	wp_send_json_success( [
		'count'    => $count,
		'reaction' => $reaction,
	] );
}
add_action( 'wp_ajax_dk_post_reaction',        'datalkemi_post_reaction' );
add_action( 'wp_ajax_nopriv_dk_post_reaction', 'datalkemi_post_reaction' );

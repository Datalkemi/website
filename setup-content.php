<?php
/**
 * Datalkemi — One-time content setup script.
 *
 * Run ONCE via browser: https://yourdomain.com/wp-content/themes/datalkemi/setup-content.php
 * Delete or password-protect this file after running.
 *
 * Creates:
 *  - All required WordPress pages with correct slugs and page templates
 *  - 6 Service CPT posts with slugs matching inc/service-data.php keys
 *  - Assigns pages to the Primary navigation menu
 */

// Bootstrap WordPress
$wp_load_path = dirname( __FILE__ );
while ( ! file_exists( $wp_load_path . '/wp-load.php' ) ) {
    $wp_load_path = dirname( $wp_load_path );
    if ( $wp_load_path === '/' || strlen( $wp_load_path ) <= 3 ) {
        die( 'Cannot find wp-load.php. Move this file to the theme folder or adjust the path.' );
    }
}
require_once $wp_load_path . '/wp-load.php';

if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'You must be logged in as an administrator to run this script.' );
}

$log   = [];
$log[] = '<b>Datalkemi Content Setup — ' . date( 'Y-m-d H:i:s' ) . '</b>';

/* ================================================================
   HELPER FUNCTIONS
   ================================================================ */

/**
 * Create (or skip if exists) a WordPress page.
 *
 * @param string $title          Page title.
 * @param string $slug           Page slug (post_name).
 * @param string $template       Page template filename (relative to theme root), or ''.
 * @param string $content        Optional page content.
 * @param int    $parent_id      Optional parent page ID.
 * @return int   Post ID.
 */
function dk_create_page( string $title, string $slug, string $template = '', string $content = '', int $parent_id = 0 ): int {
    global $log;

    $existing = get_page_by_path( $slug, OBJECT, 'page' );
    if ( $existing ) {
        $log[] = "  <span style='color:#aaa'>SKIP  Page already exists: <b>{$title}</b> (ID {$existing->ID})</span>";
        return $existing->ID;
    }

    $post_id = wp_insert_post( [
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => $content,
        'post_parent'  => $parent_id,
    ] );

    if ( $template ) {
        update_post_meta( $post_id, '_wp_page_template', $template );
    }

    $log[] = "  <span style='color:#4ade80'>CREATE Page: <b>{$title}</b> (ID {$post_id}, slug: /{$slug}/)</span>";
    return $post_id;
}

/**
 * Create (or skip if exists) a Service CPT post.
 */
function dk_create_service( string $title, string $slug ): int {
    global $log;

    $existing = get_posts( [
        'name'        => $slug,
        'post_type'   => 'service',
        'post_status' => 'publish',
        'numberposts' => 1,
    ] );

    if ( ! empty( $existing ) ) {
        $log[] = "  <span style='color:#aaa'>SKIP  Service already exists: <b>{$title}</b> (ID {$existing[0]->ID})</span>";
        return $existing[0]->ID;
    }

    $post_id = wp_insert_post( [
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => 'service',
        'post_content' => '',
    ] );

    $log[] = "  <span style='color:#60a5fa'>CREATE Service: <b>{$title}</b> (ID {$post_id}, slug: /services/{$slug}/)</span>";
    return $post_id;
}

/* ================================================================
   1. WORDPRESS PAGES
   ================================================================ */

$log[] = '<br><b>── Creating Pages ──</b>';

// Front page (homepage)
$home_id = dk_create_page( 'Home', 'home', 'page-home.php' );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home_id );
$log[] = "  Set static front page → ID {$home_id}";

// Blog / Posts page (needed for Reading Settings even if unused)
$blog_id = dk_create_page( 'Blog', 'blog' );
update_option( 'page_for_posts', $blog_id );

// Primary inner pages
$about_id    = dk_create_page( 'About Us',        'about',           'page-about.php' );
$services_id = dk_create_page( 'Services',        'services',        'page-services.php' );
$projects_id = dk_create_page( 'Projects',        'projects',        '' ); // archive handled by archive-project.php
$portal_id   = dk_create_page( 'Client Portal',   'client-portal',   'page-client-portal.php' );
$quote_id    = dk_create_page( 'Get a Quote',     'get-a-quote',     'page-quote.php' );
$contact_id  = dk_create_page( 'Contact',         'contact',         'page-contact.php' );

// Legal pages
$privacy_id  = dk_create_page( 'Privacy Policy',  'privacy-policy',  '',      '', 0 );
$terms_id    = dk_create_page( 'Terms of Service','terms-of-service','',      '', 0 );
$cookies_id  = dk_create_page( 'Cookie Policy',   'cookie-policy',   '',      '', 0 );

// Insights / Blog hub
$insights_id = dk_create_page( 'Insights',        'insights',        'page-insights.php' );

$log[] = "  Set blog page → ID {$blog_id}";

/* ================================================================
   2. SERVICE CPT POSTS
   Must match keys in inc/service-data.php exactly.
   ================================================================ */

$log[] = '<br><b>── Creating Service CPT posts ──</b>';

$services = [
    'Website Design'          => 'website-design',
    'Full-Stack Web Development' => 'web-development',
    'SEO Optimisation'        => 'seo-optimisation',
    'Data Analytics'          => 'data-analytics',
    'Business Intelligence'   => 'business-intelligence',
    'Custom Dashboards'       => 'custom-dashboards',
];

$service_ids = [];
foreach ( $services as $title => $slug ) {
    $service_ids[ $slug ] = dk_create_service( $title, $slug );
}

/* ================================================================
   3. NAV MENU SETUP
   ================================================================ */

$log[] = '<br><b>── Setting up Navigation Menu ──</b>';

$menu_name     = 'Primary Navigation';
$menu_location = 'primary';

$existing_menu = wp_get_nav_menu_object( $menu_name );
if ( $existing_menu ) {
    $menu_id = $existing_menu->term_id;
    $log[]   = "  SKIP  Menu already exists: <b>{$menu_name}</b> (ID {$menu_id})";
} else {
    $menu_id = wp_create_nav_menu( $menu_name );
    $log[]   = "  <span style='color:#4ade80'>CREATE Nav menu: <b>{$menu_name}</b> (ID {$menu_id})</span>";
}

// Assign menu to primary location
$locations = get_theme_mod( 'nav_menu_locations', [] );
$locations[ $menu_location ] = $menu_id;
set_theme_mod( 'nav_menu_locations', $locations );
$log[] = "  Assigned to location: <b>{$menu_location}</b>";

// Only add items to a freshly created menu
$menu_items = wp_get_nav_menu_items( $menu_id );
if ( empty( $menu_items ) ) {
    $items = [
        [ 'title' => 'Home',          'url' => home_url( '/' ),            'object_id' => $home_id,     'order' => 1 ],
        [ 'title' => 'About',         'url' => home_url( '/about/' ),       'object_id' => $about_id,    'order' => 2 ],
        [ 'title' => 'Services',      'url' => home_url( '/services/' ),    'object_id' => $services_id, 'order' => 3 ],
        [ 'title' => 'Projects',      'url' => home_url( '/projects/' ),    'object_id' => $projects_id, 'order' => 4 ],
        [ 'title' => 'Insights',      'url' => home_url( '/insights/' ),    'object_id' => $insights_id, 'order' => 5 ],
        [ 'title' => 'Contact',       'url' => home_url( '/contact/' ),     'object_id' => $contact_id,  'order' => 6 ],
        [ 'title' => 'Get a Quote',   'url' => home_url( '/get-a-quote/' ), 'object_id' => $quote_id,    'order' => 7 ],
    ];

    foreach ( $items as $item ) {
        $item_id = wp_update_nav_menu_item( $menu_id, 0, [
            'menu-item-title'     => $item['title'],
            'menu-item-url'       => $item['url'],
            'menu-item-status'    => 'publish',
            'menu-item-type'      => 'post_type',
            'menu-item-object'    => 'page',
            'menu-item-object-id' => $item['object_id'],
        ] );
        $log[] = "  <span style='color:#60a5fa'>  ITEM  {$item['title']} → {$item['url']} (item ID {$item_id})</span>";
    }

    // Add service sub-items under Services
    $services_nav_item_id = 0;
    foreach ( wp_get_nav_menu_items( $menu_id ) as $nav_item ) {
        if ( (int) $nav_item->object_id === $services_id ) {
            $services_nav_item_id = $nav_item->ID;
            break;
        }
    }

    if ( $services_nav_item_id ) {
        $order = 1;
        foreach ( $services as $title => $slug ) {
            $child_id = wp_update_nav_menu_item( $menu_id, 0, [
                'menu-item-title'     => $title,
                'menu-item-url'       => home_url( "/services/{$slug}/" ),
                'menu-item-status'    => 'publish',
                'menu-item-type'      => 'post_type',
                'menu-item-object'    => 'service',
                'menu-item-object-id' => $service_ids[ $slug ],
                'menu-item-parent-id' => $services_nav_item_id,
            ] );
            $log[] = "  <span style='color:#a78bfa'>    SUB  {$title} (item ID {$child_id})</span>";
            $order++;
        }
    }
}

/* ================================================================
   4. SET READING SETTINGS
   ================================================================ */

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front',  $home_id );
update_option( 'page_for_posts', $blog_id );
update_option( 'posts_per_page', 12 );
flush_rewrite_rules( true );
$log[] = '<br><b>── Reading settings updated; rewrite rules flushed ──</b>';

/* ================================================================
   5. OUTPUT
   ================================================================ */
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Datalkemi Setup</title>
<style>
  body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #111827; color: #e5e7eb; padding: 2rem; line-height: 1.7; }
  h1   { color: #38bdf8; margin-bottom: 0.5rem; }
  pre  { background: #1e2d3d; padding: 1.5rem; border-radius: 0.75rem; font-size: 0.875rem; overflow: auto; white-space: pre-wrap; }
  .ok  { color: #4ade80; }
  .warn{ color: #fbbf24; }
  .box { background: rgba(2,132,199,0.1); border: 1px solid rgba(2,132,199,0.3); border-radius: 0.75rem; padding: 1.5rem; margin-top: 2rem; }
</style>
</head>
<body>
<h1>&#9989; Datalkemi Content Setup Complete</h1>
<p>Run on: <b><?php echo date( 'Y-m-d H:i:s' ); ?></b> &mdash; Site: <b><?php echo esc_html( home_url() ); ?></b></p>
<pre><?php echo implode( "\n", $log ); ?></pre>
<div class="box">
  <p><b class="warn">&#9888; Important — Security:</b> Delete or rename <code>setup-content.php</code> from your theme folder now that setup is complete. Leaving it accessible is a security risk.</p>
  <p>You can also verify the setup by visiting <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" style="color:#38bdf8">Appearance &rarr; Menus</a> and <a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>" style="color:#38bdf8">Settings &rarr; Reading</a>.</p>
</div>
</body>
</html>

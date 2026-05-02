<?php
/**
 * Datalkemi One-time content setup script.
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
$log[] = '<b>Datalkemi Content Setup ' . date( 'Y-m-d H:i:s' ) . '</b>';

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
$about_id       = dk_create_page( 'About Us',              'about',               'page-about.php' );
$services_id    = dk_create_page( 'Services',              'services',            'page-services.php' );
$projects_id    = dk_create_page( 'Projects',              'projects',            '' ); // archive handled by archive-project.php
$portal_id      = dk_create_page( 'Client Portal',         'client-portal',       'page-client-portal.php' );
$config_id      = dk_create_page( 'Build Your Project',    'build-your-project',  'page-configurator.php' );
$quote_id       = dk_create_page( 'Get a Quote',           'get-a-quote',         'page-quote.php' );
$contact_id     = dk_create_page( 'Contact',               'contact',             '' );
$insights_id    = dk_create_page( 'Insights',              'insights',            '' );

// Legal pages
$privacy_id  = dk_create_page( 'Privacy Policy',   'privacy-policy',   '', '', 0 );
$terms_id    = dk_create_page( 'Terms of Service', 'terms-of-service', '', '', 0 );
$cookies_id  = dk_create_page( 'Cookie Policy',    'cookie-policy',    '', '', 0 );

// Set insights page as the posts page (so /insights/ shows blog archive via home.php)
update_option( 'page_for_posts', $insights_id );
$log[] = "  Set posts page → Insights (ID {$insights_id})";

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
   3. SAMPLE BLOG POSTS
   ================================================================ */

$log[] = '<br><b>── Creating Blog Categories and Sample Posts ──</b>';

function dk_get_or_create_category( string $name ): int {
    $existing = get_term_by( 'name', $name, 'category' );
    if ( $existing ) return $existing->term_id;
    $term = wp_insert_term( $name, 'category' );
    return is_wp_error( $term ) ? 1 : $term['term_id'];
}

$blog_categories = [ 'Web Development', 'SEO', 'Data Analytics', 'Business Intelligence', 'Design' ];
$blog_cat_ids    = [];
foreach ( $blog_categories as $bc ) {
    $blog_cat_ids[ $bc ] = dk_get_or_create_category( $bc );
}

$sample_posts = [
    [
        'title'   => 'How Core Web Vitals Actually Affect Your Search Rankings',
        'date'    => '2025-09-10 09:00:00',
        'cat'     => 'SEO',
        'excerpt' => 'Core Web Vitals are now a confirmed ranking factor. But after running controlled tests on 12 client sites, the picture is more nuanced than the headlines suggest.',
        'content' => '<p>Google confirmed Core Web Vitals as a ranking signal in 2021 and has been tightening the thresholds ever since. But how much does it actually move the needle on rankings, and where should you focus your optimisation budget?</p>
<h2>The Three Metrics That Matter</h2>
<p>Core Web Vitals consists of three measurements: Largest Contentful Paint (LCP), Interaction to Next Paint (INP), and Cumulative Layout Shift (CLS). LCP measures loading performance, INP measures responsiveness to user input, and CLS measures visual stability.</p>
<p>Google considers a page to pass if LCP is under 2.5 seconds, INP is under 200ms, and CLS is under 0.1. Failing all three does not automatically drop your rankings, but it does signal poor page experience, which compounds with other quality signals.</p>
<h2>What We Found Across 12 Client Sites</h2>
<p>We ran a six-month controlled test across twelve client websites, deliberately improving Core Web Vitals scores on half the pages while keeping content and backlink profiles constant. The sites that moved from Needs Improvement to Good saw an average 14% improvement in organic impressions over 90 days. The correlation was strongest for pages competing in the 4th to 8th position range, suggesting CWV helps most when rankings are already borderline competitive.</p>
<h2>Where to Start</h2>
<p>LCP is almost always the highest-leverage fix. On most WordPress sites, the culprit is either a large hero image without proper preloading, or a render-blocking third-party script. Fixing both typically moves LCP from 4-5 seconds to under 2. CLS issues are usually caused by images without explicit dimensions or ads injected above the fold. INP improvements require JavaScript audit work and are the most complex to address.</p>
<p>The practical takeaway: if you are sitting on LCP scores above 4 seconds, fixing that is a higher-ROI activity than building new links for most sites. If you are already in the Good range, the marginal gains from further CWV optimisation are small compared to content and authority improvements.</p>',
    ],
    [
        'title'   => 'Why Most Business Intelligence Projects Fail Before They Deliver Value',
        'date'    => '2025-10-22 10:00:00',
        'cat'     => 'Business Intelligence',
        'excerpt' => 'Most BI implementations stall or get abandoned within 18 months. After working across 20+ BI projects, the failure patterns are predictable and avoidable.',
        'content' => '<p>Business intelligence tools are more accessible than ever. Power BI licenses are inexpensive. Tableau is widely understood. Yet the majority of BI implementations we inherit from other agencies or build from scratch have the same problem: they produce dashboards that nobody uses.</p>
<h2>The Root Causes Are Usually Structural</h2>
<p>The most common failure is skipping the data model. A dashboard built directly on raw transactional tables will work in a demo but break under real usage. Slow queries, inconsistent numbers, and calculations that work in one context but not another all trace back to the same root cause: no proper semantic layer sitting between the raw data and the visualisation.</p>
<p>The second most common failure is building for the person who commissioned it rather than the person who will use it. Executive dashboards are designed in workshops with executives who then never open them. The people who actually need the data are analysts and operations managers who have completely different requirements and workflows.</p>
<h2>The KPI Framework Problem</h2>
<p>Many organisations start a BI project without a defined KPI framework. This means the dashboards get built around what data exists rather than what questions the business needs to answer. When the data does not align with the questions, the reports get ignored and people go back to spreadsheets.</p>
<p>The fix is straightforward but often skipped: run a KPI definition workshop before touching the data. Map each metric to a specific decision that needs to be made. If a metric does not support a decision, it does not belong in the report. This filters out 60-70% of the complexity before a single query is written.</p>
<h2>What Good BI Looks Like</h2>
<p>A well-built BI solution has a star schema or similar structured data model, clearly named measures with documented calculation logic, row-level security so users only see what they are authorised to see, and a self-service layer that lets business users answer their own follow-up questions without involving IT. These are not aspirational features. They are the minimum baseline for a solution that will survive 18 months of real use.</p>',
    ],
    [
        'title'   => 'React vs WordPress: Choosing the Right Platform for a Business Website',
        'date'    => '2025-11-18 09:30:00',
        'cat'     => 'Web Development',
        'excerpt' => 'The right answer depends on your actual requirements, not the preferences of the developer pitching to you. Here is a framework for making the decision properly.',
        'content' => '<p>Every few months a client comes to us after being told by one agency that they need a headless React application and by another that WordPress is all they need. Both answers can be right. The problem is that neither answer was based on a proper requirements analysis.</p>
<h2>When WordPress Is the Right Choice</h2>
<p>WordPress is the correct answer when content editors need to be able to update the site without developer involvement, when budget is a realistic constraint, when you need a proven ecosystem of plugins for e-commerce, forms, SEO, and user management, and when the development timeline is measured in weeks rather than months.</p>
<p>The modern WordPress stack with Astra or a custom theme, ACF for structured content, and proper child theme architecture can handle the vast majority of business website requirements. The performance arguments against WordPress largely disappear with proper caching, a CDN, and code that does not load 40 plugins on every page request.</p>
<h2>When React Makes Sense</h2>
<p>React becomes the right choice when you are building a highly interactive application rather than a content site. If users are performing complex actions, if the UI has state that changes frequently based on user input, or if you are building something that behaves more like software than a website, React gives you the component model and state management you need.</p>
<p>Headless WordPress with a React frontend is a legitimate architecture for large editorial operations that need both a rich content management backend and a highly performant, customisable frontend. But it doubles the infrastructure complexity and ongoing maintenance cost.</p>
<h2>The Honest Framework</h2>
<p>Ask three questions. First: who will update the content, and how often? Second: does the user interface require complex client-side state? Third: what is the total cost of ownership over 3 years, including developer maintenance? The answers to these three questions determine the platform, not the technical preferences of the team building it.</p>',
    ],
    [
        'title'   => 'Building a Data Pipeline That Actually Works in Production',
        'date'    => '2026-01-14 08:00:00',
        'cat'     => 'Data Analytics',
        'excerpt' => 'A proof-of-concept pipeline running on a laptop is not a production pipeline. Here is what changes when data engineering moves out of the notebook and into operations.',
        'content' => '<p>Data pipelines look deceptively simple in prototypes. You pull data from an API, transform it in pandas, and load it into a database. The whole thing runs in 30 seconds and the results look correct. Then you hand it to operations and within two weeks it is broken, running four hours late, or producing numbers that nobody trusts.</p>
<h2>The Gap Between Prototype and Production</h2>
<p>The prototype worked because the conditions were ideal. The source API was available every time you tested it. The data was clean. You ran it manually and could see when something went wrong. Production is different: APIs go down, rate limits hit at 3am, schema changes happen without warning, and nobody is watching.</p>
<p>A production-grade pipeline needs error handling at every stage, not just at the end. It needs idempotency, meaning you can run it twice and get the same result. It needs observability, so you know immediately when something fails and can understand why. And it needs documentation that a new team member can follow six months from now.</p>
<h2>The Architecture That Holds Up</h2>
<p>For most business data pipelines at the SME scale, a task orchestration tool like Apache Airflow or Prefect running on a managed cloud environment handles scheduling, retries, and alerting. Extract is separated from transform, which is separated from load. Data quality checks run after extraction and block the pipeline if critical validations fail.</p>
<p>The transformation layer is where most complexity lives. dbt (data build tool) has become the standard here because it brings software engineering practices to SQL transformation: version control, testing, documentation, and lineage tracking. A pipeline where transformations are undocumented SQL scripts is a pipeline that will fail silently and produce wrong numbers that get into board reports.</p>
<h2>The Single Most Important Design Decision</h2>
<p>Make every step in the pipeline auditable. Store raw data before transformation. Log every run with row counts and checksums. This makes debugging fast, makes data quality investigations tractable, and builds the trust with business stakeholders that the numbers are real. Without auditability, data quality issues become political problems rather than engineering problems.</p>',
    ],
];

foreach ( $sample_posts as $sp ) {
    $existing = get_page_by_title( $sp['title'], OBJECT, 'post' );
    if ( $existing ) {
        $log[] = "  <span style='color:#aaa'>SKIP  Post already exists: <b>{$sp['title']}</b></span>";
        continue;
    }
    $post_id = wp_insert_post( [
        'post_title'    => $sp['title'],
        'post_content'  => $sp['content'],
        'post_excerpt'  => $sp['excerpt'],
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_date'     => $sp['date'],
        'post_date_gmt' => get_gmt_from_date( $sp['date'] ),
        'comment_status' => 'open',
        'ping_status'   => 'closed',
    ] );
    if ( $post_id && ! is_wp_error( $post_id ) ) {
        wp_set_post_categories( $post_id, [ $blog_cat_ids[ $sp['cat'] ] ] );
        $log[] = "  <span style='color:#f59e0b'>CREATE Post: <b>{$sp['title']}</b> (ID {$post_id})</span>";
    }
}

// Remove default "Hello World" post if it exists
$hello_world = get_page_by_title( 'Hello world!', OBJECT, 'post' );
if ( $hello_world ) {
    wp_delete_post( $hello_world->ID, true );
    $log[] = "  <span style='color:#f87171'>DELETED default Hello World post</span>";
}

/* ================================================================
   4. NAV MENU SETUP
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
        [ 'title' => 'Home',         'url' => home_url( '/' ),                    'object_id' => $home_id,     'order' => 1 ],
        [ 'title' => 'About',        'url' => home_url( '/about/' ),              'object_id' => $about_id,    'order' => 2 ],
        [ 'title' => 'Services',     'url' => home_url( '/services/' ),           'object_id' => $services_id, 'order' => 3 ],
        [ 'title' => 'Projects',     'url' => home_url( '/projects/' ),           'object_id' => $projects_id, 'order' => 4 ],
        [ 'title' => 'Insights',     'url' => home_url( '/insights/' ),           'object_id' => $insights_id, 'order' => 5 ],
        [ 'title' => 'Contact',      'url' => home_url( '/contact/' ),            'object_id' => $contact_id,  'order' => 6 ],
        [ 'title' => 'My Portal',    'url' => home_url( '/client-portal/' ),      'object_id' => $portal_id,   'order' => 7 ],
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
<p>Run on: <b><?php echo date( 'Y-m-d H:i:s' ); ?></b> | Site: <b><?php echo esc_html( home_url() ); ?></b></p>
<pre><?php echo implode( "\n", $log ); ?></pre>
<div class="box">
  <p><b class="warn">&#9888; Important Security:</b> Delete or rename <code>setup-content.php</code> from your theme folder now that setup is complete. Leaving it accessible is a security risk.</p>
  <p>You can also verify the setup by visiting <a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" style="color:#38bdf8">Appearance &rarr; Menus</a> and <a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>" style="color:#38bdf8">Settings &rarr; Reading</a>.</p>
</div>
</body>
</html>

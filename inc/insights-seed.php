<?php
/**
 * Insights articles maintained in the theme, and the content guard that
 * creates them and the FAQ page once.
 *
 * Articles are inserted as normal posts the first time the guard runs, so
 * they can be edited in WP Admin afterwards. Raising
 * DATALKEMI_CONTENT_VERSION re-runs the guard; existing posts and pages
 * are found by slug and left alone.
 *
 * @package Datalkemi
 * @since   2.6.0
 */

defined( 'ABSPATH' ) || exit;

define( 'DATALKEMI_CONTENT_VERSION', 1 );

/**
 * @return array<int, array{slug: string, title: string, excerpt: string, category: string, date: string, content: string}>
 */
function datalkemi_insights_articles(): array {
	return [
		[
			'slug'     => 'how-much-does-a-website-cost-in-perth-2026',
			'title'    => 'How Much Does a Website Cost in Perth in 2026?',
			'excerpt'  => 'What a business website, online store, or web application costs in Perth and across Australia in 2026, what drives the price, and the ongoing costs to budget for.',
			'category' => 'web-development',
			'date'     => '2026-11-08 09:00:00',
			'content'  => '
<p>Ask three Perth agencies what a website costs and you can get three answers that differ by thousands of dollars. That is not because anyone is being dishonest. "A website" can mean a single page that lists your phone number, or a booking platform that runs your business. This guide breaks down what each type of website costs in Perth in 2026, what drives the price up or down, and the ongoing costs most quotes leave out.</p>

<h2>The short answer</h2>
<p>For most small and medium businesses in Perth, a professionally built website costs somewhere between a few hundred dollars and several thousand. Published Australian agency price guides commonly put a standard business website at A$2,000 to A$8,000, an online store at A$2,000 to A$10,000, and a custom web application at A$10,000 and up. Where a project lands in that range depends on how many pages it has, whether the design is custom, who writes the content, and what the site needs to do beyond showing information.</p>

<div class="dk-table-wrap"><table class="dk-table">
<thead><tr><th>Type of website</th><th>Typical Australian range</th><th>Datalkemi starting price</th></tr></thead>
<tbody>
<tr><td>Small to medium business website</td><td>A$2,000 to A$8,000</td><td>From A$500</td></tr>
<tr><td>Online store</td><td>A$2,000 to A$10,000</td><td>From A$1,000</td></tr>
<tr><td>Web application or client portal</td><td>A$10,000 and up</td><td>From A$1,000</td></tr>
<tr><td>Enterprise platform</td><td>A$50,000 and up</td><td>Quoted after scoping</td></tr>
</tbody>
</table></div>
<p>Our starting prices sit well below the typical range because we keep the base build focused and let you add only the features you need. Modern tools, including AI-assisted development, have also made the routine parts of a build much faster than they were a few years ago, and we pass that saving on rather than billing for hours that no longer need to be spent.</p>

<h2>What actually drives the price</h2>

<h3>1. Number of pages and how different they are</h3>
<p>Five pages that share one layout cost far less than five pages that each need their own design. A typical small business site has a home page, about, services, contact, and perhaps a page per service or location.</p>

<h3>2. Template or custom design</h3>
<p>A proven layout adapted to your brand colours and fonts is quick to build and works well for most service businesses. A fully custom design, starting from wireframes and mock-ups, costs more but makes sense when your brand or your customers need something distinctive.</p>

<h3>3. Who writes the content</h3>
<p>Content is the most common cause of delays and budget overruns. If your text and photos are ready, the build moves quickly. If the agency needs to write copy, source images, or interview your team, budget for it from the start.</p>

<h3>4. Features beyond information</h3>
<p>Each of these adds cost because it adds logic, testing, and something that has to keep working after launch:</p>
<ul>
<li>Online bookings or appointment scheduling</li>
<li>A shop with payments, shipping, and stock</li>
<li>Customer logins, portals, or member areas</li>
<li>Integrations with your CRM, accounting software, or email marketing</li>
<li>A blog or news section you update yourself</li>
<li>Multiple languages</li>
</ul>

<h3>5. SEO from day one</h3>
<p>A site that cannot be found does not bring in enquiries. Technical SEO, meaning fast mobile pages, proper page titles and descriptions, structured data, and a sitemap, should be part of every build rather than an add-on. Ongoing content and ranking work is a separate, monthly service.</p>

<h2>The ongoing costs to budget for</h2>
<p>The build is a one-off cost, but every website has a few running costs. These are paid to the providers directly, in your name:</p>
<ul>
<li><strong>Domain name:</strong> a .com.au or .com address, renewed every year or two.</li>
<li><strong>Hosting:</strong> from a few dollars a month for a small WordPress site on shared hosting, to more for busy stores and web applications.</li>
<li><strong>Email:</strong> if you want addresses at your own domain, through a provider such as Google Workspace or Microsoft 365.</li>
<li><strong>Updates and support:</strong> WordPress, plugins, and security patches need regular updates. You can do this yourself or pay for a support plan.</li>
</ul>

<h2>How to keep the cost down without cutting corners</h2>
<ul>
<li><strong>Start with what brings in work.</strong> Launch the pages that win enquiries first and add the rest later.</li>
<li><strong>Have your content ready.</strong> Text, photos, and your logo, before the build starts.</li>
<li><strong>Choose a template-based design</strong> unless your brand genuinely needs custom work.</li>
<li><strong>Own your accounts.</strong> Make sure the domain, hosting, and website files are in your name, so you are never locked in to one provider.</li>
<li><strong>Get a fixed written quote</strong> that lists the pages, features, and timeline, so the price cannot drift.</li>
</ul>

<h2>Questions to ask before you sign</h2>
<ul>
<li>Is the price fixed, and what exactly does it include?</li>
<li>Who owns the website, the code, and the domain when the project ends?</li>
<li>Will I be able to edit the content myself?</li>
<li>Is technical SEO included, and is Google Search Console set up at launch?</li>
<li>What support is included after launch, and what does it cost after that?</li>
</ul>

<h2>Working out your own price</h2>
<p>The quickest way to get a real number for your project is to use our <a href="https://datalkemi.com/build-your-project/">project estimator</a>. Choose what the website is for, pick the features you need, and it shows a starting price in Australian dollars, US dollars, or Indian rupees. We then confirm it in a fixed written quote after a short call.</p>
<p>Datalkemi builds websites for businesses in <a href="https://datalkemi.com/services/web-development/">Perth and across Australia</a>, and for <a href="https://datalkemi.com/website-development-india/">businesses in India</a>. If you have a question that is not covered here, our <a href="https://datalkemi.com/faq/">FAQ page</a> answers the most common ones, or you can <a href="https://datalkemi.com/contact/">contact us</a> directly.</p>
',
		],
	];
}

/**
 * Content guard: the FAQ page and the theme's Insights articles.
 */
function datalkemi_ensure_content() {
	if ( (int) get_option( 'datalkemi_content_version' ) >= DATALKEMI_CONTENT_VERSION ) {
		return;
	}

	$faq = get_page_by_path( 'faq' );
	if ( ! $faq ) {
		wp_insert_post( [
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => 'faq',
			'post_title'   => 'Frequently Asked Questions',
			'post_content' => '',
		] );
	} elseif ( 'publish' !== $faq->post_status ) {
		wp_update_post( [ 'ID' => $faq->ID, 'post_status' => 'publish' ] );
	}

	$admins = get_users( [ 'role' => 'administrator', 'number' => 1, 'orderby' => 'ID', 'fields' => 'ID' ] );
	$author = $admins ? (int) $admins[0] : 1;

	foreach ( datalkemi_insights_articles() as $article ) {
		$existing = get_posts( [ 'name' => $article['slug'], 'post_type' => 'post', 'post_status' => 'any', 'numberposts' => 1 ] );
		if ( $existing ) {
			continue;
		}
		$cat = get_category_by_slug( $article['category'] );
		wp_insert_post( [
			'post_type'     => 'post',
			'post_status'   => 'publish',
			'post_name'     => $article['slug'],
			'post_title'    => $article['title'],
			'post_excerpt'  => $article['excerpt'],
			'post_content'  => trim( $article['content'] ),
			'post_author'   => $author,
			'post_date'     => $article['date'],
			'post_category' => $cat ? [ (int) $cat->term_id ] : [],
		] );
	}

	update_option( 'datalkemi_content_version', DATALKEMI_CONTENT_VERSION );
}
add_action( 'init', 'datalkemi_ensure_content', 27 );

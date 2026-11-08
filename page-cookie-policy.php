<?php
/**
 * Cookie Policy (slug: cookie-policy).
 *
 * WordPress uses this file automatically for the page with the slug
 * cookie-policy, so the policy is maintained here, in the theme, rather
 * than in the page editor. Keep it in step with inc/consent.php and any
 * new script or plugin that stores data in the browser.
 *
 * @package Datalkemi
 * @since   2.4.0
 */
get_header();

$updated = '8 November 2026';
?>

<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Legal', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title"><?php esc_html_e( 'Cookie Policy', 'datalkemi' ); ?></h1>
		<p class="page-hero-subtitle"><?php esc_html_e( 'What this website stores in your browser, why, and how to change your choice.', 'datalkemi' ); ?></p>
	</div>
</section>

<section class="dk-section">
	<div class="dk-container">
		<div class="dk-prose">

			<p class="dk-prose-meta"><?php echo esc_html( sprintf( __( 'Last updated %s', 'datalkemi' ), $updated ) ); ?></p>

			<div class="dk-settings-card" id="cookie-settings">
				<p><?php esc_html_e( 'You can change your cookie choice at any time.', 'datalkemi' ); ?></p>
				<button type="button" class="dk-btn dk-btn-primary" data-dk-consent-open><?php esc_html_e( 'Cookie settings', 'datalkemi' ); ?></button>
			</div>

			<p><?php esc_html_e( 'This policy explains how datalkemi.com, operated by Datalkemi in Perth, Western Australia, uses cookies and similar browser storage. It should be read together with our', 'datalkemi' ); ?> <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'datalkemi' ); ?></a>.</p>

			<h2><?php esc_html_e( 'What cookies are', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'Cookies are small text files a website saves in your browser so it can recognise your device on a later page or visit. Local storage works in a similar way but stays in your browser and is never sent to a server automatically. We describe both here.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Our approach', 'datalkemi' ); ?></h2>
			<ul>
				<li><?php esc_html_e( 'Analytics and marketing cookies only load after you choose "Accept all" in the cookie banner.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'If you choose "Essential only", or make no choice, the website works fully and no analytics or marketing cookies are set.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'We do not use advertising networks, sell data, or set cookies to show you ads on other websites.', 'datalkemi' ); ?></li>
			</ul>

			<h2><?php esc_html_e( 'Essential and functional storage', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'These are needed for the site to work or to remember a choice you made. They do not track you and do not need your consent.', 'datalkemi' ); ?></p>
			<div class="dk-table-wrap">
				<table class="dk-table">
					<thead><tr><th><?php esc_html_e( 'Name', 'datalkemi' ); ?></th><th><?php esc_html_e( 'Type', 'datalkemi' ); ?></th><th><?php esc_html_e( 'Purpose', 'datalkemi' ); ?></th><th><?php esc_html_e( 'Kept for', 'datalkemi' ); ?></th></tr></thead>
					<tbody>
						<tr><td><code>dk-consent</code></td><td><?php esc_html_e( 'Local storage', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Remembers your cookie choice so the banner does not appear on every page.', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Until you clear it or change your choice', 'datalkemi' ); ?></td></tr>
						<tr><td><code>dk-theme</code></td><td><?php esc_html_e( 'Local storage', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Remembers light or dark theme, only after you use the theme toggle. Otherwise the site follows your device setting.', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Until you clear it', 'datalkemi' ); ?></td></tr>
						<tr><td><code>dk_voted_</code><?php esc_html_e( 'and an article number', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Cookie', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Set only when you like or dislike an Insights article, so the same vote is not counted twice.', 'datalkemi' ); ?></td><td><?php esc_html_e( '30 days', 'datalkemi' ); ?></td></tr>
						<tr><td><code>wordpress_logged_in_</code>, <code>wordpress_sec_</code>, <code>wordpress_test_cookie</code></td><td><?php esc_html_e( 'Cookies', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Keep you signed in. Set only when you log in to the client portal or site administration.', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Until you sign out, or up to 14 days if you choose "Remember me"', 'datalkemi' ); ?></td></tr>
					</tbody>
				</table>
			</div>

			<h2><?php esc_html_e( 'Analytics and marketing cookies (only with your consent)', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'We use HubSpot to understand which pages are useful and to connect an enquiry you send us with the pages you viewed, so we can reply with the right context. HubSpot, Inc. processes this data on our behalf. These cookies are set on datalkemi.com by HubSpot\'s tracking code, which only runs after you accept.', 'datalkemi' ); ?></p>
			<div class="dk-table-wrap">
				<table class="dk-table">
					<thead><tr><th><?php esc_html_e( 'Name', 'datalkemi' ); ?></th><th><?php esc_html_e( 'Provider', 'datalkemi' ); ?></th><th><?php esc_html_e( 'Purpose', 'datalkemi' ); ?></th><th><?php esc_html_e( 'Kept for', 'datalkemi' ); ?></th></tr></thead>
					<tbody>
						<tr><td><code>__hstc</code></td><td>HubSpot</td><td><?php esc_html_e( 'Main visitor cookie. Records first visit, last visit, current visit and number of sessions.', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Up to 13 months', 'datalkemi' ); ?></td></tr>
						<tr><td><code>hubspotutk</code></td><td>HubSpot</td><td><?php esc_html_e( 'Recognises a returning visitor and links their visits to a contact record if they submit a form.', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Up to 13 months', 'datalkemi' ); ?></td></tr>
						<tr><td><code>__hssc</code></td><td>HubSpot</td><td><?php esc_html_e( 'Tracks the current session to count pages viewed.', 'datalkemi' ); ?></td><td><?php esc_html_e( '30 minutes', 'datalkemi' ); ?></td></tr>
						<tr><td><code>__hssrc</code></td><td>HubSpot</td><td><?php esc_html_e( 'Detects when a new session starts.', 'datalkemi' ); ?></td><td><?php esc_html_e( 'End of the browser session', 'datalkemi' ); ?></td></tr>
						<tr><td><code>__cf_bm</code></td><td><?php esc_html_e( 'Cloudflare, for HubSpot', 'datalkemi' ); ?></td><td><?php esc_html_e( 'Separates people from automated bots on HubSpot\'s systems. Only set once HubSpot loads.', 'datalkemi' ); ?></td><td><?php esc_html_e( '30 minutes', 'datalkemi' ); ?></td></tr>
					</tbody>
				</table>
			</div>
			<p><?php esc_html_e( 'HubSpot may adjust these names or durations. Its current list is in the HubSpot Knowledge Base under "Cookies set by HubSpot".', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Services that do not set cookies here', 'datalkemi' ); ?></h2>
			<ul>
				<li><strong><?php esc_html_e( 'Google Fonts.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'Our typefaces load from Google\'s servers, which receive your IP address to deliver them. No cookies are set.', 'datalkemi' ); ?></li>
				<li><strong><?php esc_html_e( 'Google reviews.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'When shown, review text is fetched by our server from Google and displayed on our page. Reviewer photos load from Google\'s servers without cookies.', 'datalkemi' ); ?></li>
				<li><strong><?php esc_html_e( 'Hosting and caching.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'The site is hosted by Hostinger and cached with LiteSpeed. These do not set cookies for visitors who are not signed in.', 'datalkemi' ); ?></li>
			</ul>

			<h2><?php esc_html_e( 'Links to other websites', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'Some buttons take you to other services, such as HubSpot Meetings to book a call, Google Maps to read or leave a review, LinkedIn and Instagram. Those sites set their own cookies under their own policies once you are there.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Changing your choice', 'datalkemi' ); ?></h2>
			<ul>
				<li><?php esc_html_e( 'Use "Cookie settings" at the top of this page or in the footer of any page. If you withdraw consent, we stop HubSpot tracking and remove its cookies from this site.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'You can also block or delete cookies in your browser settings. Blocking all cookies will sign you out of the client portal but will not stop the public website from working.', 'datalkemi' ); ?></li>
			</ul>

			<h2><?php esc_html_e( 'Changes to this policy', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'We update this page when we add or remove a service that stores data in your browser. The date at the top shows the latest version.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Contact', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'Questions about cookies or your personal information can be sent to', 'datalkemi' ); ?> <a href="mailto:info@datalkemi.com">info@datalkemi.com</a>.</p>

		</div>
	</div>
</section>

<?php get_footer();

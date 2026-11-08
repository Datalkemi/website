<?php
/**
 * Privacy Policy (slug: privacy-policy).
 *
 * WordPress uses this file automatically for the page with the slug
 * privacy-policy, so the policy is maintained here, in the theme. Keep it
 * in step with the forms in functions.php and inc/newsletter.php, the
 * client portal, and page-cookie-policy.php.
 *
 * @package Datalkemi
 * @since   2.5.0
 */
get_header();

$updated = '8 November 2026';
?>

<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Legal', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title"><?php esc_html_e( 'Privacy Policy', 'datalkemi' ); ?></h1>
		<p class="page-hero-subtitle"><?php esc_html_e( 'What personal information we collect, why we collect it, and the choices you have.', 'datalkemi' ); ?></p>
	</div>
</section>

<section class="dk-section">
	<div class="dk-container">
		<div class="dk-prose">

			<p class="dk-prose-meta"><?php echo esc_html( sprintf( __( 'Last updated %s', 'datalkemi' ), $updated ) ); ?></p>

			<p><?php esc_html_e( 'Datalkemi, based in Perth, Western Australia, operates datalkemi.com and provides website development, software, SEO, and data services. We handle personal information in line with the Australian Privacy Principles in the Privacy Act 1988 (Cth). If you are in India, we also respect your rights under the Digital Personal Data Protection Act 2023.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Information we collect', 'datalkemi' ); ?></h2>
			<ul>
				<li><strong><?php esc_html_e( 'Enquiries.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'When you use the contact form, the quote form, or the project estimator, we collect your name, email address, and anything else you choose to give us, such as your company, phone number, budget, timeline, and project details.', 'datalkemi' ); ?></li>
				<li><strong><?php esc_html_e( 'Newsletter.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'If you subscribe, we collect your email address and the page you subscribed from.', 'datalkemi' ); ?></li>
				<li><strong><?php esc_html_e( 'Client portal.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'If you are a client, we hold your name, email address, and login details, along with project information we share with you there.', 'datalkemi' ); ?></li>
				<li><strong><?php esc_html_e( 'Website usage.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'Our hosting provider records standard server logs, including IP address, browser, and pages requested, to keep the site secure. If you accept analytics cookies, HubSpot records the pages you view. Our', 'datalkemi' ); ?> <a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>"><?php esc_html_e( 'Cookie Policy', 'datalkemi' ); ?></a> <?php esc_html_e( 'explains this in detail.', 'datalkemi' ); ?></li>
				<li><strong><?php esc_html_e( 'Client work.', 'datalkemi' ); ?></strong> <?php esc_html_e( 'When we build or manage systems for clients, we may handle personal information held in those systems. We do so only on the client\'s instructions and under our agreement with them.', 'datalkemi' ); ?></li>
			</ul>

			<h2><?php esc_html_e( 'How we use it', 'datalkemi' ); ?></h2>
			<ul>
				<li><?php esc_html_e( 'To reply to your enquiry, prepare quotes and proposals, and deliver the work you engage us for.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'To send you a copy of your estimate or brief, and to follow up on it.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'To send our newsletter, if you subscribed. Every email has an unsubscribe link.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'To run the client portal and keep accounts secure.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'To understand which pages are useful and improve the website, where you have accepted analytics cookies.', 'datalkemi' ); ?></li>
			</ul>
			<p><?php esc_html_e( 'We do not sell personal information, and we do not use it for advertising on other websites.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Who we share it with', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'We use a small number of service providers who process information on our behalf:', 'datalkemi' ); ?></p>
			<ul>
				<li><strong>Hostinger</strong> <?php esc_html_e( 'hosts the website and its database.', 'datalkemi' ); ?></li>
				<li><strong>HubSpot</strong> <?php esc_html_e( 'manages newsletter subscriptions, enquiry records, meeting bookings, and, with your consent, website analytics.', 'datalkemi' ); ?></li>
				<li><strong>Brevo</strong> <?php esc_html_e( 'delivers the emails the website sends, such as estimate confirmations.', 'datalkemi' ); ?></li>
				<li><strong>Google</strong> <?php esc_html_e( 'serves the fonts used on the site, and provides the review content we display.', 'datalkemi' ); ?></li>
			</ul>
			<p><?php esc_html_e( 'Some of these providers store data outside Australia, including in the United States, Europe, and Singapore. We choose providers with recognised security practices and take reasonable steps to make sure they protect your information. We may also disclose information where the law requires it.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'How long we keep it', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'We keep enquiry and client records for as long as we need them to provide our services and meet our legal, tax, and accounting obligations. Newsletter details are kept until you unsubscribe. When information is no longer needed, we delete or de-identify it.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Keeping it secure', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'The website runs over HTTPS, access to systems holding personal information is limited to people who need it, and accounts are protected by passwords and, where available, two-factor authentication. No system is perfectly secure, but we take reasonable steps to protect information from misuse, loss, and unauthorised access.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Your choices and rights', 'datalkemi' ); ?></h2>
			<ul>
				<li><?php esc_html_e( 'You can ask to see the personal information we hold about you and ask us to correct it.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'You can ask us to delete it, unless we need to keep it to meet a legal obligation.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'You can unsubscribe from the newsletter at any time, and change your cookie choice using Cookie settings in the footer.', 'datalkemi' ); ?></li>
				<li><?php esc_html_e( 'You can contact us without identifying yourself, although we may not be able to help with a project that way.', 'datalkemi' ); ?></li>
			</ul>
			<p><?php esc_html_e( 'We aim to respond to requests within 30 days.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Complaints', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'If you are concerned about how we have handled your information, please email us first so we can look into it. If you are not satisfied with our response, you can contact the Office of the Australian Information Commissioner at oaic.gov.au.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Changes to this policy', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'We update this page when the way we handle personal information changes. The date at the top shows the latest version.', 'datalkemi' ); ?></p>

			<h2><?php esc_html_e( 'Contact', 'datalkemi' ); ?></h2>
			<p><?php esc_html_e( 'Privacy questions and requests can be sent to', 'datalkemi' ); ?> <a href="mailto:info@datalkemi.com">info@datalkemi.com</a>.</p>

		</div>
	</div>
</section>

<?php get_footer();

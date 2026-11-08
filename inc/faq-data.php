<?php
/**
 * Questions and answers for the FAQ page (slug: faq).
 *
 * Kept in one place so page-faq.php and the FAQPage structured data in
 * inc/seo.php always match. Prices here must agree with the project
 * estimator in inc/configurator-data.php.
 *
 * @package Datalkemi
 * @since   2.6.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<int, array{title: string, items: array<int, array{q: string, a: string}>}>
 */
function datalkemi_faq_groups(): array {
	return [
		[
			'title' => 'Working with Datalkemi',
			'items' => [
				[ 'q' => 'What does Datalkemi do?', 'a' => 'Datalkemi is a Perth web development and data agency. We design and build business websites, online stores, web applications, and client portals, and we set up the SEO, analytics, dashboards, and reporting that sit behind them.' ],
				[ 'q' => 'Where are you based, and who do you work with?', 'a' => 'We are based in Perth, Western Australia, and work with businesses across Australia and in India. Most projects run entirely online, with video calls, email, and shared preview links at every stage.' ],
				[ 'q' => 'Do I need to know what technology I want?', 'a' => 'No. Tell us what the website needs to do and who it is for. We recommend the platform, usually WordPress for content-led sites or a custom React build for web applications, and explain why in plain language before you commit.' ],
				[ 'q' => 'Can you take over or redesign an existing website?', 'a' => 'Yes. We start with a review of the current site, including speed, search visibility, and how it is maintained, then recommend whether to improve it or rebuild it. We can move your content across and keep your existing search rankings by redirecting old addresses.' ],
			],
		],
		[
			'title' => 'Pricing',
			'items' => [
				[ 'q' => 'How much does a website cost?', 'a' => 'Small to medium business websites start from A$500. Personal portfolios, online stores, web applications, dashboards, and automation projects start from A$1,000. Enterprise platforms are scoped and quoted by our team. The project estimator shows a price in AUD, USD, or INR as you choose features.' ],
				[ 'q' => 'Is the estimate the final price?', 'a' => 'The estimator gives a starting figure. After a 30-minute scoping call we confirm the price in a written quote with the pages, features, and timeline listed, and work starts only once you approve it.' ],
				[ 'q' => 'Do you charge GST?', 'a' => 'Prices for Australian clients are shown excluding GST. Your written quote shows any GST that applies. Clients outside Australia are quoted in USD or INR.' ],
				[ 'q' => 'Are there ongoing costs after launch?', 'a' => 'Every website needs a domain name and hosting, which are paid to those providers in your name. Support and updates after the included post-launch period are optional and quoted separately, so you only pay for help when you want it.' ],
			],
		],
		[
			'title' => 'Process and timelines',
			'items' => [
				[ 'q' => 'How long does a website take to build?', 'a' => 'A business website usually takes two to three weeks from the discovery call to launch. Online stores and web applications are delivered in one or two week sprints, with a working demo at the end of each sprint. Your quote includes the timeline.' ],
				[ 'q' => 'What do I need to provide?', 'a' => 'Your logo and brand colours if you have them, the text and images you want to use, and examples of websites you like. If you do not have content ready, we can write and source it as part of the project.' ],
				[ 'q' => 'Can I make changes during the project?', 'a' => 'Yes. Small changes are handled within each review round. Larger changes to scope are quoted before we do them, so the price never changes without your approval.' ],
			],
		],
		[
			'title' => 'After launch',
			'items' => [
				[ 'q' => 'Who owns the website?', 'a' => 'You do. The code, designs, and content we produce for you are yours once the final invoice is paid, and the domain and hosting accounts are set up in your name.' ],
				[ 'q' => 'Will I be able to update the website myself?', 'a' => 'Yes. WordPress websites include an editor for pages, images, and blog posts, and we provide training and written instructions at handover.' ],
				[ 'q' => 'Is SEO included?', 'a' => 'Technical SEO is part of every website we build: fast mobile pages, page titles and descriptions, structured data, a sitemap, and Google Search Console set up at launch. Ongoing content and ranking work is available through our SEO service.' ],
			],
		],
		[
			'title' => 'Clients in India',
			'items' => [
				[ 'q' => 'Do you build websites for businesses in India?', 'a' => 'Yes. We work with clients in India entirely online. Perth is two and a half hours ahead of India Standard Time, so our working day overlaps with your morning and early afternoon.' ],
				[ 'q' => 'Do you quote in Indian rupees?', 'a' => 'Clients in India are quoted in Indian rupees, with business websites starting from Rs 20,000. The project estimator shows rupee pricing when you choose INR.' ],
			],
		],
	];
}

/**
 * All questions as one flat list, for structured data.
 *
 * @return array<int, array{q: string, a: string}>
 */
function datalkemi_faq_items(): array {
	$items = [];
	foreach ( datalkemi_faq_groups() as $group ) {
		$items = array_merge( $items, $group['items'] );
	}
	return $items;
}

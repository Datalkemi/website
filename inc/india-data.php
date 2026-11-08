<?php
/**
 * Content for the India website development page (slug: website-development-india).
 *
 * Kept in one place so the template and the structured data in inc/seo.php
 * read the same questions and answers.
 *
 * @package Datalkemi
 * @since   2.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array{services: array, reasons: array, process: array, faqs: array}
 */
function datalkemi_india_page_data(): array {
	$icon = function ( string $paths ): string {
		return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths . '</svg>';
	};

	return [
		'services' => [
			[
				'title' => 'Business websites',
				'desc'  => 'Service, about, and contact pages that explain what you do and turn visitors into enquiries, with WhatsApp and call buttons where your customers expect them.',
				'svg'   => $icon( '<rect x="3" y="4" width="18" height="14" rx="1"/><path d="M3 8h18M8 21h8M12 18v3"/>' ),
			],
			[
				'title' => 'Online stores',
				'desc'  => 'Product catalogues, cart, checkout, and order management, connected to the payment gateway you use, such as Razorpay, PayU, or Stripe.',
				'svg'   => $icon( '<path d="M3 4h2l2.4 11.2a1 1 0 0 0 1 .8h9.2a1 1 0 0 0 1-.8L20 8H6"/><circle cx="9" cy="20" r="1"/><circle cx="17" cy="20" r="1"/>' ),
			],
			[
				'title' => 'Web applications and portals',
				'desc'  => 'Booking systems, student and client portals, and internal tools with secure logins, so your team stops working from spreadsheets and notebooks.',
				'svg'   => $icon( '<rect x="3" y="3" width="18" height="18" rx="1"/><path d="M3 9h18M9 21V9"/>' ),
			],
			[
				'title' => 'SEO and Google visibility',
				'desc'  => 'Fast mobile pages, structured data, a sitemap, Google Search Console, and Google Business Profile, targeted at the cities and areas you serve.',
				'svg'   => $icon( '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/>' ),
			],
		],
		'reasons'  => [
			[
				'title' => 'Working hours that overlap',
				'desc'  => 'Perth is only two and a half hours ahead of India, so our working day covers your morning and early afternoon. Calls, reviews, and quick fixes happen the same day.',
				'svg'   => $icon( '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>' ),
			],
			[
				'title' => 'A fixed quote before we start',
				'desc'  => 'Use the project estimator to see a price in Indian rupees, then receive a written quote with scope and timeline. No hourly billing surprises.',
				'svg'   => $icon( '<rect x="5" y="3" width="14" height="18" rx="1"/><path d="M8 7h8M8 11h8M8 15h5"/>' ),
			],
			[
				'title' => 'Built for phones first',
				'desc'  => 'Most visitors in India arrive on a phone, often on mobile data. We design for small screens first and keep pages light so they load quickly on any network.',
				'svg'   => $icon( '<rect x="7" y="2" width="10" height="20" rx="1"/><path d="M11 18h2"/>' ),
			],
			[
				'title' => 'You own everything',
				'desc'  => 'The code, design files, domain, and hosting accounts are in your name. You get documentation and training at handover, so you are never locked in.',
				'svg'   => $icon( '<rect x="4" y="10" width="16" height="11" rx="1"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/>' ),
			],
		],
		'process'  => [
			[ 'step' => '01', 'title' => 'Discovery call', 'desc' => 'A video call at a time that suits you in IST. We go through your business, your customers, and what the website needs to do.' ],
			[ 'step' => '02', 'title' => 'Quote and plan', 'desc' => 'A written quote with pages, features, timeline, and price. Work starts once you approve it.' ],
			[ 'step' => '03', 'title' => 'Design and build', 'desc' => 'You review a live preview link as the site takes shape and send feedback by email or message.' ],
			[ 'step' => '04', 'title' => 'Launch and handover', 'desc' => 'We connect your domain, set up Google Search Console, and hand over logins, documentation, and training.' ],
		],
		'faqs'     => [
			[ 'q' => 'Can an Australian company build a website for my business in India?', 'a' => 'Yes. Datalkemi is based in Perth and works with clients in India entirely online. Discovery, design reviews, and handover happen over video calls, email, and shared preview links, and our working hours overlap with most of the Indian business day.' ],
			[ 'q' => 'What hours are you available in IST?', 'a' => 'Perth is two and a half hours ahead of India Standard Time. Our weekday working hours fall roughly between 6:30 am and 3:00 pm IST, so calls are usually booked in your morning or early afternoon.' ],
			[ 'q' => 'How much does a website cost in India?', 'a' => 'Small to medium business websites start from Rs 20,000. Online stores, web applications, and portfolios start from Rs 40,000. The project estimator shows your price in Indian rupees as you choose features, and we confirm it in a fixed written quote before work starts.' ],
			[ 'q' => 'How long does it take to build a website?', 'a' => 'A business website usually takes two to three weeks from the discovery call to launch. Online stores and web applications take longer and are delivered in stages with a working preview at each step. Your quote includes the timeline.' ],
			[ 'q' => 'Will my website rank on Google in India?', 'a' => 'Every site we build includes technical SEO: fast mobile pages, page titles and descriptions, structured data, a sitemap, and Google Search Console set up at launch. Rankings also depend on competition and content, so we do not promise positions, but we give you a site that search engines can read and trust.' ],
			[ 'q' => 'Who owns the website once it is finished?', 'a' => 'You do. The code, designs, and content we produce are yours once the final invoice is paid, and the domain and hosting are registered in your name.' ],
		],
	];
}

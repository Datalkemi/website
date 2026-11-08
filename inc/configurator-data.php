<?php
/**
 * Datalkemi Project Configurator pricing data.
 *
 * All prices are in Australian dollars. The configurator shows them in AUD,
 * USD (indicative exchange rate), or INR (a reduced rate for clients in
 * India, below a straight conversion). Prices are positioned at the accessible end of
 * published Australian market ranges for 2026: brochure sites A$2k to 8k,
 * stores A$2k to 10k, MVP web apps A$10k to 50k, dashboards A$15k to 40k
 * for a consultancy set, enterprise platforms A$50k and up.
 *
 * Structure
 *   currencies  code => symbol, name, rate from AUD, number locale, and the
 *               step prices are rounded to
 *   purposes    the first question; each sets a base price and the order
 *               of the sections that follow
 *   sections    radio or checkbox groups; an option with a 'for' list only
 *               appears for those purposes, and 'prices' can override the
 *               price per purpose
 */

defined( 'ABSPATH' ) || exit;

function datalkemi_get_configurator_data(): array {
	return [

		'currencies' => [
			'AUD' => [ 'symbol' => 'A$',      'name' => 'Australian dollars', 'rate' => 1.00, 'locale' => 'en-AU', 'round' => 1 ],
			'USD' => [ 'symbol' => 'US$',     'name' => 'US dollars',         'rate' => 0.65, 'locale' => 'en-US', 'round' => 10 ],
			'INR' => [ 'symbol' => "\u{20B9}", 'name' => 'Indian rupees',      'rate' => 40.0, 'locale' => 'en-IN', 'round' => 100 ],
		],

		'purposes' => [
			'label' => 'What is this project for?',
			'note'  => 'Pick the closest fit. The steps that follow change to suit it.',
			'options' => [
				[ 'id' => 'business',   'label' => 'Small to medium business website', 'desc' => 'Services, about, contact, and the pages that bring in enquiries.',                'price' => 500,  'steps' => [ 'scale', 'design', 'content', 'features', 'seo', 'hosting', 'support' ] ],
				[ 'id' => 'portfolio',  'label' => 'Personal portfolio or CV site',    'desc' => 'Show your work, your profile, and a way to get in touch.',                      'price' => 1000, 'steps' => [ 'scale', 'design', 'content', 'features', 'seo', 'hosting', 'support' ] ],
				[ 'id' => 'ecommerce',  'label' => 'Online store',                     'desc' => 'Catalogue, cart, checkout, shipping, and order management.',                     'price' => 1000, 'steps' => [ 'scale', 'design', 'content', 'features', 'seo', 'hosting', 'support' ] ],
				[ 'id' => 'webapp',     'label' => 'Web application or client portal', 'desc' => 'Logins, workflows, and data your team or clients work in every day.',            'price' => 1000, 'steps' => [ 'scale', 'design', 'features', 'hosting', 'support' ] ],
				[ 'id' => 'dashboard',  'label' => 'Dashboards and reporting',         'desc' => 'Connect your data and see it in Power BI, Looker Studio, or a custom view.',     'price' => 1000, 'steps' => [ 'scale', 'features', 'hosting', 'support' ] ],
				[ 'id' => 'automation', 'label' => 'Automation or integration',        'desc' => 'Move data between systems, remove manual steps, add alerts and approvals.',   'price' => 1000, 'steps' => [ 'scale', 'features', 'hosting', 'support' ] ],
				[ 'id' => 'enterprise', 'label' => 'Enterprise platform',              'desc' => 'Multi-tenant product with security, integrations, and compliance requirements. Scoped with our sales team.', 'price' => 0, 'quote' => true, 'steps' => [] ],
			],
		],

		'sections' => [

			'scale' => [
				'label' => 'How big is it?',
				'type'  => 'radio',
				'note'  => 'Start with the smallest option that fits. You can grow it later.',
				'options' => [
					[ 'id' => 'one-page',        'label' => 'One page',                         'desc' => 'A single scrolling page with sections.',                    'price' => 0,     'for' => [ 'portfolio' ] ],
					[ 'id' => 'five-pages',      'label' => 'Up to 5 pages',                    'desc' => 'Home, about, work, services or writing, contact.',           'price' => 300,   'for' => [ 'portfolio' ] ],
					[ 'id' => 'blog',            'label' => 'Pages plus a blog or case studies', 'desc' => 'A content section you keep adding to.',                     'price' => 600,   'for' => [ 'portfolio' ] ],

					[ 'id' => 'b-five',          'label' => 'Up to 5 pages',                    'desc' => 'A focused site for one service or location.',               'price' => 0,     'for' => [ 'business' ] ],
					[ 'id' => 'b-ten',           'label' => '6 to 10 pages',                    'desc' => 'Several services, team, case studies, blog.',               'price' => 600,   'for' => [ 'business' ] ],
					[ 'id' => 'b-twenty',        'label' => '11 to 20 pages',                   'desc' => 'Multiple locations or service lines, resources section.',   'price' => 1500,  'for' => [ 'business' ] ],

					[ 'id' => 'e-small',         'label' => 'Up to 25 products',                'desc' => 'A tight range with simple options.',                        'price' => 0,     'for' => [ 'ecommerce' ] ],
					[ 'id' => 'e-medium',        'label' => 'Up to 250 products',               'desc' => 'Categories, filters, and product variants.',                'price' => 900,   'for' => [ 'ecommerce' ] ],
					[ 'id' => 'e-large',         'label' => 'Large catalogue',                  'desc' => 'Bulk import, complex variants, wholesale pricing.',         'price' => 2500,  'for' => [ 'ecommerce' ] ],

					[ 'id' => 'w-single',        'label' => 'One core workflow',                'desc' => 'A single job done well, for one type of user.',             'price' => 0,     'for' => [ 'webapp' ] ],
					[ 'id' => 'w-modules',       'label' => 'Several modules and user roles',   'desc' => 'Admin, staff, and client views over shared data.',           'price' => 4000,  'for' => [ 'webapp' ] ],
					[ 'id' => 'w-tenant',        'label' => 'Multi-tenant with admin console',  'desc' => 'Many organisations, each with their own users and data.',   'price' => 12000, 'for' => [ 'webapp' ] ],

					[ 'id' => 'd-one',           'label' => 'One dashboard',                    'desc' => 'A single view answering one set of questions.',             'price' => 0,     'for' => [ 'dashboard' ] ],
					[ 'id' => 'd-few',           'label' => 'Two to four dashboards',           'desc' => 'Sales, operations, finance, each with its own audience.',   'price' => 3000,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'd-suite',         'label' => 'Reporting suite with a data model', 'desc' => 'A governed semantic layer behind many reports.',           'price' => 8000,  'for' => [ 'dashboard' ] ],

					[ 'id' => 'a-one',           'label' => 'One integration or workflow',      'desc' => 'Connect two systems or automate one process.',               'price' => 0,     'for' => [ 'automation' ] ],
					[ 'id' => 'a-few',           'label' => 'Two to four connected systems',    'desc' => 'Several flows with shared rules and logging.',              'price' => 2500,  'for' => [ 'automation' ] ],
					[ 'id' => 'a-pipeline',      'label' => 'Data pipeline with scheduling',    'desc' => 'Scheduled extraction, transformation, and monitoring.',     'price' => 6000,  'for' => [ 'automation' ] ],

					[ 'id' => 'x-core',          'label' => 'Core platform',                    'desc' => 'The product, its users, roles, and admin.',                 'price' => 0,     'for' => [ 'enterprise' ] ],
					[ 'id' => 'x-regulated',     'label' => 'Core platform with compliance',    'desc' => 'Audit trails, data residency, retention, access reviews.',  'price' => 15000, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'x-multi-region',  'label' => 'Multi-region, high availability',  'desc' => 'Redundant infrastructure and formal recovery targets.',     'price' => 30000, 'for' => [ 'enterprise' ] ],
				],
			],

			'design' => [
				'label' => 'Design approach',
				'type'  => 'radio',
				'note'  => 'Custom designs are produced in Figma and approved before development begins.',
				'options' => [
					[ 'id' => 'template',   'label' => 'Template based',               'desc' => 'A proven layout adapted to your brand colours and type.',        'price' => 0 ],
					[ 'id' => 'custom',     'label' => 'Custom design',                'desc' => 'Bespoke layouts designed around your content and users.',        'price' => 1200, 'prices' => [ 'portfolio' => 400, 'business' => 900, 'enterprise' => 6000 ] ],
					[ 'id' => 'brand',      'label' => 'Custom design plus brand system', 'desc' => 'Logo refresh, palette, type, and assets alongside the design.', 'price' => 2800, 'prices' => [ 'portfolio' => 1200, 'business' => 2200, 'enterprise' => 12000 ] ],
				],
			],

			'content' => [
				'label' => 'Content and copy',
				'type'  => 'radio',
				'options' => [
					[ 'id' => 'content-yours',  'label' => 'You supply the content',           'desc' => 'Text and images arrive ready, we place them.',            'price' => 0 ],
					[ 'id' => 'content-edit',   'label' => 'We edit and structure your content', 'desc' => 'You send drafts, we tighten them for the web.',           'price' => 400,  'prices' => [ 'portfolio' => 250 ] ],
					[ 'id' => 'content-write',  'label' => 'We write the copy',               'desc' => 'Interview, draft, and two rounds of revisions.',           'price' => 1200, 'prices' => [ 'portfolio' => 600, 'ecommerce' => 1800 ] ],
				],
			],

			'features' => [
				'label' => 'Features',
				'type'  => 'checkbox',
				'note'  => 'A contact form, basic analytics, and SSL are always included. Add what else you need.',
				'options' => [
					// Websites
					[ 'id' => 'gallery',        'label' => 'Gallery or project grid',           'desc' => 'Filterable grid with lightbox or case study pages.',          'price' => 350,  'for' => [ 'portfolio' ] ],
					[ 'id' => 'blog-module',    'label' => 'Blog or news',                      'desc' => 'Categories, author profiles, and an RSS feed.',               'price' => 400,  'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'booking',        'label' => 'Booking and scheduling',            'desc' => 'Availability, confirmations, reminders, calendar sync.',      'price' => 900,  'for' => [ 'business', 'portfolio' ] ],
					[ 'id' => 'newsletter',     'label' => 'Newsletter signup',                 'desc' => 'Connected to HubSpot, Mailchimp, or Brevo with a welcome flow.', 'price' => 300, 'for' => [ 'portfolio', 'business', 'ecommerce' ] ],
					[ 'id' => 'multilang',      'label' => 'Second language',                   'desc' => 'Translated pages with a language switcher.',                  'price' => 900,  'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'live-chat',      'label' => 'Live chat or WhatsApp button',      'desc' => 'Chat widget styled to the site, routed to your phone or inbox.', 'price' => 250, 'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'maps',           'label' => 'Locations and maps',                'desc' => 'Store or office finder with opening hours.',                  'price' => 300,  'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'client-area',    'label' => 'Client login area',                 'desc' => 'Protected pages, documents, and updates for your clients.',   'price' => 1500, 'for' => [ 'business' ] ],
					// Store
					[ 'id' => 'shipping',       'label' => 'Shipping rules and tax',            'desc' => 'Zones, carriers, free shipping thresholds, GST handling.',    'price' => 500,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'discounts',      'label' => 'Discount codes and gift cards',     'desc' => 'Promotions, automatic discounts, gift card balances.',        'price' => 400,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'accounts',       'label' => 'Customer accounts',                 'desc' => 'Order history, saved addresses, wishlists.',                  'price' => 600,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'reviews',        'label' => 'Product reviews',                   'desc' => 'Verified purchase reviews with moderation.',                  'price' => 300,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'inventory-sync', 'label' => 'Inventory sync',                    'desc' => 'Stock levels from your POS, supplier feed, or spreadsheet.',  'price' => 1500, 'for' => [ 'ecommerce' ] ],
					[ 'id' => 'subscriptions',  'label' => 'Subscriptions',                     'desc' => 'Recurring orders and member pricing.',                        'price' => 1200, 'for' => [ 'ecommerce' ] ],
					// Web app
					[ 'id' => 'auth-roles',     'label' => 'User accounts and roles',           'desc' => 'Sign up, login, password reset, permissions per role.',       'price' => 1500, 'for' => [ 'webapp' ] ],
					[ 'id' => 'payments',       'label' => 'Payments and invoicing',            'desc' => 'Stripe checkout, invoices, receipts, refunds.',               'price' => 2000, 'for' => [ 'webapp' ] ],
					[ 'id' => 'documents',      'label' => 'Document upload and management',    'desc' => 'Secure storage, versions, sharing with access control.',      'price' => 1500, 'for' => [ 'webapp' ] ],
					[ 'id' => 'notifications',  'label' => 'Notifications',                     'desc' => 'Email, SMS, and in-app alerts on the events that matter.',    'price' => 1200, 'for' => [ 'webapp' ] ],
					[ 'id' => 'reporting',      'label' => 'Reporting and exports',             'desc' => 'Tables, charts, filters, CSV and PDF export.',                'price' => 1800, 'for' => [ 'webapp' ] ],
					[ 'id' => 'api-int',        'label' => 'Third-party integration',           'desc' => 'Connect one external system such as Xero, HubSpot, or an ERP.', 'price' => 1500, 'for' => [ 'webapp' ] ],
					[ 'id' => 'search',         'label' => 'Search and filters',                'desc' => 'Fast search across records with saved filters.',              'price' => 900,  'for' => [ 'webapp' ] ],
					[ 'id' => 'audit',          'label' => 'Audit log',                         'desc' => 'Who changed what and when, exportable.',                      'price' => 900,  'for' => [ 'webapp' ] ],
					// Dashboards
					[ 'id' => 'db-connect',     'label' => 'Connect a database or warehouse',   'desc' => 'SQL Server, Postgres, MySQL, BigQuery, Snowflake.',           'price' => 800,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'sheet-connect',  'label' => 'Connect spreadsheets or CSV',        'desc' => 'Google Sheets, Excel, or exported files on a schedule.',      'price' => 300,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'saas-connect',   'label' => 'Accounting or CRM connector',       'desc' => 'Xero, MYOB, HubSpot, Salesforce, or similar.',                'price' => 1200, 'for' => [ 'dashboard' ] ],
					[ 'id' => 'refresh',        'label' => 'Scheduled refresh and alerts',      'desc' => 'Automatic updates with alerts when a number crosses a line.', 'price' => 900,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'rls',            'label' => 'Per-user data security',            'desc' => 'Each manager sees only their region, team, or clients.',       'price' => 1200, 'for' => [ 'dashboard' ] ],
					[ 'id' => 'embed',          'label' => 'Embedded in your site or portal',   'desc' => 'Reports inside the tools your people already use.',           'price' => 1500, 'for' => [ 'dashboard' ] ],
					[ 'id' => 'data-model',     'label' => 'Data cleaning and modelling layer', 'desc' => 'One trusted set of measures behind every report.',            'price' => 2500, 'for' => [ 'dashboard' ] ],
					// Automation
					[ 'id' => 'doc-parse',      'label' => 'Email and document parsing',        'desc' => 'Read invoices, forms, or PDFs into structured data.',         'price' => 1500, 'for' => [ 'automation' ] ],
					[ 'id' => 'two-way-sync',   'label' => 'Two-way sync between systems',      'desc' => 'Keep records matched in both directions with conflict rules.', 'price' => 1500, 'for' => [ 'automation' ] ],
					[ 'id' => 'approvals',      'label' => 'Approval workflow',                 'desc' => 'Requests, approvers, reminders, and an audit trail.',         'price' => 1200, 'for' => [ 'automation' ] ],
					[ 'id' => 'sched-reports',  'label' => 'Scheduled reports',                 'desc' => 'The right numbers in the right inbox every morning.',         'price' => 800,  'for' => [ 'automation' ] ],
					[ 'id' => 'monitoring',     'label' => 'Error alerts and monitoring',       'desc' => 'Know when a run fails before anyone else does.',              'price' => 600,  'for' => [ 'automation' ] ],
					[ 'id' => 'run-dashboard',  'label' => 'Dashboard of pipeline runs',        'desc' => 'Volumes, failures, and timings in one view.',                 'price' => 1200, 'for' => [ 'automation' ] ],
					// Enterprise
					[ 'id' => 'sso',            'label' => 'Single sign-on',                    'desc' => 'Microsoft Entra, Google Workspace, or Okta.',                  'price' => 3000, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'tenant-iso',     'label' => 'Tenant data isolation',             'desc' => 'Separate schemas or databases per customer.',                 'price' => 6000, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'billing',        'label' => 'Billing and subscriptions',         'desc' => 'Plans, usage metering, invoices, dunning.',                   'price' => 4000, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'erp-int',        'label' => 'ERP or CRM integration',            'desc' => 'One enterprise system connected with mapping and retries.',   'price' => 5000, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'compliance',     'label' => 'Audit logging and compliance reports', 'desc' => 'Immutable logs and the reports your auditors ask for.',   'price' => 3500, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'pwa',            'label' => 'Mobile ready app',                  'desc' => 'Installable progressive web app with offline support.',       'price' => 6000, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'warehouse',      'label' => 'Data warehouse and BI layer',       'desc' => 'Analytics store and governed reporting for the product.',     'price' => 8000, 'for' => [ 'enterprise' ] ],
				],
			],

			'seo' => [
				'label' => 'Search visibility',
				'type'  => 'radio',
				'options' => [
					[ 'id' => 'seo-basic',  'label' => 'Basics only',                      'desc' => 'Titles, descriptions, sitemap, and Search Console.',                'price' => 0 ],
					[ 'id' => 'seo-tech',   'label' => 'Technical SEO foundation',         'desc' => 'Schema, Core Web Vitals, internal linking, redirects.',              'price' => 450,  'prices' => [ 'portfolio' => 250 ] ],
					[ 'id' => 'seo-launch', 'label' => 'Launch package',                   'desc' => 'Keyword research, on-page optimisation, and a local listing setup.', 'price' => 1200, 'prices' => [ 'portfolio' => 600 ] ],
				],
			],

			'hosting' => [
				'label' => 'Hosting and deployment',
				'type'  => 'radio',
				'options' => [
					[ 'id' => 'host-yours',   'label' => 'You manage hosting',                 'desc' => 'We hand over the code and a deployment guide.',                 'price' => 0 ],
					[ 'id' => 'host-deploy',  'label' => 'We deploy to your hosting',          'desc' => 'Set up on your existing account, domain, and SSL.',             'price' => 300,  'for' => [ 'portfolio', 'business', 'ecommerce' ] ],
					[ 'id' => 'host-managed', 'label' => 'We set up managed hosting',          'desc' => 'A new fast host with backups, caching, and monitoring.',        'price' => 600,  'for' => [ 'portfolio', 'business', 'ecommerce' ] ],
					[ 'id' => 'host-cloud',   'label' => 'We set up cloud infrastructure',     'desc' => 'App hosting, database, backups, staging and production.',       'price' => 1500, 'for' => [ 'webapp', 'dashboard', 'automation' ] ],
					[ 'id' => 'host-iac',     'label' => 'Infrastructure as code',             'desc' => 'Repeatable environments, secrets management, monitoring.',      'price' => 4000, 'for' => [ 'enterprise' ] ],
				],
			],

			'support' => [
				'label' => 'After launch',
				'type'  => 'radio',
				'note'  => 'Every project includes 30 days of fixes after launch.',
				'options' => [
					[ 'id' => 'support-none',   'label' => 'Launch only',                     'desc' => 'The included 30 days of fixes, nothing ongoing.',          'price' => 0 ],
					[ 'id' => 'support-3',      'label' => '3 months of support',             'desc' => 'Updates, small changes, and priority replies.',            'price' => 450,  'prices' => [ 'portfolio' => 250, 'webapp' => 1500, 'enterprise' => 4500 ] ],
					[ 'id' => 'support-12',     'label' => '12 months of support',            'desc' => 'Monthly check-in, security updates, and a change budget.', 'price' => 1600, 'prices' => [ 'portfolio' => 900, 'webapp' => 5000, 'enterprise' => 15000 ] ],
				],
			],

		],
	];
}

/**
 * One AUD price shown in every currency the site quotes in, using the same
 * rates and rounding as the configurator.
 *
 * @param int $aud Price in Australian dollars.
 * @return array<string, string> Currency code to formatted price.
 */
function datalkemi_price_set( int $aud ): array {
	$out = [];
	foreach ( datalkemi_get_configurator_data()['currencies'] as $code => $c ) {
		$step  = max( 1, (int) $c['round'] );
		$value = (int) ( round( $aud * $c['rate'] / $step ) * $step );
		$out[ $code ] = $c['symbol'] . ( 'en-IN' === $c['locale'] ? datalkemi_format_inr( $value ) : number_format( $value ) );
	}
	return $out;
}

/**
 * Indian digit grouping: 1,00,000 rather than 100,000.
 */
function datalkemi_format_inr( int $value ): string {
	$digits = (string) $value;
	if ( strlen( $digits ) <= 3 ) {
		return $digits;
	}
	$last3 = substr( $digits, -3 );
	$rest  = substr( $digits, 0, -3 );
	return preg_replace( '/\B(?=(\d{2})+(?!\d))/', ',', $rest ) . ',' . $last3;
}

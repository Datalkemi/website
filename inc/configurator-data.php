<?php
/**
 * Datalkemi Project Configurator pricing data.
 *
 * All prices are in Australian dollars. The configurator shows them in AUD,
 * USD (indicative exchange rate), or INR (a reduced rate for clients in
 * India, below a straight conversion). Prices were set by Datalkemi in
 * November 2026, well below typical Australian agency rates.
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
			'label' => 'What do you need?',
			'note'  => 'Pick the closest match. The next questions change to suit it.',
			'options' => [
				[ 'id' => 'business',   'label' => 'Business website', 'desc' => 'A website that explains what you do and brings in enquiries.',                'price' => 500,  'steps' => [ 'scale', 'design', 'content', 'features', 'seo', 'hosting', 'support' ] ],
				[ 'id' => 'portfolio',  'label' => 'Personal website or portfolio',    'desc' => 'Show your work and how people can contact you.',                      'price' => 500, 'steps' => [ 'scale', 'design', 'content', 'features', 'seo', 'hosting', 'support' ] ],
				[ 'id' => 'ecommerce',  'label' => 'Online shop',                     'desc' => 'Sell products online and take payments.',                     'price' => 1000, 'steps' => [ 'scale', 'design', 'content', 'features', 'seo', 'hosting', 'support' ] ],
				[ 'id' => 'webapp',     'label' => 'Online system or customer portal', 'desc' => 'A private area where your team or customers log in to get things done, such as bookings or job tracking.',            'price' => 800, 'steps' => [ 'scale', 'design', 'features', 'hosting', 'support' ] ],
				[ 'id' => 'dashboard',  'label' => 'Business reports and dashboards',         'desc' => 'See your sales, costs and other numbers on one clear screen, updated automatically.',     'price' => 600, 'steps' => [ 'scale', 'features', 'hosting', 'support' ] ],
				[ 'id' => 'automation', 'label' => 'Automate repetitive tasks',        'desc' => 'Stop copying information between programs by hand. We connect them so the work happens on its own.',   'price' => 1000, 'steps' => [ 'scale', 'features', 'hosting', 'support' ] ],
				[ 'id' => 'enterprise', 'label' => 'Large or complex platform',              'desc' => 'For larger organisations with many users and strict security needs. We price it with you on a call.', 'price' => 0, 'quote' => true, 'steps' => [] ],
			],
		],

		'sections' => [

			'scale' => [
				'label' => 'How big is it?',
				'type'  => 'radio',
				'note'  => 'Pick the smallest option that fits. You can always add more later.',
				'options' => [
					[ 'id' => 'one-page',        'label' => 'One page',                         'desc' => 'Everything on a single page that visitors scroll down.',                    'price' => 0,     'for' => [ 'portfolio' ] ],
					[ 'id' => 'five-pages',      'label' => 'Up to 5 pages',                    'desc' => 'For example: home, about, your work, services and contact.',           'price' => 100,   'for' => [ 'portfolio' ] ],
					[ 'id' => 'blog',            'label' => 'Up to 5 pages plus a blog', 'desc' => 'Add articles or project write-ups whenever you like.',                     'price' => 250,   'for' => [ 'portfolio' ] ],

					[ 'id' => 'b-five',          'label' => 'Up to 5 pages',                    'desc' => 'Good for one service or one location.',               'price' => 0,     'for' => [ 'business' ] ],
					[ 'id' => 'b-ten',           'label' => '6 to 10 pages',                    'desc' => 'Room for several services, your team, past work or a blog.',               'price' => 200,   'for' => [ 'business' ] ],
					[ 'id' => 'b-twenty',        'label' => '11 to 20 pages',                   'desc' => 'For several locations or a wide range of services.',   'price' => 500,  'for' => [ 'business' ] ],

					[ 'id' => 'e-small',         'label' => 'Up to 25 products',                'desc' => 'A small range of products.',                        'price' => 0,     'for' => [ 'ecommerce' ] ],
					[ 'id' => 'e-medium',        'label' => 'Up to 250 products',               'desc' => 'Products in categories, with options such as size or colour.',                'price' => 300,   'for' => [ 'ecommerce' ] ],
					[ 'id' => 'e-large',         'label' => 'More than 250 products',                  'desc' => 'A large range, with bulk uploads and trade prices.',         'price' => 1000,  'for' => [ 'ecommerce' ] ],

					[ 'id' => 'w-single',        'label' => 'One main task',                'desc' => 'Does one job well for one kind of user, such as taking job requests.',             'price' => 0,     'for' => [ 'webapp' ] ],
					[ 'id' => 'w-modules',       'label' => 'Several tasks and types of user',   'desc' => 'Separate screens for you, your staff and your customers.',           'price' => 1500,  'for' => [ 'webapp' ] ],
					[ 'id' => 'w-tenant',        'label' => 'A system you sell to other businesses',  'desc' => 'Each business that signs up gets its own private space and users.',   'price' => 5000, 'for' => [ 'webapp' ] ],

					[ 'id' => 'd-one',           'label' => 'One dashboard',                    'desc' => 'One screen that answers one set of questions.',             'price' => 0,     'for' => [ 'dashboard' ] ],
					[ 'id' => 'd-few',           'label' => '2 to 4 dashboards',           'desc' => 'For example, separate screens for sales, operations and finance.',   'price' => 800,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'd-suite',         'label' => 'A full set of reports', 'desc' => 'Many reports that all use the same trusted numbers.',           'price' => 2500,  'for' => [ 'dashboard' ] ],

					[ 'id' => 'a-one',           'label' => 'Connect 2 programs',      'desc' => 'Or automate one routine task.',               'price' => 0,     'for' => [ 'automation' ] ],
					[ 'id' => 'a-few',           'label' => 'Connect up to 4 programs',    'desc' => 'Several automated tasks working together.',              'price' => 800,  'for' => [ 'automation' ] ],
					[ 'id' => 'a-pipeline',      'label' => 'Regular data processing',    'desc' => 'Information collected, cleaned and moved on a schedule, with checks that it worked.',     'price' => 2000,  'for' => [ 'automation' ] ],

					[ 'id' => 'x-core',          'label' => 'Core platform',                    'desc' => 'The product, its users, roles, and admin.',                 'price' => 0,     'for' => [ 'enterprise' ] ],
					[ 'id' => 'x-regulated',     'label' => 'Core platform with compliance',    'desc' => 'Audit trails, data residency, retention, access reviews.',  'price' => 15000, 'for' => [ 'enterprise' ] ],
					[ 'id' => 'x-multi-region',  'label' => 'Multi-region, high availability',  'desc' => 'Redundant infrastructure and formal recovery targets.',     'price' => 30000, 'for' => [ 'enterprise' ] ],
				],
			],

			'design' => [
				'label' => 'How should it look?',
				'type'  => 'radio',
				'note'  => 'With a custom design, you see and approve it before we build anything.',
				'options' => [
					[ 'id' => 'template',   'label' => 'Ready-made design',               'desc' => 'A proven layout in your colours and fonts. The quickest and most affordable option.',        'price' => 0 ],
					[ 'id' => 'custom',     'label' => 'Custom design',                'desc' => 'Designed from scratch around your business and your customers.',        'price' => 400, 'prices' => [ 'portfolio' => 150, 'business' => 300, 'enterprise' => 6000 ] ],
					[ 'id' => 'brand',      'label' => 'Custom design plus branding', 'desc' => 'As above, plus a refreshed logo, colours and fonts you can use everywhere.', 'price' => 900, 'prices' => [ 'portfolio' => 400, 'business' => 700, 'enterprise' => 12000 ] ],
				],
			],

			'content' => [
				'label' => 'Who will write the words?',
				'note'  => 'The text and photos that go on your pages.',
				'type'  => 'radio',
				'options' => [
					[ 'id' => 'content-yours',  'label' => 'I will provide everything',           'desc' => 'You send the text and photos, and we put them in place.',            'price' => 0 ],
					[ 'id' => 'content-edit',   'label' => 'I will write it, you polish it', 'desc' => 'You send rough drafts, and we make them clear and easy to read.',           'price' => 150,  'prices' => [ 'portfolio' => 80 ] ],
					[ 'id' => 'content-write',  'label' => 'Please write it for me',               'desc' => 'We talk to you, write the text, and revise it twice.',           'price' => 400, 'prices' => [ 'portfolio' => 200, 'ecommerce' => 600 ] ],
				],
			],

			'features' => [
				'label' => 'What else do you need?',
				'type'  => 'checkbox',
				'note'  => 'A contact form, visitor statistics and a secure connection are always included. Tick anything else you would like.',
				'options' => [
					// Websites
					[ 'id' => 'gallery',        'label' => 'Photo gallery',           'desc' => 'Show your work in a grid of photos or projects.',          'price' => 120,  'for' => [ 'portfolio' ] ],
					[ 'id' => 'blog-module',    'label' => 'Blog or news page',                      'desc' => 'Post articles and updates yourself.',               'price' => 130,  'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'booking',        'label' => 'Online bookings',            'desc' => 'Customers pick a time and get a confirmation and a reminder.',      'price' => 300,  'for' => [ 'business', 'portfolio' ] ],
					[ 'id' => 'newsletter',     'label' => 'Email newsletter signup',                 'desc' => 'Collect email addresses for your mailing list.', 'price' => 100, 'for' => [ 'portfolio', 'business', 'ecommerce' ] ],
					[ 'id' => 'multilang',      'label' => 'Second language',                   'desc' => 'Your pages in another language, with a button to switch between them.',                  'price' => 300,  'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'live-chat',      'label' => 'Chat or WhatsApp button',      'desc' => 'Visitors can message you straight from the website.', 'price' => 80, 'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'maps',           'label' => 'Map and opening hours',                'desc' => 'Show where you are and when you are open.',                  'price' => 100,  'for' => [ 'business', 'ecommerce' ] ],
					[ 'id' => 'client-area',    'label' => 'Private client area',                 'desc' => 'Clients log in to see documents and updates meant only for them.',   'price' => 500, 'for' => [ 'business' ] ],
					// Store
					[ 'id' => 'shipping',       'label' => 'Delivery and GST',            'desc' => 'Delivery charges by area, free delivery over a set amount, and GST worked out for you.',    'price' => 170,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'discounts',      'label' => 'Discount codes and gift cards',     'desc' => 'Run sales and promotions.',        'price' => 130,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'accounts',       'label' => 'Customer accounts',                 'desc' => 'Customers can see past orders and save their details.',                  'price' => 200,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'reviews',        'label' => 'Product reviews',                   'desc' => 'Buyers can rate and review products.',                  'price' => 100,  'for' => [ 'ecommerce' ] ],
					[ 'id' => 'inventory-sync', 'label' => 'Automatic stock levels',                    'desc' => 'Stock updates from your shop till, supplier or spreadsheet.',  'price' => 500, 'for' => [ 'ecommerce' ] ],
					[ 'id' => 'subscriptions',  'label' => 'Subscriptions',                     'desc' => 'Repeat orders or memberships charged automatically.',                        'price' => 400, 'for' => [ 'ecommerce' ] ],
					// Web app
					[ 'id' => 'auth-roles',     'label' => 'User logins',           'desc' => 'People sign up and log in, and each person only sees what they are allowed to.',       'price' => 500, 'for' => [ 'webapp' ] ],
					[ 'id' => 'payments',       'label' => 'Payments and invoices',            'desc' => 'Card payments, invoices, receipts and refunds.',               'price' => 700, 'for' => [ 'webapp' ] ],
					[ 'id' => 'documents',      'label' => 'File uploads',    'desc' => 'Upload and share documents securely.',      'price' => 500, 'for' => [ 'webapp' ] ],
					[ 'id' => 'notifications',  'label' => 'Automatic notifications',                     'desc' => 'Email or text messages when something important happens.',    'price' => 400, 'for' => [ 'webapp' ] ],
					[ 'id' => 'reporting',      'label' => 'Reports and downloads',             'desc' => 'Charts and tables you can download as a spreadsheet or PDF.',                'price' => 600, 'for' => [ 'webapp' ] ],
					[ 'id' => 'api-int',        'label' => 'Connect to another program',           'desc' => 'For example Xero, HubSpot or your accounting software.', 'price' => 500, 'for' => [ 'webapp' ] ],
					[ 'id' => 'search',         'label' => 'Search',                'desc' => 'Find any record quickly.',              'price' => 300,  'for' => [ 'webapp' ] ],
					[ 'id' => 'audit',          'label' => 'Change history',                         'desc' => 'See who changed what, and when.',                      'price' => 300,  'for' => [ 'webapp' ] ],
					// Dashboards
					[ 'id' => 'db-connect',     'label' => 'Connect your business system',   'desc' => 'We pull the numbers from the software your business already runs on.',           'price' => 270,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'sheet-connect',  'label' => 'Use your spreadsheets',        'desc' => 'Google Sheets or Excel files, kept up to date automatically.',      'price' => 100,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'saas-connect',   'label' => 'Connect accounting or sales software',       'desc' => 'For example Xero, MYOB, HubSpot or Salesforce.',                'price' => 400, 'for' => [ 'dashboard' ] ],
					[ 'id' => 'refresh',        'label' => 'Automatic updates and alerts',      'desc' => 'Numbers update on their own, and you get an alert when something needs attention.', 'price' => 300,  'for' => [ 'dashboard' ] ],
					[ 'id' => 'rls',            'label' => 'Each person sees their own numbers',            'desc' => 'For example, each manager sees only their own team or region.',       'price' => 400, 'for' => [ 'dashboard' ] ],
					[ 'id' => 'embed',          'label' => 'Reports inside your website or portal',   'desc' => 'People see the reports in the tools they already use.',           'price' => 500, 'for' => [ 'dashboard' ] ],
					[ 'id' => 'data-model',     'label' => 'Clean up your data', 'desc' => 'We tidy messy data so every report shows the same correct numbers.',            'price' => 850, 'for' => [ 'dashboard' ] ],
					// Automation
					[ 'id' => 'doc-parse',      'label' => 'Read emails and documents for you',        'desc' => 'Details from invoices, forms or PDFs entered automatically.',         'price' => 500, 'for' => [ 'automation' ] ],
					[ 'id' => 'two-way-sync',   'label' => 'Keep two programs in step',      'desc' => 'A change in one updates the other automatically.', 'price' => 500, 'for' => [ 'automation' ] ],
					[ 'id' => 'approvals',      'label' => 'Approval steps',                 'desc' => 'Requests go to the right person to approve, with reminders.',         'price' => 400, 'for' => [ 'automation' ] ],
					[ 'id' => 'sched-reports',  'label' => 'Reports by email',                 'desc' => 'The numbers you need, in your inbox every morning.',         'price' => 270,  'for' => [ 'automation' ] ],
					[ 'id' => 'monitoring',     'label' => 'Problem alerts',       'desc' => 'You hear straight away if something stops working.',              'price' => 200,  'for' => [ 'automation' ] ],
					[ 'id' => 'run-dashboard',  'label' => 'Activity overview',        'desc' => 'One screen showing what ran, how much was done, and any problems.',                 'price' => 400, 'for' => [ 'automation' ] ],
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
				'label' => 'Showing up on Google',
				'note'  => 'How much help you want getting found on Google.',
				'type'  => 'radio',
				'options' => [
					[ 'id' => 'seo-basic',  'label' => 'The essentials',                      'desc' => 'Page titles, descriptions, and registering your site with Google.',                'price' => 0 ],
					[ 'id' => 'seo-tech',   'label' => 'Better Google setup',         'desc' => 'Faster pages and a clearer page structure that help Google understand your site.',              'price' => 150,  'prices' => [ 'portfolio' => 80 ] ],
					[ 'id' => 'seo-launch', 'label' => 'Full Google launch',                   'desc' => 'We find what your customers search for, tune your pages, and set up your Google Business Profile.', 'price' => 400, 'prices' => [ 'portfolio' => 200 ] ],
				],
			],

			'hosting' => [
				'label' => 'Where will it live?',
				'note'  => 'Hosting is the service that keeps your website online.',
				'type'  => 'radio',
				'options' => [
					[ 'id' => 'host-yours',   'label' => 'I will handle it',                 'desc' => 'We give you the website files and step by step instructions.',                 'price' => 0 ],
					[ 'id' => 'host-deploy',  'label' => 'Use my existing hosting',          'desc' => 'We put the site live on the hosting and web address you already have.',             'price' => 100,  'for' => [ 'portfolio', 'business', 'ecommerce' ] ],
					[ 'id' => 'host-managed', 'label' => 'Set up new hosting for me',          'desc' => 'Fast hosting with backups and monitoring, set up in your name.',        'price' => 200,  'for' => [ 'portfolio', 'business', 'ecommerce' ] ],
					[ 'id' => 'host-cloud',   'label' => 'Set up the servers for me',     'desc' => 'We set up and secure the online servers your system runs on, with backups.',       'price' => 500, 'for' => [ 'webapp', 'dashboard', 'automation' ] ],
					[ 'id' => 'host-iac',     'label' => 'Infrastructure as code',             'desc' => 'Repeatable environments, secrets management, monitoring.',      'price' => 4000, 'for' => [ 'enterprise' ] ],
				],
			],

			'support' => [
				'label' => 'Help after launch',
				'type'  => 'radio',
				'note'  => 'Every project includes 30 days of fixes after it goes live.',
				'options' => [
					[ 'id' => 'support-none',   'label' => 'Just the launch',                     'desc' => 'The included 30 days of fixes, nothing ongoing.',          'price' => 0 ],
					[ 'id' => 'support-3',      'label' => '3 months of help',             'desc' => 'Updates, small changes and quick replies when you need us.',            'price' => 150,  'prices' => [ 'portfolio' => 80, 'webapp' => 500, 'enterprise' => 4500 ] ],
					[ 'id' => 'support-12',     'label' => '12 months of help',            'desc' => 'A monthly check-in, security updates and time set aside for changes.', 'price' => 550, 'prices' => [ 'portfolio' => 300, 'webapp' => 1700, 'enterprise' => 15000 ] ],
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

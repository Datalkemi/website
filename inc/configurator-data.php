<?php
/**
 * Datalkemi — Project Configurator pricing data.
 * Each option carries a price (GBP). JS reads this as inline JSON.
 */

defined( 'ABSPATH' ) || exit;

function datalkemi_get_configurator_data(): array {
	return [

		'project_type' => [
			'label' => 'What are you building?',
			'type'  => 'radio',
			'note'  => 'This sets the project baseline. All other selections are added on top.',
			'options' => [
				[ 'id' => 'marketing-website', 'label' => 'Marketing Website',       'desc' => 'Company site, landing pages, or a multi-page brand presence.',           'price' => 800  ],
				[ 'id' => 'web-application',   'label' => 'Web Application',          'desc' => 'Custom functionality, dashboards, internal tools, or client portals.',    'price' => 2500 ],
				[ 'id' => 'ecommerce',         'label' => 'E-Commerce Store',         'desc' => 'Product catalogue, cart, checkout, and order management.',                'price' => 1500 ],
				[ 'id' => 'data-dashboard',    'label' => 'Data Dashboard / BI',      'desc' => 'Operational or executive dashboards connected to your data sources.',     'price' => 1200 ],
				[ 'id' => 'saas-platform',     'label' => 'SaaS / Client Portal',     'desc' => 'Multi-tenant platform with user management, billing, and role access.',   'price' => 3500 ],
			],
		],

		'design' => [
			'label' => 'Design approach',
			'type'  => 'radio',
			'note'  => 'All custom designs are produced in Figma and approved before development begins.',
			'options' => [
				[ 'id' => 'template',       'label' => 'Template-based',           'desc' => 'We select and adapt a premium theme to match your brand.',           'price' => 0    ],
				[ 'id' => 'custom',         'label' => 'Custom UI Design',         'desc' => 'Fully bespoke wireframes and high-fidelity Figma mockups.',           'price' => 900  ],
				[ 'id' => 'premium-custom', 'label' => 'Premium Custom + Branding','desc' => 'Custom design plus a full brand system: typography, palette, assets.', 'price' => 2200 ],
			],
		],

		'pages' => [
			'label' => 'How many pages or screens?',
			'type'  => 'radio',
			'options' => [
				[ 'id' => 'pages-1-5',  'label' => '1 to 5',   'desc' => 'Focused, high-impact site.',          'price' => 0   ],
				[ 'id' => 'pages-6-15', 'label' => '6 to 15',  'desc' => 'Standard multi-section website.',     'price' => 350 ],
				[ 'id' => 'pages-16p',  'label' => '16 or more','desc' => 'Large site or complex application.',  'price' => 750 ],
			],
		],

		'features' => [
			'label' => 'Features and functionality',
			'type'  => 'checkbox',
			'note'  => 'Select everything your project needs. Prices shown are per feature.',
			'options' => [
				[ 'id' => 'user-auth',       'label' => 'User accounts and login',          'desc' => 'Registration, login, password reset, session management.',            'price' => 450  ],
				[ 'id' => 'payments',        'label' => 'Payment processing',               'desc' => 'Stripe or PayPal integration with checkout and invoicing.',            'price' => 650  ],
				[ 'id' => 'cms',             'label' => 'Content management system',        'desc' => 'WordPress CMS or headless CMS so your team can edit content.',         'price' => 200  ],
				[ 'id' => 'search',          'label' => 'Advanced search',                  'desc' => 'Full-text search with filters, faceted navigation, or Algolia.',       'price' => 350  ],
				[ 'id' => 'booking',         'label' => 'Booking and scheduling',           'desc' => 'Appointment calendar, availability management, confirmations.',        'price' => 750  ],
				[ 'id' => 'multilang',       'label' => 'Multi-language support',           'desc' => 'Translated content with language switcher and locale routing.',        'price' => 500  ],
				[ 'id' => 'email-marketing', 'label' => 'Email marketing integration',      'desc' => 'Mailchimp, Klaviyo, or ActiveCampaign list sync and automations.',     'price' => 220  ],
				[ 'id' => 'crm',             'label' => 'CRM integration',                  'desc' => 'Salesforce, HubSpot, or Pipedrive two-way data sync.',                 'price' => 450  ],
				[ 'id' => 'api',             'label' => 'Third-party API integration',      'desc' => 'Connect to external services (ERP, logistics, data sources, etc.).',  'price' => 400  ],
				[ 'id' => 'notifications',   'label' => 'Real-time notifications',          'desc' => 'In-app alerts, email triggers, and webhook event handling.',           'price' => 380  ],
				[ 'id' => 'documents',       'label' => 'Document management',              'desc' => 'Upload, store, version, and share files with access controls.',        'price' => 420  ],
				[ 'id' => 'reporting',       'label' => 'Built-in reporting module',        'desc' => 'On-platform reports, tables, and data exports for your users.',        'price' => 550  ],
				[ 'id' => 'live-chat',       'label' => 'Live chat integration',            'desc' => 'Intercom, Crisp, or Tidio chat widget configured and styled.',         'price' => 150  ],
				[ 'id' => 'maps',            'label' => 'Maps and geolocation',             'desc' => 'Google Maps API, location search, or route visualisation.',            'price' => 280  ],
			],
		],

		'data_analytics' => [
			'label' => 'Data and analytics',
			'type'  => 'checkbox',
			'options' => [
				[ 'id' => 'ga4',           'label' => 'GA4 setup and configuration',         'desc' => 'GA4 property, data streams, goals, and consent mode.',             'price' => 180  ],
				[ 'id' => 'event-tracking', 'label' => 'Custom event tracking',              'desc' => 'GTM container, custom events, conversion tracking, and testing.',   'price' => 290  ],
				[ 'id' => 'looker',        'label' => 'Looker Studio reporting dashboard',   'desc' => 'Connected Google Data Studio dashboard for marketing KPIs.',        'price' => 650  ],
				[ 'id' => 'etl',           'label' => 'Data pipeline (ETL)',                 'desc' => 'Automated data extraction, transformation, and loading setup.',     'price' => 900  ],
				[ 'id' => 'bi-reports',    'label' => 'Power BI or Tableau reports',         'desc' => 'Up to 3 interactive reports connected to your project data.',       'price' => 1400 ],
			],
		],

		'seo' => [
			'label' => 'SEO',
			'type'  => 'radio',
			'options' => [
				[ 'id' => 'seo-none',      'label' => 'No SEO work',                   'desc' => 'Basic meta tags only.',                                              'price' => 0   ],
				[ 'id' => 'seo-tech',      'label' => 'Technical SEO foundation',      'desc' => 'Schema markup, sitemap, robots.txt, Core Web Vitals, and GSC setup.', 'price' => 350 ],
				[ 'id' => 'seo-launch',    'label' => 'Full SEO launch package',       'desc' => 'Keyword research, on-page optimisation, GSC, GA4, and authority audit.','price' => 900 ],
			],
		],

		'infrastructure' => [
			'label' => 'Hosting and infrastructure',
			'type'  => 'radio',
			'options' => [
				[ 'id' => 'infra-none',    'label' => 'Client manages own hosting',        'desc' => 'We hand over code. You manage deployment.',                   'price' => 0   ],
				[ 'id' => 'infra-deploy',  'label' => 'Deployment and configuration',      'desc' => 'We deploy to your existing hosting and configure the server.',  'price' => 250 ],
				[ 'id' => 'infra-managed', 'label' => 'Managed hosting setup',             'desc' => 'We set up, configure, and optimise a new hosting environment.', 'price' => 450 ],
			],
		],

		'support' => [
			'label' => 'Post-launch support',
			'type'  => 'radio',
			'options' => [
				[ 'id' => 'support-none',    'label' => 'No ongoing support',           'desc' => 'Delivery only. No post-launch cover.',                            'price' => 0    ],
				[ 'id' => 'support-3mo',     'label' => '3-month support package',      'desc' => 'Bug fixes, minor updates, and technical support for 3 months.',   'price' => 350  ],
				[ 'id' => 'support-6mo',     'label' => '6-month support package',      'desc' => 'Extended support with monthly check-ins and priority response.',   'price' => 650  ],
				[ 'id' => 'support-annual',  'label' => 'Annual maintenance contract',  'desc' => 'Full year: updates, security, performance, and dedicated support.', 'price' => 1200 ],
			],
		],

	];
}

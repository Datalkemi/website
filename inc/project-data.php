<?php
/**
 * Project content seeded into the Projects CPT by inc/project-seed.php.
 *
 * Each entry becomes one published project. Dates are the delivery month and
 * double as the post date, so the archive lists newest work first. Thumbnails
 * are read from assets/img/projects/{slug}.jpg when that file exists.
 *
 * This file is the source of truth. Raise DATALKEMI_PROJECTS_VERSION after
 * editing it and the seeder re-applies every entry on the next page load,
 * overwriting edits made in WP Admin.
 *
 * @package Datalkemi
 * @since   2.1.0
 */

defined( 'ABSPATH' ) || exit;

define( 'DATALKEMI_PROJECTS_VERSION', 2 );

return [

	[
		'slug'     => 'ozviz-migration-website',
		'title'    => 'OzViz Migration website and news platform',
		'excerpt'  => 'A marketing site, consultation booking flow, and self-managed news and reviews platform for a registered Australian migration agency.',
		'category' => 'Website and content platform',
		'industry' => 'Professional services',
		'type'     => 'Web application',
		'tech'     => 'React, Vite, Tailwind CSS, Netlify Functions, Netlify Blobs',
		'live_url' => 'https://www.ozvizmigration.com/',
		'hosting'  => 'Netlify, custom domain, serverless functions and blob storage',
		'end'      => '2026-08-01',
		'content'  => '
<h2>The brief</h2>
<p>OzViz Migration is a registered migration agency helping people move to Australia. The agency needed a site that explains each visa pathway in plain language, makes it easy to book a consultation, and lets the team publish news and client reviews themselves without a developer in the loop.</p>
<h2>What we built</h2>
<ul>
<li>A visa guide with a dedicated page for each pathway, from student and visitor visas through partner visas to citizenship, with the agency registration details shown throughout.</li>
<li>A consultation booking flow with date selection, plus a WhatsApp channel for quick questions.</li>
<li>A password-protected admin area, served by serverless functions, where the team writes news posts, uploads images, and moderates reviews. Content and images live in Netlify Blobs, so there is no database to maintain.</li>
<li>Legal pages, a sitemap, and social sharing images so each visa page is indexable on its own.</li>
</ul>
<h2>Outcome</h2>
<p>The agency runs its own news feed and testimonials, visa pages rank individually in search, and hosting costs stay close to zero because the whole platform is static files plus a handful of functions.</p>
',
	],

	[
		'slug'     => 'cp-study-centre-website',
		'title'    => 'CP Study Centre website',
		'excerpt'  => 'A course catalogue and enquiry site for an education provider offering school tuition, language test preparation, and career skills courses.',
		'category' => 'Website',
		'industry' => 'Education',
		'type'     => 'Website',
		'tech'     => 'React, Vite, Tailwind CSS, Framer Motion, Netlify Forms',
		'live_url' => 'https://cp-study-centre.netlify.app/',
		'hosting'  => 'Netlify, static site with hosted forms',
		'end'      => '2025-08-01',
		'content'  => '
<h2>The brief</h2>
<p>CP Study Centre runs tuition for school students across several curricula, preparation for IELTS, PTE, OET and German language exams, and short courses in data analytics, data science, Python, and communication. The centre needed one site that presents all of it clearly to parents, students, and working professionals, and converts interest into enquiries.</p>
<h2>What we built</h2>
<ul>
<li>A structured course catalogue: school tuition by board and language, language preparation by exam, and skill courses by career outcome, each with what is covered and how classes run.</li>
<li>Pages for learning formats, daily learning resources, and webinars, so the centre can promote events without rebuilding the site.</li>
<li>Enquiry forms handled by the hosting platform, with a WhatsApp shortcut for families who prefer to message.</li>
<li>Motion and layout tuned for phones first, since most visitors arrive from social links on mobile.</li>
</ul>
<h2>Outcome</h2>
<p>A fast, static site with no server to maintain, where every course has its own page and every page ends in a clear next step.</p>
',
	],

	[
		'slug'     => 'krz-engineering-website',
		'title'    => 'KRZ Engineering website',
		'excerpt'  => 'A search-ready services site for a Perth precision engineering workshop offering CNC machining, laser cutting, CAD design, and 3D printing.',
		'category' => 'Website',
		'industry' => 'Engineering',
		'type'     => 'Website',
		'tech'     => 'React, Vite, Tailwind CSS, Framer Motion, Formspree',
		'live_url' => 'https://krzengineering.com.au/',
		'hosting'  => 'Netlify, custom domain',
		'end'      => '2025-06-01',
		'content'  => '
<h2>The brief</h2>
<p>KRZ Engineering provides precision manufacturing to businesses across Perth: CNC machining, laser cutting, CAD design, and 3D printing. The workshop needed a site that explains each service to trade and commercial buyers, shows finished work, and ranks for the service terms people actually search for.</p>
<h2>What we built</h2>
<ul>
<li>A dedicated page for each service with capabilities, materials, and typical applications, and an overview page that routes visitors to the right one.</li>
<li>A portfolio of completed jobs and an about page covering the workshop and its equipment.</li>
<li>A quote request form delivered straight to the sales inbox, with a direct email fallback.</li>
<li>Technical SEO from the start: a generated sitemap, canonical URLs, Open Graph images, and page-level metadata.</li>
</ul>
<h2>Outcome</h2>
<p>Each service is indexed on its own page, the site loads quickly on mobile, and every enquiry lands in one place. Copy and portfolio updates ship through a normal deploy from the repository.</p>
',
	],

	[
		'slug'     => 'perth-auto-finds-booking-platform',
		'title'    => 'Perth Auto Finds dealership site with online bookings',
		'excerpt'  => 'A dealership website with online service and tyre bookings, backed by an admin dashboard for managing availability and appointments.',
		'category' => 'Web application',
		'industry' => 'Automotive',
		'type'     => 'Web application',
		'tech'     => 'React, Vite, Tailwind CSS, Supabase',
		'live_url' => 'https://used-cars-website.netlify.app/',
		'hosting'  => 'Netlify front end, Supabase database and authentication',
		'end'      => '2025-06-01',
		'content'  => '
<h2>The brief</h2>
<p>Perth Auto Finds sells quality second-hand cars and offers servicing, tyre changes, rentals, and in-house insurance. Bookings were being taken by phone and written down, which meant double bookings and missed follow-ups. The business wanted customers to book online against real availability.</p>
<h2>What we built</h2>
<ul>
<li>Public pages for the car range, servicing, tyre services, rentals, insurance, and contact.</li>
<li>An online booking flow for servicing and tyre work that only offers slots the workshop has opened, with bookings stored in a Postgres database on Supabase.</li>
<li>A protected admin login and dashboard where staff set availability, review upcoming bookings, and update their status.</li>
<li>Row-level security on the database, so the public site can create bookings but only authenticated staff can read or change them.</li>
</ul>
<h2>Outcome</h2>
<p>Bookings arrive with the right details attached, availability is controlled by the workshop rather than the phone, and staff work from one dashboard instead of a notebook.</p>
',
	],

	[
		'slug'     => 'eula-generator',
		'title'    => 'EULA generator',
		'excerpt'  => 'A browser tool that drafts End User License Agreements from editable templates and exports a finished PDF.',
		'category' => 'Web tool',
		'industry' => 'Legal and compliance',
		'type'     => 'Web application',
		'tech'     => 'React, TypeScript, Vite, shadcn/ui, Tailwind CSS',
		'live_url' => '',
		'hosting'  => 'Not publicly hosted, runs entirely in the browser',
		'end'      => '2025-08-01',
		'content'  => '
<h2>The brief</h2>
<p>Small software vendors need a licence agreement before they can ship, and most either copy one from a competitor or pay for a template they then cannot edit cleanly. The goal was a tool that produces a sensible first draft in minutes and keeps the text editable.</p>
<h2>What we built</h2>
<ul>
<li>A guided form that captures the product, the licensor, territory, term, and the permissions and restrictions that apply.</li>
<li>Clause templates assembled into a full agreement, with every section editable in place before export.</li>
<li>One-click PDF export of the finished document, generated in the browser with nothing sent to a server.</li>
</ul>
<h2>Outcome</h2>
<p>A single-page application with no backend, no accounts, and no stored data, which keeps it simple to host and easy to trust with draft legal text.</p>
',
	],

	[
		'slug'     => 'household-finance-app',
		'title'    => 'Exnami, household finance app',
		'excerpt'  => 'An installable web app for tracking income, expenses, budgets, debts, and shared costs, with receipt scanning, reminders, and multi-currency support.',
		'category' => 'Product',
		'industry' => 'Finance',
		'type'     => 'Web application',
		'tech'     => 'Next.js, React, Supabase, PostgreSQL, Web Push, Vercel',
		'live_url' => 'https://www.exnami.com/',
		'hosting'  => 'Vercel, Sydney region, Supabase database',
		'end'      => '2026-08-01',
		'content'  => '
<h2>The brief</h2>
<p>Exnami is our own product. Most budgeting apps either lock data behind a subscription or stop at a list of transactions, so Exnami set out to cover the whole household picture: accounts, bills, debts, money owed between friends, and a forward plan, in an app that installs on a phone and works offline-first.</p>
<h2>What we built</h2>
<ul>
<li>Accounts, income, expenses, and transfers with categories, merchants, and budgets with per-category limits.</li>
<li>Debts and repayments, receivables, and shared expenses between friends with settlement tracking.</li>
<li>A payment calendar with Google Calendar sync and push notifications before due dates.</li>
<li>Receipt scanning that files line items against the right expense, and monthly plans that project income, bills, debt payoff, and savings.</li>
<li>Multi-currency support with live exchange rates, Google sign-in, and a progressive web app shell deployed to Sydney for low latency.</li>
</ul>
<h2>Outcome</h2>
<p>A production application on a relational schema of more than forty tables, with row-level security on every one of them, serving as the reference build for the data-backed products we deliver for clients.</p>
',
	],

	[
		'slug'     => 'question-answering-model',
		'title'    => 'Question answering with attention',
		'excerpt'  => 'A research project training sequence models with attention to pick the sentence that answers a question from a set of candidates.',
		'category' => 'Research',
		'industry' => 'Research',
		'type'     => 'Data science',
		'tech'     => 'Python, PyTorch, Jupyter',
		'live_url' => '',
		'hosting'  => 'Not hosted, notebooks and trained models',
		'end'      => '2023-12-01',
		'content'  => '
<h2>The problem</h2>
<p>Given a question and a list of candidate sentences, decide which sentence actually answers it. This is the core of document search, support bots, and internal knowledge tools, and it is harder than keyword matching because the answer rarely repeats the words in the question.</p>
<h2>What we built</h2>
<ul>
<li>A labelled dataset of questions, candidate answers, and relevance labels, cleaned and tokenised for training.</li>
<li>Two PyTorch models: one that attends over the document to score each candidate, and one that summarises the question before matching.</li>
<li>An evaluation harness comparing the two against a baseline on held-out questions.</li>
</ul>
<h2>Why it matters</h2>
<p>The same approach underpins the document intelligence work we do for clients: extracting the one line that matters from a contract, invoice, or report.</p>
',
	],

	[
		'slug'     => 'peak-energy-demand-prediction',
		'title'    => 'Peak energy demand prediction',
		'excerpt'  => 'A research project predicting daily peak electricity demand on the South West Interconnected System from half-hourly interval and weather data.',
		'category' => 'Research',
		'industry' => 'Energy',
		'type'     => 'Data science',
		'tech'     => 'Python, pandas, XGBoost, Jupyter',
		'live_url' => '',
		'hosting'  => 'Not hosted, notebooks and a dashboard prototype',
		'end'      => '2022-10-01',
		'content'  => '
<h2>The problem</h2>
<p>Large electricity users on the South West Interconnected System pay network charges based on their draw during the four highest demand intervals of the hot season. Knowing in advance whether today is likely to be one of those days lets a site shed load at the right moment and avoid a year of higher tariffs.</p>
<h2>What we built</h2>
<ul>
<li>Extraction and cleaning of half-hourly grid demand alongside temperature and calendar features.</li>
<li>Exploratory analysis of the drivers of demand and the resulting cost of energy.</li>
<li>Gradient-boosted models at daily and half-hourly resolution that predict the peak for each day, with a gauge for the likelihood that the day lands in the top four.</li>
<li>A dashboard concept giving stakeholders a real-time view of demand and the peak-day signal.</li>
</ul>
<h2>Why it matters</h2>
<p>This is the pattern behind most of our forecasting work: join operational data to external signals, model the quantity that drives cost, and surface it where someone can act on it.</p>
',
	],

];

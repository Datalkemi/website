<?php
/**
 * Template Name: Services Overview
 */
get_header();

// Group 1: Digital presence
$digital_services = [
	[
		'slug'  => 'website-design',
		'num'   => '01',
		'title' => 'Website Design',
		'desc'  => 'Bespoke UI/UX design built around your brand and your users. Every layout is validated against conversion goals before a single line of code is written.',
		'tags'  => [ 'Figma', 'UI/UX', 'Wireframes', 'Branding' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>',
		'points' => [ 'Conversion-focused layouts', 'Mobile-first responsive design', 'WCAG 2.1 AA accessible', 'Figma source files included' ],
	],
	[
		'slug'  => 'web-development',
		'num'   => '02',
		'title' => 'Web Development',
		'desc'  => 'Clean, maintainable full-stack code. From WordPress builds to custom React applications, we engineer for performance, security, and long-term scalability.',
		'tags'  => [ 'WordPress', 'React', 'PHP', 'APIs' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
		'points' => [ 'Sub-2s load times on all builds', 'WordPress CMS or custom React', 'REST API and third-party integrations', 'Full code handover and documentation' ],
	],
	[
		'slug'  => 'seo-optimisation',
		'num'   => '03',
		'title' => 'SEO Optimisation',
		'desc'  => 'Technical and content SEO built into the codebase itself, not bolted on afterwards. We target sustainable organic growth, not algorithm shortcuts.',
		'tags'  => [ 'Technical SEO', 'Content', 'Core Web Vitals', 'Schema' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>',
		'points' => [ 'Full technical SEO audit', 'Schema markup and semantic HTML', 'Core Web Vitals optimisation', 'Monthly reporting with ROI tracking' ],
	],
];

// Group 2: Data and intelligence
$data_services = [
	[
		'slug'  => 'data-analytics',
		'num'   => '04',
		'title' => 'Data Analytics',
		'desc'  => 'We design the pipelines, event tracking, and dashboards that turn scattered data into decisions. Clean data in, actionable intelligence out.',
		'tags'  => [ 'GA4', 'ETL', 'Python', 'Looker' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
		'points' => [ 'ETL pipeline design and build', 'GA4 advanced implementation', 'Single source of truth architecture', 'Automated reporting, zero manual exports' ],
	],
	[
		'slug'  => 'business-intelligence',
		'num'   => '05',
		'title' => 'Business Intelligence',
		'desc'  => 'Power BI and Tableau implementations that go beyond generic charts. We build the semantic data model, the KPI framework, and the self-service reporting layer.',
		'tags'  => [ 'Power BI', 'Tableau', 'DAX', 'SQL' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>',
		'points' => [ 'Star schema data modelling', 'DAX and SQL measure development', 'Row-level security and multi-tenant BI', 'Self-service training for business users' ],
	],
	[
		'slug'  => 'custom-dashboards',
		'num'   => '06',
		'title' => 'Custom Dashboards',
		'desc'  => 'Brand-matched, real-time dashboards built specifically around the metrics that run your business, not the defaults another tool decided you should care about.',
		'tags'  => [ 'Real-time', 'Multi-source', 'Embedded', 'Alerts' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
		'points' => [ 'KPI definition workshop included', 'Multi-source data aggregation', 'Role-based views and alert thresholds', 'Embedded in your site or intranet' ],
	],
];

$industries = [
	'E-Commerce', 'Technology', 'Financial Services', 'Healthcare',
	'Real Estate', 'Education', 'Hospitality', 'Professional Services',
	'Manufacturing', 'Media', 'Non-Profit', 'Logistics',
];
?>

<!-- Hero -->
<section class="page-hero page-hero--compact">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow">What We Do</p>
		<h1 class="page-hero-title">
			Services Built Around<br>
			<span class="gradient-text">Measurable Outcomes</span>
		</h1>
		<p class="page-hero-subtitle">
			Design, development, SEO, and data intelligence, delivered as a unified capability, not a list of disconnected tasks.
		</p>
		<div class="hero-buttons" style="margin-top:2rem;">
			<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary">
				Configure Your Project
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline">
				Talk to Us First
			</a>
		</div>
	</div>
</section>

<!-- Group 1: Digital Presence -->
<section class="dk-section" id="digital-presence" style="background:var(--color-bg);">
	<div class="dk-container">
		<div class="service-group-header">
			<span class="service-group-label">Digital Presence</span>
			<h2 class="service-group-title">Design, Build, and Get Found</h2>
			<p class="service-group-desc">From the first visual impression to the search ranking that brings people there, we handle the full digital presence stack.</p>
		</div>
		<div class="service-card-grid">
			<?php foreach ( $digital_services as $svc ) :
				$url = home_url( '/services/' . $svc['slug'] . '/' );
			?>
			<a href="<?php echo esc_url( $url ); ?>" class="service-card-link">
				<div class="service-card">
					<div class="service-card-top">
						<div class="service-card-icon"><?php echo $svc['svg']; ?></div>
						<span class="service-card-num"><?php echo esc_html( $svc['num'] ); ?></span>
					</div>
					<h3 class="service-card-title"><?php echo esc_html( $svc['title'] ); ?></h3>
					<p class="service-card-desc"><?php echo esc_html( $svc['desc'] ); ?></p>
					<ul class="service-card-points">
						<?php foreach ( $svc['points'] as $pt ) : ?>
							<li><?php echo esc_html( $pt ); ?></li>
						<?php endforeach; ?>
					</ul>
					<div class="service-card-footer">
						<div class="service-card-tags">
							<?php foreach ( $svc['tags'] as $tag ) : ?>
								<span class="service-tag"><?php echo esc_html( $tag ); ?></span>
							<?php endforeach; ?>
						</div>
						<span class="service-card-cta">
							Full details
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
						</span>
					</div>
				</div>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Group 2: Data and Intelligence -->
<section class="dk-section" id="data-intelligence" style="background:rgba(17,24,39,0.95);">
	<div class="dk-container">
		<div class="service-group-header">
			<span class="service-group-label">Data and Intelligence</span>
			<h2 class="service-group-title">Turn Your Data Into Decisions</h2>
			<p class="service-group-desc">Pipelines, models, and dashboards that connect your data and surface the intelligence your business needs to act on.</p>
		</div>
		<div class="service-card-grid">
			<?php foreach ( $data_services as $svc ) :
				$url = home_url( '/services/' . $svc['slug'] . '/' );
			?>
			<a href="<?php echo esc_url( $url ); ?>" class="service-card-link">
				<div class="service-card">
					<div class="service-card-top">
						<div class="service-card-icon"><?php echo $svc['svg']; ?></div>
						<span class="service-card-num"><?php echo esc_html( $svc['num'] ); ?></span>
					</div>
					<h3 class="service-card-title"><?php echo esc_html( $svc['title'] ); ?></h3>
					<p class="service-card-desc"><?php echo esc_html( $svc['desc'] ); ?></p>
					<ul class="service-card-points">
						<?php foreach ( $svc['points'] as $pt ) : ?>
							<li><?php echo esc_html( $pt ); ?></li>
						<?php endforeach; ?>
					</ul>
					<div class="service-card-footer">
						<div class="service-card-tags">
							<?php foreach ( $svc['tags'] as $tag ) : ?>
								<span class="service-tag"><?php echo esc_html( $tag ); ?></span>
							<?php endforeach; ?>
						</div>
						<span class="service-card-cta">
							Full details
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
						</span>
					</div>
				</div>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Configurator CTA -->
<section class="dk-section" style="background:var(--color-bg); padding:4rem 0;">
	<div class="dk-container">
		<div class="config-promo">
			<div class="config-promo-text">
				<p class="section-eyebrow">No Fixed Packages</p>
				<h2 style="font-size:clamp(1.75rem,4vw,2.5rem); font-weight:800; color:#f9fafb; margin-bottom:0.75rem; line-height:1.2;">
					Build exactly what you need.<br>Price it in real time.
				</h2>
				<p style="color:#9ca3af; font-size:1.0625rem; max-width:34rem; line-height:1.75;">
					Use our project configurator to select the features, integrations, and support level your project actually requires. Your estimate updates instantly and we send a full breakdown to your inbox.
				</p>
			</div>
			<div class="config-promo-action">
				<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary" style="font-size:1.0625rem; padding:1rem 2.25rem;">
					Open Configurator
				</a>
				<p style="color:#6b7280; font-size:0.875rem; margin-top:0.75rem; text-align:center;">Takes about 2 minutes</p>
			</div>
		</div>
	</div>
</section>

<!-- Why us -->
<section class="dk-section" style="background:rgba(17,24,39,0.95);">
	<div class="dk-container">
		<div class="dk-grid-2" style="gap:5rem; align-items:center;">
			<div>
				<p class="section-eyebrow">Why Datalkemi</p>
				<h2 class="dk-section-title" style="text-align:left; margin-bottom:1.25rem !important;">
					Specialists, Not Generalists
				</h2>
				<p class="about-text">Most agencies can build a website or run SEO. Very few can design the site, engineer the platform, implement the analytics, and build the BI layer that tells you how it is performing. That is the intersection we operate in.</p>
				<p class="about-text">We do not outsource. Every project is handled in-house by the same team from brief to delivery. You deal with the people actually doing the work.</p>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="dk-btn dk-btn-outline" style="margin-top:1.5rem;">
					About the Team
				</a>
			</div>
			<div>
				<?php
				$points = [
					[ 'title' => 'One team, full stack',    'desc' => 'Design through data, no handoffs to external contractors, no broken feedback loops.' ],
					[ 'title' => 'Defined before it starts', 'desc' => 'Scope, timeline, and deliverables are fixed in writing before a single invoice is raised.' ],
					[ 'title' => 'Outcomes, not outputs',   'desc' => 'We agree on success metrics at kickoff. You always know what return you are getting.' ],
					[ 'title' => 'Support past go-live',    'desc' => 'Every project includes a structured post-launch period. We do not disappear after delivery.' ],
				];
				foreach ( $points as $p ) : ?>
				<div class="usp-item" style="margin-bottom:0.875rem;">
					<span class="usp-check">&#10003;</span>
					<div>
						<strong style="color:#f9fafb; font-size:0.9375rem;"><?php echo esc_html( $p['title'] ); ?></strong>
						<p class="usp-text" style="margin-top:0.2rem; font-size:0.875rem;"><?php echo esc_html( $p['desc'] ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- Industries -->
<section class="dk-section" style="background:var(--color-bg); padding:4rem 0;">
	<div class="dk-container" style="text-align:center;">
		<p class="section-eyebrow" style="margin-bottom:0.75rem;">Sectors</p>
		<h2 class="dk-section-title" style="margin-bottom:2.5rem !important;">Industries We Work In</h2>
		<div class="industry-tags">
			<?php foreach ( $industries as $industry ) : ?>
				<span class="industry-tag"><?php echo esc_html( $industry ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title">Not sure where to start?</h2>
			<p class="cta-banner-subtitle">Book a free 30-minute call. We will listen, advise, and recommend the right approach with no pressure.</p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-primary">Book a Free Call</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

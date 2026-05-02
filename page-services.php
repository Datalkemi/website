<?php
/**
 * Template Name: Services Overview
 */
get_header();

$services_list = [
	[
		'slug'   => 'website-design',
		'num'    => '01',
		'title'  => 'Website Design',
		'desc'   => 'Bespoke UI/UX design built around your brand and your users. Every layout is validated against conversion goals before a single line of code is written.',
		'tags'   => [ 'Figma', 'UI/UX', 'Wireframes', 'Branding' ],
	],
	[
		'slug'   => 'web-development',
		'num'    => '02',
		'title'  => 'Web Development',
		'desc'   => 'Clean, maintainable full-stack code. From WordPress builds to custom React applications, we engineer for performance, security, and long-term scalability.',
		'tags'   => [ 'WordPress', 'React', 'PHP', 'APIs' ],
	],
	[
		'slug'   => 'seo-optimisation',
		'num'    => '03',
		'title'  => 'SEO Optimisation',
		'desc'   => 'Technical and content SEO built into the codebase itself, not bolted on afterwards. We target sustainable organic growth, not algorithm shortcuts.',
		'tags'   => [ 'Technical SEO', 'Content', 'Core Web Vitals', 'Schema' ],
	],
	[
		'slug'   => 'data-analytics',
		'num'    => '04',
		'title'  => 'Data Analytics',
		'desc'   => 'We design the pipelines, event tracking, and dashboards that turn scattered data into decisions. Clean data in, actionable intelligence out.',
		'tags'   => [ 'GA4', 'ETL', 'Python', 'Looker' ],
	],
	[
		'slug'   => 'business-intelligence',
		'num'    => '05',
		'title'  => 'Business Intelligence',
		'desc'   => 'Power BI and Tableau implementations that go beyond generic charts. We build the semantic data model, the KPI framework, and the self-service reporting layer.',
		'tags'   => [ 'Power BI', 'Tableau', 'DAX', 'SQL' ],
	],
	[
		'slug'   => 'custom-dashboards',
		'num'    => '06',
		'title'  => 'Custom Dashboards',
		'desc'   => 'Brand-matched, real-time dashboards built specifically around the metrics that run your business — not the defaults another tool decided you should care about.',
		'tags'   => [ 'Real-time', 'Multi-source', 'Embedded', 'Alerts' ],
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
			Design, development, SEO, and data intelligence — delivered as a unified capability, not a list of disconnected tasks.
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

<!-- Services list -->
<section class="dk-section" id="services-grid" style="background:var(--color-bg);">
	<div class="dk-container">
		<div class="service-list">
			<?php foreach ( $services_list as $svc ) :
				$url = home_url( '/services/' . $svc['slug'] . '/' );
			?>
			<div class="service-list-item">
				<div class="service-list-num"><?php echo esc_html( $svc['num'] ); ?></div>
				<div class="service-list-body">
					<h2 class="service-list-title"><?php echo esc_html( $svc['title'] ); ?></h2>
					<p class="service-list-desc"><?php echo esc_html( $svc['desc'] ); ?></p>
					<div class="service-list-tags">
						<?php foreach ( $svc['tags'] as $tag ) : ?>
							<span class="service-tag"><?php echo esc_html( $tag ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="service-list-action">
					<a href="<?php echo esc_url( $url ); ?>" class="dk-btn dk-btn-outline" style="white-space:nowrap;">
						See Full Details
					</a>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Configurator CTA -->
<section class="dk-section" style="background:rgba(17,24,39,0.95); padding:4rem 0;">
	<div class="dk-container">
		<div class="config-promo">
			<div class="config-promo-text">
				<p class="section-eyebrow">No Fixed Packages</p>
				<h2 style="font-size:clamp(1.75rem,4vw,2.5rem); font-weight:800; color:#f9fafb; margin-bottom:0.75rem; line-height:1.2;">
					Build exactly what you need.<br>Price it in real time.
				</h2>
				<p style="color:#9ca3af; font-size:1.0625rem; max-width:34rem; line-height:1.75;">
					Use our project configurator to select the features, integrations, and support level your project actually requires. Your estimate updates instantly, and we send a full breakdown to your inbox.
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
<section class="dk-section" style="background:var(--color-bg);">
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
					[ 'title' => 'One team, full stack', 'desc' => 'Design through data — no handoffs to external contractors, no broken feedback loops.' ],
					[ 'title' => 'Defined before it starts', 'desc' => 'Scope, timeline, and deliverables are fixed in writing before a single invoice is raised.' ],
					[ 'title' => 'Outcomes, not outputs', 'desc' => 'We agree on success metrics at kickoff. You always know what return you are getting.' ],
					[ 'title' => 'Support past go-live', 'desc' => 'Every project includes a structured post-launch period. We do not disappear after delivery.' ],
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
<section class="dk-section" style="background:rgba(17,24,39,0.95); padding:4rem 0;">
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

<?php
/**
 * Template Name: About Page
 */
get_header();

$values = [
	[
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
		'title' => 'Client-First Always',
		'desc'  => 'Every decision starts with one question: does this serve the client\'s best interest? We measure our success by yours.',
	],
	[
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
		'title' => 'Data-Driven Thinking',
		'desc'  => 'We do not rely on gut feelings. Every recommendation is backed by data, research, and measurable outcomes.',
	],
	[
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',
		'title' => 'Relentless Innovation',
		'desc'  => 'Technology moves fast. We stay ahead. Our team continuously learns and adopts new tools that give clients an edge.',
	],
	[
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
		'title' => 'Transparency',
		'desc'  => 'No hidden fees, no vague timelines, no surprises. You always know exactly where your project stands.',
	],
	[
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
		'title' => 'Excellence in Craft',
		'desc'  => 'Good enough is never good enough. We hold work to the highest standards, from clean code to meticulous data quality.',
	],
	[
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>',
		'title' => 'Long-Term Partnership',
		'desc'  => 'We invest in understanding your business deeply and building relationships that grow with you over time.',
	],
];

$stats = [
	[ 'number' => '50+',  'label' => 'Projects Delivered' ],
	[ 'number' => '98%',  'label' => 'Client Satisfaction' ],
	[ 'number' => '6+',   'label' => 'Years of Expertise' ],
	[ 'number' => '12+',  'label' => 'Industries Served' ],
];

$process = [
	[ 'step' => '01', 'title' => 'Discovery',          'desc' => 'We start every engagement with a structured discovery process, understanding your business model, goals, existing systems, and the problems you need solved.' ],
	[ 'step' => '02', 'title' => 'Strategy',            'desc' => 'Informed by discovery, we develop a clear, prioritised strategy. You receive a detailed proposal with scope, timeline, milestones, and success metrics before any work begins.' ],
	[ 'step' => '03', 'title' => 'Design and Build',    'desc' => 'Work is delivered in collaborative sprints with regular demos and reviews. You are involved throughout, not just at the start and end.' ],
	[ 'step' => '04', 'title' => 'Test and Refine',     'desc' => 'Everything is rigorously tested before delivery. We address every piece of feedback methodically and transparently, documenting all changes.' ],
	[ 'step' => '05', 'title' => 'Launch and Support',  'desc' => 'We oversee every launch to ensure a smooth go-live. Post-launch, we provide structured support and ongoing optimisation to ensure continued growth.' ],
];
?>

<!-- Page Hero -->
<section class="page-hero page-hero--compact page-hero--about">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow">About Datalkemi</p>
		<h1 class="page-hero-title">
			We Turn Technology Into<br>
			<span class="gradient-text">Tangible Business Value</span>
		</h1>
		<p class="page-hero-subtitle">
			A digital agency built at the intersection of web development, design, and data intelligence. We partner with ambitious businesses to build digital products and data capabilities that drive measurable growth.
		</p>
	</div>
</section>

<!-- Stats strip -->
<section class="stats-section">
	<div class="dk-container">
		<div class="stats-grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="stat-item">
					<span class="stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
					<span class="stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Story section -->
<section class="dk-section" id="our-story">
	<div class="dk-container">
		<div class="dk-grid-2" style="gap:4rem; align-items:center;">
			<div>
				<p class="section-eyebrow">Our Story</p>
				<h2 class="dk-section-title" style="text-align:left; margin-bottom:1.5rem !important;">
					Built on the Belief That Data and Design Should Work Together
				</h2>
				<p class="about-text">
					Datalkemi was founded on a simple observation: most businesses had great products and services, but lacked the digital presence and data capabilities to show it. The gap between what companies could achieve and what they were achieving was not a talent gap. It was a technology and strategy gap.
				</p>
				<p class="about-text">
					We built Datalkemi to close that gap. Our name reflects what we do: we apply chemistry to data, transforming raw, complex information into something useful and actionable. We combine web development, strategic design, and data science to give clients the full digital stack they need.
				</p>
				<p class="about-text">
					Today we work with businesses across industries, from startups building their digital presence for the first time to established companies transforming their data operations. Every engagement starts with the same commitment: your success is the only metric we care about.
				</p>
			</div>
			<div style="display:flex; flex-direction:column; gap:1.5rem;">
				<div class="dk-glass about-highlight-card">
					<div class="about-highlight-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
					</div>
					<div>
						<h3 class="about-subtitle">Our Mission</h3>
						<p class="about-text" style="margin-bottom:0 !important;">
							To deliver exceptional digital experiences and data-driven strategies that enable businesses to grow in a fast-moving technological landscape.
						</p>
					</div>
				</div>
				<div class="dk-glass about-highlight-card">
					<div class="about-highlight-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
					</div>
					<div>
						<h3 class="about-subtitle">Our Vision</h3>
						<p class="about-text" style="margin-bottom:0 !important;">
							To be the most trusted partner for businesses seeking to harness technology and data, recognised for integrity, expertise, and measurable impact.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Values section -->
<section class="dk-section values-section" id="our-values" style="background:rgba(17,24,39,0.95);">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow">What Drives Us</p>
			<span class="dk-section-title">Our Core Values</span>
			<p class="dk-section-subtitle">
				These are the principles we apply to every project, every client interaction, and every decision we make.
			</p>
		</div>
		<div class="dk-grid-3">
			<?php foreach ( $values as $value ) : ?>
				<div class="dk-card value-card">
					<span class="value-icon"><?php echo $value['svg']; ?></span>
					<h3 class="value-title"><?php echo esc_html( $value['title'] ); ?></h3>
					<p class="value-desc"><?php echo esc_html( $value['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- How We Work -->
<section class="dk-section" id="how-we-work">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow">Our Approach</p>
			<span class="dk-section-title">How We Work</span>
			<p class="dk-section-subtitle">
				A structured, transparent process that keeps you informed and in control at every stage, from first conversation to post-launch growth.
			</p>
		</div>
		<div class="process-timeline">
			<?php foreach ( $process as $step ) : ?>
				<div class="process-step">
					<div class="process-step-number"><?php echo esc_html( $step['step'] ); ?></div>
					<div class="process-step-content">
						<h3 class="process-step-title"><?php echo esc_html( $step['title'] ); ?></h3>
						<p class="process-step-desc"><?php echo esc_html( $step['desc'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA section -->
<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title">Ready to Start Something?</h2>
			<p class="cta-banner-subtitle">Tell us about your project and let us explore how Datalkemi can help you achieve your goals.</p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary">
				Configure Your Project
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline" style="border-color:#fff; color:#fff;">
				Contact Us
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

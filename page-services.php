<?php
/**
 * Template Name: Services Overview
 * Lists all services with icons, descriptions, and links.
 */
get_header();

$services_list = [
	[ 'slug' => 'website-design',        'icon' => '&#127912;', 'title' => 'Website Design',              'desc' => 'Pixel-perfect, conversion-driven designs that make your brand impossible to ignore online.' ],
	[ 'slug' => 'web-development',       'icon' => '&#128187;', 'title' => 'Full-Stack Development',      'desc' => 'Robust, scalable web applications built with clean code, best practices, and long-term maintainability.' ],
	[ 'slug' => 'seo-optimisation',      'icon' => '&#128269;', 'title' => 'SEO Optimisation',            'desc' => 'In-code, technical, and content SEO strategies that build sustainable organic search authority.' ],
	[ 'slug' => 'data-analytics',        'icon' => '&#128202;', 'title' => 'Data Analytics',              'desc' => 'Transform raw data into strategic intelligence with custom analytics pipelines and dashboards.' ],
	[ 'slug' => 'business-intelligence', 'icon' => '&#128203;', 'title' => 'Business Intelligence',       'desc' => 'Enterprise-grade BI solutions — Power BI, Tableau, and custom data models that answer the questions that matter.' ],
	[ 'slug' => 'custom-dashboards',     'icon' => '&#128200;', 'title' => 'Custom Dashboards',           'desc' => 'Real-time, brand-matched dashboards that surface the exact KPIs driving your business decisions.' ],
];

$industries = [
	'E-Commerce & Retail', 'Technology & SaaS', 'Finance & FinTech',
	'Healthcare', 'Real Estate', 'Education & EdTech',
	'Hospitality & Tourism', 'Professional Services', 'Non-Profit',
	'Manufacturing', 'Media & Entertainment', 'Logistics & Supply Chain',
];

$testimonials = new WP_Query( [
	'post_type'      => 'testimonial',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
] );
?>

<!-- Page Hero -->
<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'What We Do', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Services Built to', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'Move Your Business Forward', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle">
			<?php esc_html_e( 'From pixel-perfect digital design to enterprise data intelligence, Datalkemi delivers the full digital stack — engineered to measurable standards, delivered with precision.', 'datalkemi' ); ?>
		</p>
		<div class="hero-buttons">
			<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary">
				<?php esc_html_e( 'Get a Free Quote', 'datalkemi' ); ?>
			</a>
			<a href="#services-grid" class="dk-btn dk-btn-outline">
				<?php esc_html_e( 'Explore Services', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>

<!-- Services grid -->
<section class="dk-section" id="services-grid">
	<div class="dk-container">
		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Our Core Services', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Every service we offer is designed to deliver measurable impact — not just deliverables.', 'datalkemi' ); ?></p>
		</div>
		<div class="services-overview-grid">
			<?php foreach ( $services_list as $service ) :
				$url = home_url( '/services/' . $service['slug'] . '/' );
			?>
				<a href="<?php echo esc_url( $url ); ?>" class="service-overview-card">
					<div class="service-overview-icon"><?php echo $service['icon']; ?></div>
					<h3 class="service-overview-title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="service-overview-desc"><?php echo esc_html( $service['desc'] ); ?></p>
					<span class="service-overview-cta">
						<?php esc_html_e( 'Learn More', 'datalkemi' ); ?> &#8594;
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Why Datalkemi -->
<section class="dk-section why-section">
	<div class="dk-container">
		<div class="dk-grid-2" style="gap:4rem; align-items:center;">
			<div>
				<p class="section-eyebrow"><?php esc_html_e( 'The Datalkemi Difference', 'datalkemi' ); ?></p>
				<h2 class="dk-section-title" style="text-align:left; margin-bottom:1.5rem !important;">
					<?php esc_html_e( 'Why Businesses Choose Us', 'datalkemi' ); ?>
				</h2>
				<p class="about-text"><?php esc_html_e( 'We are not a generalist agency. We are specialists in the intersection of web technology and data intelligence. When you work with Datalkemi, you get a team that understands both the user-facing digital experience and the data infrastructure that powers it.', 'datalkemi' ); ?></p>
				<p class="about-text"><?php esc_html_e( 'Every project is managed with complete transparency. You receive regular updates, have direct access to your project team, and always know exactly what we\'re building and why.', 'datalkemi' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="dk-btn dk-btn-primary" style="margin-top:1rem;">
					<?php esc_html_e( 'About Datalkemi', 'datalkemi' ); ?> &#8594;
				</a>
			</div>
			<div style="display:flex; flex-direction:column; gap:1rem;">
				<?php
				$reasons = [
					[ 'icon' => '&#10003;', 'title' => 'Full-Stack Specialists', 'desc' => 'Design, development, SEO, and data — under one roof, working together from day one.' ],
					[ 'icon' => '&#10003;', 'title' => 'Transparent Process', 'desc' => 'Regular sprint demos, shared project boards, and direct communication. No black boxes.' ],
					[ 'icon' => '&#10003;', 'title' => 'Measurable Outcomes', 'desc' => 'We define success metrics before we start. You always know the return on your investment.' ],
					[ 'icon' => '&#10003;', 'title' => 'Post-Delivery Support', 'desc' => 'Every project includes structured post-launch support. We stay with you beyond go-live.' ],
				];
				foreach ( $reasons as $reason ) : ?>
					<div class="usp-item">
						<span class="usp-check"><?php echo $reason['icon']; ?></span>
						<div>
							<strong style="color:#f9fafb;"><?php echo esc_html( $reason['title'] ); ?></strong>
							<p class="usp-text" style="margin-top:0.25rem;"><?php echo esc_html( $reason['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- Industries -->
<section class="dk-section" id="industries">
	<div class="dk-container">
		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Industries We Serve', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Our work spans sectors — we bring domain-informed expertise to every engagement.', 'datalkemi' ); ?></p>
		</div>
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
			<h2 class="cta-banner-title"><?php esc_html_e( 'Not Sure Where to Start?', 'datalkemi' ); ?></h2>
			<p class="cta-banner-subtitle"><?php esc_html_e( 'Book a free 30-minute consultation. We\'ll listen, advise, and recommend the right solution — no sales pressure.', 'datalkemi' ); ?></p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary">
				<?php esc_html_e( 'Book a Free Consultation', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

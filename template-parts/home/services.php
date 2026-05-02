<?php
/**
 * Services section — homepage
 */
$services = [
	[
		'slug'  => 'website-design',
		'title' => __( 'Website Design', 'datalkemi' ),
		'desc'  => __( 'Bespoke UI/UX designed around your brand and your users. Every layout validated against conversion goals before a line of code is written.', 'datalkemi' ),
		'tags'  => [ 'Figma', 'UI/UX', 'Wireframes', 'Branding' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>',
	],
	[
		'slug'  => 'web-development',
		'title' => __( 'Web Development', 'datalkemi' ),
		'desc'  => __( 'Clean, maintainable full-stack code. From WordPress builds to custom React applications, engineered for performance, security, and long-term scalability.', 'datalkemi' ),
		'tags'  => [ 'WordPress', 'React', 'PHP', 'APIs' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>',
	],
	[
		'slug'  => 'seo-optimisation',
		'title' => __( 'SEO Optimisation', 'datalkemi' ),
		'desc'  => __( 'Technical and content SEO built into the codebase, not bolted on afterwards. Sustainable organic growth, not algorithm shortcuts.', 'datalkemi' ),
		'tags'  => [ 'Technical SEO', 'Core Web Vitals', 'Schema', 'Content' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
	],
	[
		'slug'  => 'data-analytics',
		'title' => __( 'Data Analytics', 'datalkemi' ),
		'desc'  => __( 'Pipelines, event tracking, and dashboards that turn scattered data into decisions. Clean data in, actionable intelligence out.', 'datalkemi' ),
		'tags'  => [ 'GA4', 'ETL', 'Python', 'Looker' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
	],
	[
		'slug'  => 'business-intelligence',
		'title' => __( 'Business Intelligence', 'datalkemi' ),
		'desc'  => __( 'Power BI and Tableau implementations built on a proper semantic data model and KPI framework — not just generic charts.', 'datalkemi' ),
		'tags'  => [ 'Power BI', 'Tableau', 'DAX', 'SQL' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>',
	],
	[
		'slug'  => 'custom-dashboards',
		'title' => __( 'Custom Dashboards', 'datalkemi' ),
		'desc'  => __( 'Brand-matched, real-time dashboards built around the metrics that run your business, not the defaults another tool decided you should care about.', 'datalkemi' ),
		'tags'  => [ 'Real-time', 'Multi-source', 'Embedded', 'Alerts' ],
		'svg'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
	],
];
?>
<section id="services" class="dk-section" style="background:rgba(17,24,39,0.95);">
	<div class="dk-container">

		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'What We Do', 'datalkemi' ); ?></p>
			<span class="dk-section-title"><?php esc_html_e( 'Six Services. One Team. No Handoffs.', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Design, development, SEO, and data intelligence delivered as a unified capability.', 'datalkemi' ); ?></p>
		</div>

		<div class="dk-grid-3">
			<?php foreach ( $services as $i => $service ) :
				$url = home_url( '/services/' . $service['slug'] . '/' );
			?>
				<a href="<?php echo esc_url( $url ); ?>" class="home-service-card-link">
					<div class="home-service-card dk-glass">
						<div class="home-service-card-top">
							<span class="home-service-card-icon"><?php echo $service['svg']; ?></span>
							<span class="home-service-card-num">0<?php echo $i + 1; ?></span>
						</div>
						<h3 class="home-service-card-title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="home-service-card-desc"><?php echo esc_html( $service['desc'] ); ?></p>
						<div class="home-service-card-tags">
							<?php foreach ( $service['tags'] as $tag ) : ?>
								<span class="service-tag"><?php echo esc_html( $tag ); ?></span>
							<?php endforeach; ?>
						</div>
						<span class="home-service-card-arrow">
							<?php esc_html_e( 'See full details', 'datalkemi' ); ?>
							<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
						</span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<div style="text-align:center; margin-top:3rem;">
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="dk-btn dk-btn-outline">
				<?php esc_html_e( 'View All Services', 'datalkemi' ); ?>
			</a>
		</div>

	</div>
</section>

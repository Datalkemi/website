<?php
/**
 * Template Part: Footer  -  Columns (top band)
 *
 * Five-column grid: brand (1.5fr) + three service categories (1fr each) + company (1fr).
 * Brand column: D logo on the left (~30%), tagline on the right (~70%).
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<div class="ft-columns">
	<div class="ft-container">
		<div class="ft-grid">

			<!-- Column 1: Brand -->
			<div class="ft-brand">

				<div class="ft-brand-top">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ft-logo-link" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<img
							src="<?php echo esc_url( DATALKEMI_URI . '/assets/images/logos/Logos/Logo_1.png' ); ?>"
							alt=""
							class="ft-logo"
							width="96"
							height="96"
							loading="lazy"
						/>
					</a>

					<p class="ft-tagline">
						<?php esc_html_e( 'We build the software and data systems businesses depend on. Perth-based, working with clients across Australia and beyond.', 'datalkemi' ); ?>
					</p>
				</div><!-- /.ft-brand-top -->

				<a href="https://meetings-ap1.hubspot.com/naufal" class="ft-btn-primary">
					<?php esc_html_e( 'Book a discovery call', 'datalkemi' ); ?>
				</a>

				<div class="ft-social">
					<a
						href="https://www.linkedin.com/company/datalkemi"
						target="_blank"
						rel="noopener noreferrer"
						aria-label="<?php esc_attr_e( 'Datalkemi on LinkedIn', 'datalkemi' ); ?>"
						class="ft-social-link"
					>
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
					</a>
					<a
						href="https://instagram.com/datalkemi"
						target="_blank"
						rel="noopener noreferrer"
						aria-label="<?php esc_attr_e( 'Datalkemi on Instagram', 'datalkemi' ); ?>"
						class="ft-social-link"
					>
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</a>
				</div>

			</div><!-- /.ft-brand -->

			<!-- Column 2: Custom Software -->
			<div class="ft-col">
				<p class="ft-col-heading"><?php esc_html_e( 'Custom software', 'datalkemi' ); ?></p>
				<ul class="ft-nav">
					<li><a href="<?php echo esc_url( home_url( '/services/#software-web-applications' ) ); ?>"><?php esc_html_e( 'Web applications', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#software-internal-tools' ) ); ?>"><?php esc_html_e( 'Internal tools', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#software-workflow-automation' ) ); ?>"><?php esc_html_e( 'Workflow automation', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#software-api-integrations' ) ); ?>"><?php esc_html_e( 'System integrations', 'datalkemi' ); ?></a></li>
				</ul>
			</div><!-- /.ft-col -->

			<!-- Column 3: Data and Intelligence -->
			<div class="ft-col">
				<p class="ft-col-heading"><?php esc_html_e( 'Data and intelligence', 'datalkemi' ); ?></p>
				<ul class="ft-nav">
					<li><a href="<?php echo esc_url( home_url( '/services/#data-platforms-pipelines' ) ); ?>"><?php esc_html_e( 'Data platforms', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#data-dashboards-reporting' ) ); ?>"><?php esc_html_e( 'Dashboards and reporting', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#data-document-intelligence' ) ); ?>"><?php esc_html_e( 'Document intelligence', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#data-machine-learning' ) ); ?>"><?php esc_html_e( 'Machine learning', 'datalkemi' ); ?></a></li>
				</ul>
			</div><!-- /.ft-col -->

			<!-- Column 4: Digital Presence -->
			<div class="ft-col">
				<p class="ft-col-heading"><?php esc_html_e( 'Digital presence', 'datalkemi' ); ?></p>
				<ul class="ft-nav">
					<li><a href="<?php echo esc_url( home_url( '/services/#digital-custom-websites' ) ); ?>"><?php esc_html_e( 'Custom websites', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#digital-ecommerce' ) ); ?>"><?php esc_html_e( 'E-commerce', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#digital-seo-performance' ) ); ?>"><?php esc_html_e( 'SEO and performance', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/#digital-analytics-tracking' ) ); ?>"><?php esc_html_e( 'Analytics', 'datalkemi' ); ?></a></li>
				</ul>
			</div><!-- /.ft-col -->

			<!-- Column 5: Company -->
			<div class="ft-col">
				<p class="ft-col-heading"><?php esc_html_e( 'Company', 'datalkemi' ); ?></p>
				<ul class="ft-nav">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>"><?php esc_html_e( 'Insights', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/configure-your-project/' ) ); ?>"><?php esc_html_e( 'Project estimator', 'datalkemi' ); ?></a></li>
				</ul>
			</div><!-- /.ft-col -->

		</div><!-- /.ft-grid -->
	</div><!-- /.ft-container -->
</div><!-- /.ft-columns -->

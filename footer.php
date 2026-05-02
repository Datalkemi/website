<footer id="colophon" class="site-footer">
	<div class="footer-inner">

		<div class="footer-grid">

			<!-- Brand column -->
			<div class="footer-brand">
				<?php if ( has_custom_logo() ) : the_custom_logo(); endif; ?>
				<p>Crafting digital excellence and data-driven solutions that help businesses grow, compete, and thrive in an ever-evolving landscape.</p>
				<div class="footer-social">
					<a href="https://linkedin.com/company/datalkemi" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="footer-social-link">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
					</a>
					<a href="https://github.com/datalkemi" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="footer-social-link">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
					</a>
					<a href="https://instagram.com/datalkemi" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="footer-social-link">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</a>
				</div>
			</div>

			<!-- Services column -->
			<div class="footer-col">
				<p class="footer-heading"><?php esc_html_e( 'Services', 'datalkemi' ); ?></p>
				<ul class="footer-menu">
					<li><a href="<?php echo esc_url( home_url( '/services/website-design/' ) ); ?>"><?php esc_html_e( 'Website Design', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/web-development/' ) ); ?>"><?php esc_html_e( 'Web Development', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/seo-optimisation/' ) ); ?>"><?php esc_html_e( 'SEO Optimisation', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/data-analytics/' ) ); ?>"><?php esc_html_e( 'Data Analytics', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/business-intelligence/' ) ); ?>"><?php esc_html_e( 'Business Intelligence', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/custom-dashboards/' ) ); ?>"><?php esc_html_e( 'Custom Dashboards', 'datalkemi' ); ?></a></li>
				</ul>
			</div>

			<!-- Company column -->
			<div class="footer-col">
				<p class="footer-heading"><?php esc_html_e( 'Company', 'datalkemi' ); ?></p>
				<ul class="footer-menu">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Our Work', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>"><?php esc_html_e( 'Insights & Blog', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'datalkemi' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>"><?php esc_html_e( 'Get a Quote', 'datalkemi' ); ?></a></li>
				</ul>
			</div>

			<!-- Contact column -->
			<div class="footer-col">
				<p class="footer-heading"><?php esc_html_e( 'Get in Touch', 'datalkemi' ); ?></p>
				<ul class="footer-contact-list">
					<li>
						<span class="footer-contact-icon">&#9993;</span>
						<a href="mailto:info@datalkemi.com" class="footer-contact-link">info@datalkemi.com</a>
					</li>
					<li>
						<span class="footer-contact-icon">&#128205;</span>
						<span style="color:var(--color-text-muted);"><?php esc_html_e( 'Remote-first. Global reach.', 'datalkemi' ); ?></span>
					</li>
				</ul>
				<div style="margin-top:1.5rem;">
					<a href="<?php echo esc_url( home_url( '/client-portal/' ) ); ?>" class="dk-btn dk-btn-outline" style="font-size:0.875rem; padding:0.625rem 1.25rem;">
						<?php esc_html_e( 'Client Portal', 'datalkemi' ); ?>
					</a>
				</div>
			</div>

		</div>

		<div class="footer-bottom">
			<p class="footer-copy">
				&copy; <?php echo esc_html( date( 'Y' ) ); ?> Datalkemi.
				<?php esc_html_e( 'All rights reserved.', 'datalkemi' ); ?>
			</p>
			<div class="footer-legal">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'datalkemi' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>"><?php esc_html_e( 'Terms of Service', 'datalkemi' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>"><?php esc_html_e( 'Cookie Policy', 'datalkemi' ); ?></a>
			</div>
		</div>

	</div>
</footer>

<button class="scroll-to-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'datalkemi' ); ?>">&#8679;</button>

<?php wp_footer(); ?>
</body>
</html>

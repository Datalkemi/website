<footer id="colophon" class="site-footer">
	<div class="container footer-inner">

		<div class="footer-grid">
			<!-- Brand -->
			<div class="footer-brand">
				<?php if ( has_custom_logo() ) : the_custom_logo(); endif; ?>
				<p>Crafting digital excellence and data-driven solutions to elevate your business.</p>
			</div>

			<!-- Quick Links -->
			<div class="footer-links">
				<p class="footer-heading"><?php esc_html_e( 'Quick Links', 'datalkemi' ); ?></p>
				<?php wp_nav_menu( [
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer-menu',
					'depth'          => 1,
					'fallback_cb'    => false,
				] ); ?>
			</div>

			<!-- Connect -->
			<div class="footer-connect">
				<p class="footer-heading"><?php esc_html_e( 'Connect', 'datalkemi' ); ?></p>
				<div class="social-links">
					<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
					</a>
					<a href="https://github.com" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
					</a>
					<a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</a>
				</div>
				<a href="mailto:info@datalkemi.com" class="footer-email">info@datalkemi.com</a>
			</div>
		</div>

		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Datalkemi. <?php esc_html_e( 'All rights reserved.', 'datalkemi' ); ?></p>
			<div class="footer-legal">
				<a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'datalkemi' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/terms-of-service' ) ); ?>"><?php esc_html_e( 'Terms of Service', 'datalkemi' ); ?></a>
			</div>
		</div>
	</div>
</footer>

<button class="scroll-to-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'datalkemi' ); ?>">&#8679;</button>

<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Contact section — homepage
 */
$services = [
	'Website Design', 'Web Development', 'SEO Optimisation',
	'Data Analytics', 'Business Intelligence', 'Custom Dashboards', 'Multiple Services',
];
?>
<section id="contact" class="dk-section">
	<div class="dk-container">

		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'Work With Us', 'datalkemi' ); ?></p>
			<span class="dk-section-title"><?php esc_html_e( 'Start a Conversation', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Tell us about your project. A senior team member will respond within one business day.', 'datalkemi' ); ?></p>
		</div>

		<div class="dk-grid-5-2">

			<!-- Contact info sidebar -->
			<div style="display:flex; flex-direction:column; gap:1.25rem;">

				<div class="dk-glass contact-info-card">
					<div class="contact-info-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
					</div>
					<div>
						<p class="contact-info-label"><?php esc_html_e( 'Email', 'datalkemi' ); ?></p>
						<a href="mailto:info@datalkemi.com" class="contact-email">info@datalkemi.com</a>
						<p class="contact-meta"><?php esc_html_e( 'Response within one business day', 'datalkemi' ); ?></p>
					</div>
				</div>

				<div class="dk-glass contact-info-card">
					<div class="contact-info-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
					</div>
					<div>
						<p class="contact-info-label"><?php esc_html_e( 'Location', 'datalkemi' ); ?></p>
						<p style="color:#f9fafb; font-size:0.9375rem; margin:0;"><?php esc_html_e( 'Remote-first. Global reach.', 'datalkemi' ); ?></p>
					</div>
				</div>

				<div class="dk-glass" style="padding:1.25rem 1.5rem;">
					<p class="contact-info-label" style="margin-bottom:0.875rem;"><?php esc_html_e( 'Follow Us', 'datalkemi' ); ?></p>
					<div class="social-links">
						<a href="https://linkedin.com/company/datalkemi" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
						</a>
						<a href="https://github.com/datalkemi" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="GitHub">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
						</a>
						<a href="https://instagram.com/datalkemi" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
						</a>
					</div>
				</div>

			</div>

			<!-- Contact form -->
			<div class="dk-glass contact-form-wrap">
				<form id="dk-contact-form" class="dk-contact-form" novalidate>
					<?php /* honeypot */ ?>
					<div style="position:absolute; left:-9999px; opacity:0;" aria-hidden="true">
						<input type="text" name="website" tabindex="-1" autocomplete="off">
					</div>

					<div class="contact-form-row">
						<div class="contact-form-field">
							<label for="cf-name"><?php esc_html_e( 'Name', 'datalkemi' ); ?> <span>*</span></label>
							<input type="text" id="cf-name" name="name" required placeholder="Jane Smith" autocomplete="name">
						</div>
						<div class="contact-form-field">
							<label for="cf-email"><?php esc_html_e( 'Email', 'datalkemi' ); ?> <span>*</span></label>
							<input type="email" id="cf-email" name="email" required placeholder="jane@company.com" autocomplete="email">
						</div>
					</div>

					<div class="contact-form-row">
						<div class="contact-form-field">
							<label for="cf-company"><?php esc_html_e( 'Company', 'datalkemi' ); ?></label>
							<input type="text" id="cf-company" name="company" placeholder="Acme Ltd" autocomplete="organization">
						</div>
						<div class="contact-form-field">
							<label for="cf-service"><?php esc_html_e( 'Service', 'datalkemi' ); ?></label>
							<select id="cf-service" name="service">
								<option value=""><?php esc_html_e( 'Select a service...', 'datalkemi' ); ?></option>
								<?php foreach ( $services as $svc ) : ?>
									<option value="<?php echo esc_attr( $svc ); ?>"><?php echo esc_html( $svc ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="contact-form-field">
						<label for="cf-message"><?php esc_html_e( 'Message', 'datalkemi' ); ?> <span>*</span></label>
						<textarea id="cf-message" name="message" required rows="5"
							placeholder="<?php esc_attr_e( 'Tell us what you are working on and what you need...', 'datalkemi' ); ?>"></textarea>
					</div>

					<button type="submit" class="dk-btn dk-btn-primary contact-form-submit" id="dk-contact-submit">
						<span class="btn-label"><?php esc_html_e( 'Send Message', 'datalkemi' ); ?></span>
						<span class="btn-loading" style="display:none;"><?php esc_html_e( 'Sending...', 'datalkemi' ); ?></span>
					</button>

					<div id="dk-contact-success" class="contact-form-success" style="display:none;">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
						<?php esc_html_e( 'Message sent. We will be in touch within one business day.', 'datalkemi' ); ?>
					</div>
					<div id="dk-contact-error" class="contact-form-error" style="display:none;"></div>

				</form>
			</div>

		</div>
	</div>
</section>

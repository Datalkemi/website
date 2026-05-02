<?php
/**
 * Contact section
 * WPForms shortcode is added once the form is created in WP Admin.
 * Replace XXXX with your actual WPForms form ID.
 */
$wpforms_id = get_option( 'datalkemi_contact_form_id', '' );
?>
<section id="contact" style="background: linear-gradient(to bottom, var(--color-bg), rgba(31,41,55,0.7));">
	<div class="container">

		<div style="text-align:center; margin-bottom:4rem;">
			<h2 class="section-title gradient-text"><?php esc_html_e( 'Get in Touch', 'datalkemi' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( "Have a project idea or need expert advice? We're here to help you succeed. Reach out to us!", 'datalkemi' ); ?></p>
		</div>

		<div style="display:grid; grid-template-columns:2fr 3fr; gap:2.5rem; align-items:start;">

			<!-- Contact info -->
			<div style="display:flex; flex-direction:column; gap:1.5rem;">
				<div class="glassmorphism" style="padding:1.5rem; border-radius:0.75rem;">
					<h3 style="font-size:1.125rem; font-weight:600; color:var(--color-primary); margin-bottom:0.75rem;">
						&#9993; <?php esc_html_e( 'Email Us', 'datalkemi' ); ?>
					</h3>
					<a href="mailto:info@datalkemi.com" style="color:#e5e7eb; text-decoration:none;">info@datalkemi.com</a>
					<p style="font-size:0.875rem; color:var(--color-text-muted); margin-top:0.25rem;">
						<?php esc_html_e( 'We typically respond within 24 hours.', 'datalkemi' ); ?>
					</p>
				</div>
				<div class="glassmorphism" style="padding:1.5rem; border-radius:0.75rem;">
					<h3 style="font-size:1.125rem; font-weight:600; color:var(--color-primary); margin-bottom:1rem;">
						<?php esc_html_e( 'Connect With Us', 'datalkemi' ); ?>
					</h3>
					<div style="display:flex; gap:1rem;">
						<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" style="color:var(--color-text-muted); background:rgba(31,41,55,0.8); padding:0.625rem; border-radius:50%; display:flex; text-decoration:none;">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
						</a>
						<a href="https://github.com" target="_blank" rel="noopener noreferrer" style="color:var(--color-text-muted); background:rgba(31,41,55,0.8); padding:0.625rem; border-radius:50%; display:flex; text-decoration:none;">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
						</a>
						<a href="https://instagram.com" target="_blank" rel="noopener noreferrer" style="color:var(--color-text-muted); background:rgba(31,41,55,0.8); padding:0.625rem; border-radius:50%; display:flex; text-decoration:none;">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
						</a>
					</div>
				</div>
			</div>

			<!-- Contact form -->
			<div class="glassmorphism" style="padding:2.5rem; border-radius:0.75rem; box-shadow: 0 20px 60px rgba(2,132,199,0.1);">
				<?php if ( $wpforms_id && function_exists( 'wpforms' ) ) :
					echo do_shortcode( '[wpforms id="' . esc_attr( $wpforms_id ) . '"]' );
				else : ?>
					<p style="color:var(--color-text-muted); text-align:center; padding:2rem 0;">
						<?php esc_html_e( 'Contact form loading... Please install WPForms and create a form, then set its ID in WP Admin → Settings.', 'datalkemi' ); ?>
					</p>
					<p style="text-align:center;">
						<a href="mailto:info@datalkemi.com" class="btn-primary"><?php esc_html_e( 'Email Us Directly', 'datalkemi' ); ?></a>
					</p>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>

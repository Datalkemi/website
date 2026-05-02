<?php
/**
 * Template Name: Get a Quote
 * Quote / proposal request page.
 */
get_header();

$wpforms_quote_id = get_option( 'datalkemi_quote_form_id', '' );

$what_happens = [
	[ 'step' => '01', 'title' => 'We Review Your Brief',   'desc' => 'Within 24 hours of your submission, a senior team member reviews your requirements and prepares initial thoughts.' ],
	[ 'step' => '02', 'title' => 'Discovery Call',          'desc' => 'We schedule a free 30-45 minute call to clarify requirements, answer your questions, and understand your goals in depth.' ],
	[ 'step' => '03', 'title' => 'Detailed Proposal',       'desc' => 'You receive a comprehensive proposal covering scope, timeline, approach, and transparent pricing, usually within 48 hours of the discovery call.' ],
];

$services = [
	'Website Design', 'Full-Stack Web Development', 'SEO Optimisation',
	'Data Analytics', 'Business Intelligence', 'Custom Dashboards', 'Multiple Services',
];
?>

<!-- Page Hero -->
<section class="page-hero page-hero--compact">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Work With Us', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Get a Free', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'Project Proposal', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle">
			<?php esc_html_e( "Tell us about your project. We will review your requirements and send a detailed, transparent proposal. No vague estimates, no obligation.", 'datalkemi' ); ?>
		</p>
	</div>
</section>

<!-- Main form section -->
<section class="dk-section">
	<div class="dk-container">
		<div class="quote-layout">

			<!-- Form -->
			<div class="quote-form-col">
				<div class="dk-glass" style="padding:2.5rem;">
					<h2 style="font-size:1.5rem; font-weight:700; color:#f9fafb; margin-bottom:1.5rem;">
						<?php esc_html_e( "Tell Us About Your Project", 'datalkemi' ); ?>
					</h2>

					<?php if ( $wpforms_quote_id && function_exists( 'wpforms' ) ) :
						echo do_shortcode( '[wpforms id="' . esc_attr( $wpforms_quote_id ) . '"]' );
					else : ?>
						<!-- Manual fallback form -->
						<form class="quote-form" method="post" action="mailto:info@datalkemi.com" enctype="text/plain">
							<div class="quote-form-row">
								<div class="quote-form-field">
									<label><?php esc_html_e( 'Your Name *', 'datalkemi' ); ?></label>
									<input type="text" name="name" required placeholder="John Smith" />
								</div>
								<div class="quote-form-field">
									<label><?php esc_html_e( 'Company Name', 'datalkemi' ); ?></label>
									<input type="text" name="company" placeholder="Acme Ltd" />
								</div>
							</div>
							<div class="quote-form-row">
								<div class="quote-form-field">
									<label><?php esc_html_e( 'Email Address *', 'datalkemi' ); ?></label>
									<input type="email" name="email" required placeholder="john@company.com" />
								</div>
								<div class="quote-form-field">
									<label><?php esc_html_e( 'Phone Number', 'datalkemi' ); ?></label>
									<input type="tel" name="phone" placeholder="+44 7700 000000" />
								</div>
							</div>
							<div class="quote-form-field">
								<label><?php esc_html_e( 'Service(s) Required *', 'datalkemi' ); ?></label>
								<select name="service" required>
									<option value=""><?php esc_html_e( 'Select a service...', 'datalkemi' ); ?></option>
									<?php
									// Pre-select via URL param
									$preselect = isset( $_GET['service'] ) ? sanitize_text_field( $_GET['service'] ) : '';
									foreach ( $services as $svc ) :
									?>
										<option value="<?php echo esc_attr( $svc ); ?>"
											<?php selected( strtolower( str_replace( ' ', '-', $svc ) ), $preselect ); ?>>
											<?php echo esc_html( $svc ); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="quote-form-field">
								<label><?php esc_html_e( 'Budget Range', 'datalkemi' ); ?></label>
								<select name="budget">
									<option value=""><?php esc_html_e( 'Select a range...', 'datalkemi' ); ?></option>
									<option value="under-1k"><?php esc_html_e( 'Under £1,000', 'datalkemi' ); ?></option>
									<option value="1k-3k"><?php esc_html_e( '£1,000 – £3,000', 'datalkemi' ); ?></option>
									<option value="3k-7k"><?php esc_html_e( '£3,000 – £7,000', 'datalkemi' ); ?></option>
									<option value="7k-15k"><?php esc_html_e( '£7,000 – £15,000', 'datalkemi' ); ?></option>
									<option value="15k-plus"><?php esc_html_e( '£15,000+', 'datalkemi' ); ?></option>
									<option value="ongoing"><?php esc_html_e( 'Monthly retainer', 'datalkemi' ); ?></option>
								</select>
							</div>
							<div class="quote-form-field">
								<label><?php esc_html_e( 'Timeline', 'datalkemi' ); ?></label>
								<select name="timeline">
									<option value=""><?php esc_html_e( 'Select a timeline...', 'datalkemi' ); ?></option>
									<option value="asap"><?php esc_html_e( 'As soon as possible', 'datalkemi' ); ?></option>
									<option value="1-month"><?php esc_html_e( 'Within 1 month', 'datalkemi' ); ?></option>
									<option value="1-3-months"><?php esc_html_e( '1–3 months', 'datalkemi' ); ?></option>
									<option value="3-6-months"><?php esc_html_e( '3–6 months', 'datalkemi' ); ?></option>
									<option value="flexible"><?php esc_html_e( 'Flexible', 'datalkemi' ); ?></option>
								</select>
							</div>
							<div class="quote-form-field">
								<label><?php esc_html_e( 'Tell Us About Your Project *', 'datalkemi' ); ?></label>
								<textarea name="description" required rows="6"
									placeholder="<?php esc_attr_e( 'Describe what you need, any existing systems, your goals, and anything that would help us understand your project...', 'datalkemi' ); ?>"></textarea>
							</div>
							<div class="quote-form-field">
								<label><?php esc_html_e( 'How Did You Find Us?', 'datalkemi' ); ?></label>
								<select name="source">
									<option value=""><?php esc_html_e( 'Select...', 'datalkemi' ); ?></option>
									<option value="google"><?php esc_html_e( 'Google Search', 'datalkemi' ); ?></option>
									<option value="referral"><?php esc_html_e( 'Referral / Word of Mouth', 'datalkemi' ); ?></option>
									<option value="linkedin"><?php esc_html_e( 'LinkedIn', 'datalkemi' ); ?></option>
									<option value="social"><?php esc_html_e( 'Social Media', 'datalkemi' ); ?></option>
									<option value="other"><?php esc_html_e( 'Other', 'datalkemi' ); ?></option>
								</select>
							</div>
							<button type="submit" class="dk-btn dk-btn-primary" style="width:100%; justify-content:center; font-size:1rem; padding:1rem;">
								<?php esc_html_e( 'Submit Project Brief &#8594;', 'datalkemi' ); ?>
							</button>
							<p style="font-size:0.8125rem; color:var(--color-text-muted); text-align:center; margin-top:1rem;">
								<?php esc_html_e( 'We respond to all enquiries within 24 hours. No spam, ever.', 'datalkemi' ); ?>
							</p>
						</form>
					<?php endif; ?>
				</div>
			</div>

			<!-- Sidebar -->
			<div class="quote-sidebar-col">

				<!-- What happens next -->
				<div class="dk-glass" style="padding:2rem; margin-bottom:1.5rem;">
					<h3 style="font-size:1.125rem; font-weight:700; color:#f9fafb; margin-bottom:1.5rem;">
						<?php esc_html_e( 'What Happens Next?', 'datalkemi' ); ?>
					</h3>
					<?php foreach ( $what_happens as $step ) : ?>
						<div class="quote-step">
							<div class="quote-step-number"><?php echo esc_html( $step['step'] ); ?></div>
							<div>
								<h4 style="font-size:0.9375rem; font-weight:600; color:#f9fafb; margin-bottom:0.25rem;">
									<?php echo esc_html( $step['title'] ); ?>
								</h4>
								<p style="font-size:0.875rem; color:var(--color-text-muted); line-height:1.6;">
									<?php echo esc_html( $step['desc'] ); ?>
								</p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<!-- Promises -->
				<div class="dk-glass" style="padding:2rem; margin-bottom:1.5rem;">
					<h3 style="font-size:1rem; font-weight:700; color:#f9fafb; margin-bottom:1rem;">
						<?php esc_html_e( 'Our Promises to You', 'datalkemi' ); ?>
					</h3>
					<?php $promises = [
						'Response within 24 hours, guaranteed.',
						'No obligation. The consultation is completely free.',
						'Transparent pricing, no hidden costs.',
						'Your information is never shared or sold.',
					]; foreach ( $promises as $p ) : ?>
						<div class="usp-item" style="padding:0.625rem 0.75rem;">
							<span class="usp-check">&#10003;</span>
							<span class="usp-text"><?php echo esc_html( $p ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>

				<!-- Direct contact -->
				<div class="dk-glass" style="padding:2rem; text-align:center;">
					<p style="font-size:0.9375rem; color:#f9fafb; font-weight:600; margin-bottom:0.5rem;">
						<?php esc_html_e( 'Prefer to talk first?', 'datalkemi' ); ?>
					</p>
					<p style="font-size:0.875rem; color:var(--color-text-muted); margin-bottom:1.25rem;">
						<?php esc_html_e( 'Email us directly and we\'ll get back to you within the hour during business hours.', 'datalkemi' ); ?>
					</p>
					<a href="mailto:info@datalkemi.com" class="dk-btn dk-btn-primary" style="font-size:0.875rem;">
						info@datalkemi.com
					</a>
				</div>

			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

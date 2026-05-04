<?php
/**
 * Template Name: Project Configurator
 * Wizard-style step-by-step project pricing tool.
 */
get_header();

require_once get_stylesheet_directory() . '/inc/configurator-data.php';
$config      = datalkemi_get_configurator_data();
$config_json = wp_json_encode( $config );

$total_steps = 1 + count( $config ) + 1; // country + sections + summary
?>

<section class="page-hero page-hero--compact">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-inner">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'No Surprises', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Build Your Project,', 'datalkemi' ); ?>
			<span class="gradient-text"><?php esc_html_e( 'See Your Price', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle" style="max-width:34rem;">
			<?php esc_html_e( 'Walk through your requirements step by step. Your personalised estimate appears at the end, no forms, no waiting.', 'datalkemi' ); ?>
		</p>
	</div>
</section>

<section class="dk-section cfg-wizard-section">
	<div class="dk-container">
		<div class="cfg-wizard" id="cfg-wizard">

			<!-- ── Progress ─────────────────────────────────────── -->
			<div class="cfg-progress-wrap">
				<div class="cfg-step-dots" id="cfg-step-dots"><!-- JS renders dots --></div>
				<div class="cfg-progress-track">
					<div class="cfg-progress-fill" id="cfg-progress-fill"></div>
				</div>
				<div class="cfg-progress-meta">
					<span class="cfg-progress-label" id="cfg-step-label">Step 1 of <?php echo (int) $total_steps; ?></span>
					<span class="cfg-progress-name"  id="cfg-step-name">Your location</span>
				</div>
			</div>

			<!-- ── Step panels ──────────────────────────────────── -->
			<div class="cfg-steps-wrap" id="cfg-steps-wrap">

				<!-- STEP 0: Country / Currency -->
				<div class="cfg-step" data-step="0" id="cfg-step-0">
					<div class="cfg-step-header">
						<h2>Where are you based?</h2>
						<p class="cfg-step-note">We'll display your estimate in your local currency throughout.</p>
					</div>
					<div class="cfg-country-search-wrap">
						<input
							type="text"
							id="cfg-country-search"
							class="cfg-country-search"
							placeholder="Search country&#8230;"
							autocomplete="off"
							aria-label="Search countries">
					</div>
					<div class="cfg-country-grid" id="cfg-country-grid">
						<!-- populated by JS -->
					</div>
				</div>

				<!-- STEPS 1–n: Config sections (injected by JS) -->

				<!-- STEP FINAL: Summary + Contact -->
				<div class="cfg-step" data-step="final" id="cfg-step-final">
					<div class="cfg-step-header">
						<h2>Your project estimate</h2>
						<p class="cfg-step-note">Review your build below, then send it to us for a full proposal.</p>
					</div>
					<div class="cfg-final-layout">

						<!-- Summary -->
						<div class="cfg-summary-panel">
							<div class="cfg-total-card">
								<p class="cfg-total-eyebrow">Estimated project cost</p>
								<div class="cfg-total-amount">
									<span id="cfg-currency-symbol">£</span><span id="cfg-total-num">0</span>
								</div>
								<p class="cfg-total-note">Starting estimate. Final price confirmed after a 30-minute scoping call.</p>
							</div>
							<div class="cfg-summary-breakdown" id="cfg-summary-breakdown">
								<!-- populated by JS -->
							</div>
						</div>

						<!-- Contact form -->
						<div class="cfg-contact-panel">
							<h3>Send me this quote</h3>
							<p class="cfg-contact-note">We review every submission personally and reply within one business day.</p>
							<div class="cfg-contact-fields">
								<div class="cfg-field">
									<label for="cfg-name">Your name <span class="cfg-req">*</span></label>
									<input type="text" id="cfg-name" placeholder="Jane Smith" required>
								</div>
								<div class="cfg-field">
									<label for="cfg-email">Email address <span class="cfg-req">*</span></label>
									<input type="email" id="cfg-email" placeholder="jane@company.com" required>
								</div>
								<div class="cfg-field">
									<label for="cfg-company">Company <span class="cfg-optional">(optional)</span></label>
									<input type="text" id="cfg-company" placeholder="Acme Ltd">
								</div>
								<div class="cfg-field">
									<label for="cfg-notes">Additional notes <span class="cfg-optional">(optional)</span></label>
									<textarea id="cfg-notes" rows="3" placeholder="Any context that helps us understand your project better."></textarea>
								</div>
							</div>
							<button type="button" id="cfg-submit" class="dk-btn dk-btn-primary cfg-submit-btn">
								<span class="btn-label">Send My Quote</span>
								<span class="btn-loading" hidden>Sending&hellip;</span>
							</button>
							<div id="cfg-success" hidden class="cfg-success-msg">
								<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
								<h3>Quote sent!</h3>
								<p>Check your inbox. We'll follow up within one business day with a full proposal.</p>
							</div>
							<p id="cfg-error" hidden class="cfg-error-msg">
								Something went wrong. Email us at <a href="mailto:info@datalkemi.com">info@datalkemi.com</a>.
							</p>
						</div>

					</div><!-- .cfg-final-layout -->
				</div><!-- #cfg-step-final -->

			</div><!-- .cfg-steps-wrap -->

			<!-- ── Navigation ───────────────────────────────────── -->
			<div class="cfg-nav-wrap" id="cfg-nav-wrap">
				<button class="cfg-nav-btn cfg-nav-prev" id="cfg-prev" hidden aria-label="Previous step">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
					Back
				</button>
				<button class="cfg-nav-btn cfg-nav-next" id="cfg-next" disabled aria-label="Next step">
					Continue
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
				</button>
			</div>

		</div><!-- .cfg-wizard -->
	</div>
</section>

<?php
echo '<script>window.DK_CONFIG = ' . $config_json . '; window.DK_TOTAL_STEPS = ' . (int) $total_steps . ';</script>';
wp_enqueue_script( 'datalkemi-configurator', get_stylesheet_directory_uri() . '/assets/js/configurator.js', [], '2.0.0', true );
wp_localize_script( 'datalkemi-configurator', 'DK_AJAX', [
	'url'   => admin_url( 'admin-ajax.php' ),
	'nonce' => wp_create_nonce( 'dk_configurator_submit' ),
] );
get_footer();

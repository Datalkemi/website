<?php
/**
 * Template Name: Project Configurator
 * Interactive, component-based project pricing tool.
 */
get_header();

require_once get_stylesheet_directory() . '/inc/configurator-data.php';
$config = datalkemi_get_configurator_data();
$config_json = wp_json_encode( $config );
?>

<section class="config-hero">
	<div class="config-hero-overlay"></div>
	<div class="dk-container config-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'No Surprises', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Build Your Project,', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'See Your Price', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle" style="max-width:36rem;">
			<?php esc_html_e( 'Select the components your project needs. Your estimate updates in real time. No forms, no waiting just a clear number to start from.', 'datalkemi' ); ?>
		</p>
	</div>
</section>

<section class="dk-section" style="padding-top:3rem; padding-bottom:5rem;">
	<div class="dk-container">
		<div class="config-layout">

			<!-- ── Sections ─────────────────────────────────── -->
			<div class="config-sections" id="config-form">

				<?php foreach ( $config as $section_key => $section ) : ?>
				<div class="config-section" data-section="<?php echo esc_attr( $section_key ); ?>">
					<div class="config-section-header">
						<h2 class="config-section-title"><?php echo esc_html( $section['label'] ); ?></h2>
						<?php if ( ! empty( $section['note'] ) ) : ?>
							<p class="config-section-note"><?php echo esc_html( $section['note'] ); ?></p>
						<?php endif; ?>
					</div>
					<div class="config-options config-options--<?php echo esc_attr( $section['type'] ); ?>">
						<?php foreach ( $section['options'] as $i => $opt ) : ?>
							<label class="config-option" for="<?php echo esc_attr( $section_key . '-' . $opt['id'] ); ?>">
								<input
									type="<?php echo $section['type'] === 'radio' ? 'radio' : 'checkbox'; ?>"
									id="<?php echo esc_attr( $section_key . '-' . $opt['id'] ); ?>"
									name="<?php echo esc_attr( $section_key ); ?>"
									value="<?php echo esc_attr( $opt['id'] ); ?>"
									data-price="<?php echo (int) $opt['price']; ?>"
									data-label="<?php echo esc_attr( $opt['label'] ); ?>"
									data-section="<?php echo esc_attr( $section_key ); ?>"
									<?php if ( $section['type'] === 'radio' && $i === 0 ) echo 'checked'; ?>
								>
								<span class="config-option-inner">
									<span class="config-option-text">
										<span class="config-option-label"><?php echo esc_html( $opt['label'] ); ?></span>
										<span class="config-option-desc"><?php echo esc_html( $opt['desc'] ); ?></span>
									</span>
									<span class="config-option-price">
										<?php if ( $opt['price'] > 0 ) : ?>
											+&thinsp;<?php echo '£' . number_format( $opt['price'] ); ?>
										<?php else : ?>
											<span style="color:#4ade80;">Included</span>
										<?php endif; ?>
									</span>
									<span class="config-option-check">
										<span class="config-check-icon"></span>
									</span>
								</span>
							</label>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endforeach; ?>

				<!-- Contact details -->
				<div class="config-section">
					<div class="config-section-header">
						<h2 class="config-section-title">Your contact details</h2>
						<p class="config-section-note">We'll send your itemised quote to this address. No spam, no cold calls.</p>
					</div>
					<div class="config-contact-fields">
						<div class="config-field">
							<label for="cfg-name">Your name <span style="color:#ef4444;">*</span></label>
							<input type="text" id="cfg-name" name="cfg_name" placeholder="Jane Smith" required>
						</div>
						<div class="config-field">
							<label for="cfg-email">Email address <span style="color:#ef4444;">*</span></label>
							<input type="email" id="cfg-email" name="cfg_email" placeholder="jane@company.com" required>
						</div>
						<div class="config-field">
							<label for="cfg-company">Company (optional)</label>
							<input type="text" id="cfg-company" name="cfg_company" placeholder="Acme Ltd">
						</div>
						<div class="config-field" style="grid-column:1/-1;">
							<label for="cfg-notes">Additional notes (optional)</label>
							<textarea id="cfg-notes" name="cfg_notes" rows="4" placeholder="Any context that would help us understand your project better."></textarea>
						</div>
					</div>
				</div>

				<div id="config-submit-wrap">
					<button type="button" id="config-submit" class="dk-btn dk-btn-primary" style="font-size:1.0625rem; padding:1rem 2.5rem;">
						Send My Quote
					</button>
					<p class="config-submit-note">We review every submission personally and respond within one business day.</p>
					<div id="config-success" hidden>
						<div class="config-success-card">
							<span class="config-success-icon">&#10003;</span>
							<h3>Quote sent.</h3>
							<p>Check your inbox. We'll follow up within one business day with a full proposal based on your configuration.</p>
						</div>
					</div>
					<div id="config-error" hidden>
						<p class="config-error-msg">Something went wrong. Please email us directly at <a href="mailto:info@datalkemi.com">info@datalkemi.com</a>.</p>
					</div>
				</div>

			</div>

			<!-- ── Price Summary Sidebar ─────────────────────── -->
			<aside class="config-sidebar" id="config-sidebar">
				<div class="config-price-card" id="config-price-card">
					<p class="config-price-label">Estimated project cost</p>
					<div class="config-price-total" id="config-total">
						<span class="config-currency">£</span><span id="config-total-num">800</span>
					</div>
					<p class="config-price-note">Starting estimate. Final price confirmed after a 30-minute scoping call.</p>

					<div class="config-breakdown" id="config-breakdown">
						<p class="config-breakdown-title">Selections</p>
						<ul id="config-breakdown-list">
							<!-- populated by JS -->
						</ul>
					</div>

					<div class="config-sidebar-cta">
						<a href="#config-submit-wrap" class="dk-btn dk-btn-primary" style="width:100%; justify-content:center;">
							Get This Quote
						</a>
						<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="config-sidebar-alt">
							Prefer to talk first?
						</a>
					</div>
				</div>
			</aside>

		</div>
	</div>
</section>

<?php
// Output config data for JS
echo '<script>window.DK_CONFIG = ' . $config_json . ';</script>';
wp_enqueue_script( 'datalkemi-configurator', get_template_directory_uri() . '/assets/js/configurator.js', [], '1.0.0', true );
wp_localize_script( 'datalkemi-configurator', 'DK_AJAX', [
	'url'   => admin_url( 'admin-ajax.php' ),
	'nonce' => wp_create_nonce( 'dk_configurator_submit' ),
] );
?>

<?php get_footer(); ?>

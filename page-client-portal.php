<?php
/**
 * Template Name: Client Portal
 * Login-gated client dashboard.
 */
get_header();
?>

<?php if ( ! is_user_logged_in() ) : ?>

	<!-- Login gate -->
	<section style="min-height:100vh; display:flex; align-items:center; background:linear-gradient(135deg,#070c18 0%,#0d1520 100%); position:relative; overflow:hidden;">
		<div style="position:absolute;inset:0;background-image:radial-gradient(circle,rgba(2,132,199,0.15) 1px,transparent 1px);background-size:28px 28px;pointer-events:none;"></div>
		<div style="position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(2,132,199,0.12) 0%,transparent 60%);pointer-events:none;"></div>
		<div class="dk-container" style="position:relative;z-index:2;display:flex;justify-content:center;padding:2rem 1.5rem;">
			<div class="dk-glass portal-login-card">
				<div style="text-align:center; margin-bottom:2rem;">
					<div style="width:52px;height:52px;border-radius:14px;background:rgba(2,132,199,0.15);border:1px solid rgba(2,132,199,0.3);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(2,132,199,0.9)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
					</div>
					<h1 style="font-size:1.625rem !important; font-weight:700 !important; color:#f9fafb !important; margin:0 0 0.5rem !important; -webkit-text-fill-color:#f9fafb !important;">
						<?php esc_html_e( 'Client Portal', 'datalkemi' ); ?>
					</h1>
					<p style="color:var(--color-text-muted); font-size:0.9375rem; margin:0;">
						<?php esc_html_e( 'Sign in to access your projects, documents, and support.', 'datalkemi' ); ?>
					</p>
				</div>

				<?php
				// Show login errors if any
				if ( isset( $_GET['login'] ) && $_GET['login'] === 'failed' ) : ?>
					<div class="portal-alert portal-alert--error">
						<?php esc_html_e( 'Incorrect email or password. Please try again.', 'datalkemi' ); ?>
					</div>
				<?php endif; ?>

				<?php wp_login_form( [
					'redirect'       => home_url( '/client-portal/' ),
					'form_id'        => 'dk-portal-login',
					'label_username' => __( 'Email Address', 'datalkemi' ),
					'label_password' => __( 'Password', 'datalkemi' ),
					'label_remember' => __( 'Keep me signed in', 'datalkemi' ),
					'label_log_in'   => __( 'Sign In to Portal', 'datalkemi' ),
					'remember'       => true,
				] ); ?>

				<div style="text-align:center; margin-top:1.5rem; font-size:0.875rem; color:var(--color-text-muted);">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" style="color:var(--color-primary) !important;">
						<?php esc_html_e( 'Forgot your password?', 'datalkemi' ); ?>
					</a>
					<span style="margin:0 0.75rem;">|</span>
					<?php esc_html_e( 'Not a client yet?', 'datalkemi' ); ?>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color:var(--color-primary) !important;">
						<?php esc_html_e( 'Get in touch', 'datalkemi' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

<?php else :

	$user     = wp_get_current_user();
	$is_admin = current_user_can( 'manage_options' ) || current_user_can( 'edit_posts' );

	// If admin, redirect to WP admin handled by PHP, but also show a notice
	if ( $is_admin ) : ?>
		<section class="dk-section">
			<div class="dk-container" style="text-align:center; padding:4rem 0;">
				<p style="font-size:2rem; margin-bottom:1rem;">&#128640;</p>
				<h2 class="dk-section-title"><?php esc_html_e( 'Welcome back!', 'datalkemi' ); ?></h2>
				<p class="dk-section-subtitle" style="margin-bottom:2rem;">
					<?php printf( esc_html__( 'You are logged in as %s (Admin). Manage the site from WP Admin.', 'datalkemi' ), '<strong>' . esc_html( $user->display_name ) . '</strong>' ); ?>
				</p>
				<a href="<?php echo esc_url( admin_url() ); ?>" class="dk-btn dk-btn-primary">
					<?php esc_html_e( 'Go to WP Admin', 'datalkemi' ); ?>
				</a>
			</div>
		</section>

	<?php else :
		// Client dashboard
		$projects = datalkemi_get_client_projects( $user->ID );
	?>

	<section class="dk-section" style="background:var(--color-bg); padding-top:2rem !important;">
		<div class="dk-container">

			<!-- Dashboard header -->
			<div class="portal-header">
				<div>
					<p class="section-eyebrow"><?php esc_html_e( 'Client Portal', 'datalkemi' ); ?></p>
					<h1 style="font-size:1.75rem !important; font-weight:700 !important; color:#f9fafb; margin:0 !important;">
						<?php printf( esc_html__( 'Welcome back, %s', 'datalkemi' ), esc_html( $user->first_name ?: $user->display_name ) ); ?>
					</h1>
				</div>
				<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="dk-btn dk-btn-outline" style="font-size:0.875rem;">
					<?php esc_html_e( 'Sign Out', 'datalkemi' ); ?>
				</a>
			</div>

			<!-- Dashboard nav tabs -->
			<div class="portal-tabs">
				<button class="portal-tab portal-tab--active" data-tab="projects">
					&#128196; <?php esc_html_e( 'My Projects', 'datalkemi' ); ?>
				</button>
				<button class="portal-tab" data-tab="documents">
					&#128193; <?php esc_html_e( 'Documents', 'datalkemi' ); ?>
				</button>
				<button class="portal-tab" data-tab="support">
					&#128172; <?php esc_html_e( 'Support', 'datalkemi' ); ?>
				</button>
				<button class="portal-tab" data-tab="account">
					&#128100; <?php esc_html_e( 'My Account', 'datalkemi' ); ?>
				</button>
			</div>

			<!-- Tab: Projects -->
			<div class="portal-panel" id="tab-projects">
				<?php if ( ! empty( $projects ) ) : ?>
					<div class="portal-projects-grid">
						<?php foreach ( $projects as $project ) :
							$status_key  = get_post_meta( $project->ID, '_project_status', true ) ?: 'in-progress';
							$progress    = (int) get_post_meta( $project->ID, '_project_progress', true );
							$category    = get_post_meta( $project->ID, '_project_category', true );
							$start_date  = get_post_meta( $project->ID, '_project_start_date', true );
							$end_date    = get_post_meta( $project->ID, '_project_end_date', true );
							$live_url    = get_post_meta( $project->ID, '_project_live_url', true );
							$status_info = datalkemi_project_status( $status_key );
						?>
							<div class="portal-project-card">
								<div class="portal-project-header">
									<div>
										<?php if ( $category ) : ?>
											<p class="project-category" style="margin-bottom:0.375rem;"><?php echo esc_html( $category ); ?></p>
										<?php endif; ?>
										<h3 class="portal-project-title"><?php echo esc_html( $project->post_title ); ?></h3>
									</div>
									<span class="status-badge" style="background:<?php echo esc_attr( $status_info['color'] ); ?>20; color:<?php echo esc_attr( $status_info['color'] ); ?>; border:1px solid <?php echo esc_attr( $status_info['color'] ); ?>40;">
										<?php echo esc_html( $status_info['label'] ); ?>
									</span>
								</div>

								<?php if ( $progress > 0 ) : ?>
									<div class="portal-progress">
										<div class="portal-progress-header">
											<span style="font-size:0.8125rem; color:var(--color-text-muted);"><?php esc_html_e( 'Progress', 'datalkemi' ); ?></span>
											<span style="font-size:0.8125rem; font-weight:600; color:var(--color-primary);"><?php echo esc_html( $progress ); ?>%</span>
										</div>
										<div class="portal-progress-bar">
											<div class="portal-progress-fill" style="width:<?php echo esc_attr( $progress ); ?>%"></div>
										</div>
									</div>
								<?php endif; ?>

								<?php
								$excerpt = get_the_excerpt( $project );
								if ( $excerpt ) : ?>
									<p style="color:var(--color-text-muted); font-size:0.9rem; line-height:1.6; margin-bottom:1rem;">
										<?php echo esc_html( $excerpt ); ?>
									</p>
								<?php endif; ?>

								<div class="portal-project-meta">
									<?php if ( $start_date ) : ?>
										<span>&#128197; <?php echo esc_html( date_i18n( 'j M Y', strtotime( $start_date ) ) ); ?></span>
									<?php endif; ?>
									<?php if ( $end_date ) : ?>
										<span>&#127937; <?php echo esc_html( date_i18n( 'j M Y', strtotime( $end_date ) ) ); ?></span>
									<?php endif; ?>
								</div>

								<?php if ( $live_url ) : ?>
									<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer" class="dk-btn dk-btn-outline" style="font-size:0.8125rem; padding:0.5rem 1.25rem; margin-top:1rem;">
										<?php esc_html_e( 'View Live Site &#8599;', 'datalkemi' ); ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="portal-empty-state">
						<span class="portal-empty-icon">&#128196;</span>
						<h3><?php esc_html_e( 'No active projects yet', 'datalkemi' ); ?></h3>
						<p><?php esc_html_e( 'Your projects will appear here once we get started. Ready to kick off?', 'datalkemi' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary">
							<?php esc_html_e( 'Start a Project', 'datalkemi' ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Tab: Documents -->
			<div class="portal-panel" id="tab-documents" hidden>
				<div class="portal-empty-state">
					<span class="portal-empty-icon">&#128193;</span>
					<h3><?php esc_html_e( 'Documents & Files', 'datalkemi' ); ?></h3>
					<p><?php esc_html_e( 'Your project files, deliverables, and shared documents will appear here. Contact your project manager if you\'re expecting files.', 'datalkemi' ); ?></p>
					<a href="mailto:info@datalkemi.com" class="dk-btn dk-btn-outline">
						<?php esc_html_e( 'Contact Your Manager', 'datalkemi' ); ?>
					</a>
				</div>
			</div>

			<!-- Tab: Support -->
			<div class="portal-panel" id="tab-support" hidden>
				<div class="portal-support-layout">
					<div>
						<h3 style="font-size:1.25rem; font-weight:700; color:#f9fafb; margin-bottom:0.5rem;">
							<?php esc_html_e( 'Submit a Support Request', 'datalkemi' ); ?>
						</h3>
						<p style="color:var(--color-text-muted); margin-bottom:1.5rem; font-size:0.9375rem;">
							<?php esc_html_e( 'Have a question, need a change, or spotted an issue? Use the form below and we\'ll get back to you within one business day.', 'datalkemi' ); ?>
						</p>
						<?php
						$support_form_id = get_option( 'datalkemi_support_form_id', '' );
						if ( $support_form_id && function_exists( 'wpforms' ) ) :
							echo do_shortcode( '[wpforms id="' . esc_attr( $support_form_id ) . '"]' );
						else : ?>
							<div class="portal-alert">
								<?php esc_html_e( 'Support form not yet configured. Please email ', 'datalkemi' ); ?>
								<a href="mailto:support@datalkemi.com" style="color:var(--color-primary) !important;">support@datalkemi.com</a>
							</div>
						<?php endif; ?>
					</div>
					<div>
						<div class="dk-glass" style="padding:1.5rem; margin-bottom:1.5rem;">
							<h4 style="font-size:0.9375rem; font-weight:600; color:#f9fafb; margin-bottom:1rem;">
								<?php esc_html_e( 'Quick Contact', 'datalkemi' ); ?>
							</h4>
							<p style="color:var(--color-text-muted); font-size:0.875rem; margin-bottom:0.75rem;">
								<?php esc_html_e( 'For urgent matters:', 'datalkemi' ); ?>
							</p>
							<a href="mailto:support@datalkemi.com" class="dk-btn dk-btn-primary" style="width:100%; justify-content:center; font-size:0.875rem; text-align:center;">
								support@datalkemi.com
							</a>
						</div>
						<div class="dk-glass" style="padding:1.5rem;">
							<h4 style="font-size:0.9375rem; font-weight:600; color:#f9fafb; margin-bottom:0.75rem;">
								<?php esc_html_e( 'Response Times', 'datalkemi' ); ?>
							</h4>
							<ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:0.5rem;">
								<li style="font-size:0.875rem; color:var(--color-text-muted);">&#129001; <?php esc_html_e( 'Critical: Within 4 hours', 'datalkemi' ); ?></li>
								<li style="font-size:0.875rem; color:var(--color-text-muted);">&#128998; <?php esc_html_e( 'Standard: Within 1 business day', 'datalkemi' ); ?></li>
								<li style="font-size:0.875rem; color:var(--color-text-muted);">&#128997; <?php esc_html_e( 'General: Within 2 business days', 'datalkemi' ); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Tab: Account -->
			<div class="portal-panel" id="tab-account" hidden>
				<div class="portal-account-grid">
					<div class="dk-glass" style="padding:2rem;">
						<h3 style="font-size:1.125rem; font-weight:700; color:#f9fafb; margin-bottom:1.5rem;">
							<?php esc_html_e( 'Account Details', 'datalkemi' ); ?>
						</h3>
						<ul class="project-detail-list">
							<li class="project-detail-item">
								<span class="project-detail-label"><?php esc_html_e( 'Name', 'datalkemi' ); ?></span>
								<span class="project-detail-value"><?php echo esc_html( $user->display_name ); ?></span>
							</li>
							<li class="project-detail-item">
								<span class="project-detail-label"><?php esc_html_e( 'Email', 'datalkemi' ); ?></span>
								<span class="project-detail-value"><?php echo esc_html( $user->user_email ); ?></span>
							</li>
							<li class="project-detail-item">
								<span class="project-detail-label"><?php esc_html_e( 'Member since', 'datalkemi' ); ?></span>
								<span class="project-detail-value"><?php echo esc_html( date_i18n( 'F Y', strtotime( $user->user_registered ) ) ); ?></span>
							</li>
						</ul>
						<div style="margin-top:1.5rem;">
							<a href="<?php echo esc_url( get_edit_profile_url() ); ?>" class="dk-btn dk-btn-outline" style="font-size:0.875rem;">
								<?php esc_html_e( 'Edit Profile', 'datalkemi' ); ?>
							</a>
						</div>
					</div>
					<div class="dk-glass" style="padding:2rem;">
						<h3 style="font-size:1.125rem; font-weight:700; color:#f9fafb; margin-bottom:1rem;">
							<?php esc_html_e( 'Need Help?', 'datalkemi' ); ?>
						</h3>
						<p style="color:var(--color-text-muted); font-size:0.9375rem; margin-bottom:1.5rem;">
							<?php esc_html_e( 'Our team is available Mon–Fri, 9am–6pm. Reach out any time for project updates, changes, or general questions.', 'datalkemi' ); ?>
						</p>
						<a href="mailto:info@datalkemi.com" class="dk-btn dk-btn-primary" style="font-size:0.875rem;">
							&#9993; info@datalkemi.com
						</a>
					</div>
				</div>
			</div>

		</div>
	</section>

	<?php endif; // end admin check ?>
<?php endif; // end is_user_logged_in ?>

<?php get_footer(); ?>

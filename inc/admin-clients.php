<?php
/**
 * Datalkemi Client Management Admin Page
 * WP Admin → Clients
 */

defined( 'ABSPATH' ) || exit;

// ── Register admin menu page ───────────────────────────────────────────────
function datalkemi_register_clients_menu() {
	add_menu_page(
		__( 'Client Management', 'datalkemi' ),
		__( 'Clients', 'datalkemi' ),
		'manage_options',
		'datalkemi-clients',
		'datalkemi_render_clients_page',
		'dashicons-groups',
		26
	);
	add_submenu_page(
		'datalkemi-clients',
		__( 'All Clients', 'datalkemi' ),
		__( 'All Clients', 'datalkemi' ),
		'manage_options',
		'datalkemi-clients',
		'datalkemi_render_clients_page'
	);
	add_submenu_page(
		'datalkemi-clients',
		__( 'Invite Client', 'datalkemi' ),
		__( 'Invite Client', 'datalkemi' ),
		'manage_options',
		'datalkemi-invite-client',
		'datalkemi_render_invite_page'
	);
}
add_action( 'admin_menu', 'datalkemi_register_clients_menu' );

// ── Shared admin styles ────────────────────────────────────────────────────
function datalkemi_clients_admin_styles() {
	$screen = get_current_screen();
	if ( ! $screen || strpos( $screen->id, 'datalkemi' ) === false ) return;
	echo '<style>
		.dk-admin-wrap { max-width:1100px; }
		.dk-admin-wrap h1 { display:flex; align-items:center; gap:.75rem; margin-bottom:1.5rem; }
		.dk-stat-row { display:flex; gap:1rem; margin-bottom:2rem; flex-wrap:wrap; }
		.dk-stat-box { background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:1.25rem 1.75rem; min-width:140px; flex:1; }
		.dk-stat-box strong { display:block; font-size:1.75rem; font-weight:800; color:#0f172a; line-height:1.2; }
		.dk-stat-box span { font-size:0.8125rem; color:#64748b; }
		.dk-client-table { width:100%; border-collapse:collapse; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,.1); }
		.dk-client-table th { background:#f8fafc; padding:.75rem 1rem; text-align:left; font-size:.8125rem; text-transform:uppercase; letter-spacing:.05em; color:#64748b; border-bottom:1px solid #e2e8f0; }
		.dk-client-table td { padding:.875rem 1rem; border-bottom:1px solid #f1f5f9; vertical-align:middle; font-size:.9rem; }
		.dk-client-table tr:last-child td { border-bottom:none; }
		.dk-client-table tr:hover td { background:#f8fafc; }
		.dk-badge { display:inline-block; padding:.2rem .6rem; border-radius:999px; font-size:.75rem; font-weight:600; }
		.dk-badge--active   { background:#dcfce7; color:#166534; }
		.dk-badge--inactive { background:#f1f5f9; color:#64748b; }
		.dk-badge--project  { background:#dbeafe; color:#1e40af; }
		.dk-invite-form { background:#fff; border:1px solid #e2e8f0; border-radius:8px; padding:2rem; max-width:600px; }
		.dk-invite-form table.form-table { margin:0; }
		.dk-invite-form .submit { padding-left:0; }
		.dk-notice-success { background:#f0fdf4; border-left:4px solid #22c55e; padding:1rem 1.25rem; margin-bottom:1.5rem; border-radius:0 6px 6px 0; color:#166534; }
		.dk-notice-error   { background:#fef2f2; border-left:4px solid #ef4444; padding:1rem 1.25rem; margin-bottom:1.5rem; border-radius:0 6px 6px 0; color:#991b1b; }
		.dk-project-list { list-style:none; margin:0; padding:0; display:flex; flex-wrap:wrap; gap:.375rem; }
		.dk-project-list li { background:#eff6ff; color:#1e40af; font-size:.75rem; padding:.2rem .6rem; border-radius:4px; font-weight:500; }
		.dk-action-links a { margin-right:.75rem; font-size:.8125rem; }
		.dk-empty { text-align:center; padding:3rem; color:#94a3b8; }
	</style>';
}
add_action( 'admin_head', 'datalkemi_clients_admin_styles' );

// ── All Clients page ───────────────────────────────────────────────────────
function datalkemi_render_clients_page() {
	$clients = get_users( [ 'role' => 'client', 'orderby' => 'registered', 'order' => 'DESC' ] );

	// Count stats
	$total_clients  = count( $clients );
	$active_clients = 0;
	foreach ( $clients as $c ) {
		$projects = datalkemi_get_client_projects( $c->ID );
		if ( ! empty( $projects ) ) $active_clients++;
	}

	$total_projects = count( get_posts( [ 'post_type' => 'project', 'posts_per_page' => -1, 'post_status' => 'publish' ] ) );

	?>
	<div class="wrap dk-admin-wrap">
		<h1>
			<span class="dashicons dashicons-groups" style="font-size:1.5rem;width:auto;height:auto;"></span>
			<?php esc_html_e( 'Client Management', 'datalkemi' ); ?>
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=datalkemi-invite-client' ) ); ?>"
				class="page-title-action"><?php esc_html_e( 'Invite New Client', 'datalkemi' ); ?></a>
		</h1>

		<!-- Stats -->
		<div class="dk-stat-row">
			<div class="dk-stat-box">
				<strong><?php echo $total_clients; ?></strong>
				<span><?php esc_html_e( 'Total Clients', 'datalkemi' ); ?></span>
			</div>
			<div class="dk-stat-box">
				<strong><?php echo $active_clients; ?></strong>
				<span><?php esc_html_e( 'With Active Projects', 'datalkemi' ); ?></span>
			</div>
			<div class="dk-stat-box">
				<strong><?php echo $total_projects; ?></strong>
				<span><?php esc_html_e( 'Total Projects', 'datalkemi' ); ?></span>
			</div>
		</div>

		<!-- Client table -->
		<?php if ( empty( $clients ) ) : ?>
			<div class="dk-empty">
				<p style="font-size:1.125rem; margin-bottom:.75rem;">No clients yet.</p>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=datalkemi-invite-client' ) ); ?>" class="button button-primary">
					<?php esc_html_e( 'Invite Your First Client', 'datalkemi' ); ?>
				</a>
			</div>
		<?php else : ?>
		<table class="dk-client-table">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Client', 'datalkemi' ); ?></th>
					<th><?php esc_html_e( 'Email', 'datalkemi' ); ?></th>
					<th><?php esc_html_e( 'Joined', 'datalkemi' ); ?></th>
					<th><?php esc_html_e( 'Projects', 'datalkemi' ); ?></th>
					<th><?php esc_html_e( 'Status', 'datalkemi' ); ?></th>
					<th><?php esc_html_e( 'Actions', 'datalkemi' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $clients as $client ) :
					$projects      = datalkemi_get_client_projects( $client->ID );
					$has_projects  = ! empty( $projects );
					$last_login    = get_user_meta( $client->ID, 'dk_last_login', true );
				?>
				<tr>
					<td>
						<strong><?php echo esc_html( $client->display_name ); ?></strong>
						<?php if ( $client->first_name || $client->last_name ) : ?>
							<br><small style="color:#94a3b8;"><?php echo esc_html( trim( $client->first_name . ' ' . $client->last_name ) ); ?></small>
						<?php endif; ?>
					</td>
					<td><a href="mailto:<?php echo esc_attr( $client->user_email ); ?>"><?php echo esc_html( $client->user_email ); ?></a></td>
					<td><?php echo esc_html( date_i18n( 'd M Y', strtotime( $client->user_registered ) ) ); ?></td>
					<td>
						<?php if ( $has_projects ) : ?>
							<ul class="dk-project-list">
								<?php foreach ( $projects as $proj ) : ?>
									<li>
										<a href="<?php echo esc_url( get_edit_post_link( $proj->ID ) ); ?>" style="color:inherit;text-decoration:none;">
											<?php echo esc_html( $proj->post_title ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php else : ?>
							<span style="color:#94a3b8; font-size:.875rem;"><?php esc_html_e( 'No projects', 'datalkemi' ); ?></span>
						<?php endif; ?>
					</td>
					<td>
						<span class="dk-badge <?php echo $has_projects ? 'dk-badge--active' : 'dk-badge--inactive'; ?>">
							<?php echo $has_projects ? esc_html__( 'Active', 'datalkemi' ) : esc_html__( 'Pending', 'datalkemi' ); ?>
						</span>
					</td>
					<td class="dk-action-links">
						<a href="<?php echo esc_url( admin_url( 'user-edit.php?user_id=' . $client->ID ) ); ?>"><?php esc_html_e( 'Edit', 'datalkemi' ); ?></a>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=datalkemi-invite-client&resend=' . $client->ID ) ); ?>"><?php esc_html_e( 'Resend Invite', 'datalkemi' ); ?></a>
						<a href="<?php echo esc_url( admin_url( 'users.php?action=delete&users%5B%5D=' . $client->ID . '&_wpnonce=' . wp_create_nonce( 'bulk-users' ) ) ); ?>"
							style="color:#dc2626;" onclick="return confirm('Remove this client?')"><?php esc_html_e( 'Remove', 'datalkemi' ); ?></a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php endif; ?>
	</div>
	<?php
}

// ── Invite Client page ─────────────────────────────────────────────────────
function datalkemi_render_invite_page() {
	$notice  = '';
	$error   = '';
	$success = false;

	// Handle resend invite
	if ( isset( $_GET['resend'] ) && current_user_can( 'manage_options' ) ) {
		$resend_user = get_user_by( 'ID', absint( $_GET['resend'] ) );
		if ( $resend_user ) {
			datalkemi_send_client_invite_email( $resend_user );
			$notice = sprintf( __( 'Invitation resent to %s.', 'datalkemi' ), '<strong>' . esc_html( $resend_user->user_email ) . '</strong>' );
		}
	}

	// Handle form submission
	if ( isset( $_POST['dk_invite_nonce'] ) && wp_verify_nonce( $_POST['dk_invite_nonce'], 'dk_invite_client' ) ) {
		$first_name = sanitize_text_field( $_POST['first_name'] ?? '' );
		$last_name  = sanitize_text_field( $_POST['last_name']  ?? '' );
		$email      = sanitize_email( $_POST['client_email'] ?? '' );
		$company    = sanitize_text_field( $_POST['company'] ?? '' );
		$send_email = ! empty( $_POST['send_invite_email'] );

		if ( ! $first_name || ! is_email( $email ) ) {
			$error = __( 'First name and a valid email address are required.', 'datalkemi' );
		} elseif ( email_exists( $email ) ) {
			$error = sprintf( __( 'A user with email %s already exists.', 'datalkemi' ), '<strong>' . esc_html( $email ) . '</strong>' );
		} else {
			$username = strtolower( sanitize_user( $first_name . '.' . $last_name, true ) );
			$username = $username ?: strtolower( explode( '@', $email )[0] );
			// Ensure unique username
			$base = $username;
			$i    = 1;
			while ( username_exists( $username ) ) {
				$username = $base . $i++;
			}

			$password = wp_generate_password( 16, true );
			$user_id  = wp_create_user( $username, $password, $email );

			if ( is_wp_error( $user_id ) ) {
				$error = $user_id->get_error_message();
			} else {
				$user = new WP_User( $user_id );
				$user->set_role( 'client' );
				update_user_meta( $user_id, 'first_name',       $first_name );
				update_user_meta( $user_id, 'last_name',        $last_name );
				update_user_meta( $user_id, 'display_name',     $first_name . ' ' . $last_name );
				wp_update_user( [ 'ID' => $user_id, 'display_name' => $first_name . ' ' . $last_name ] );
				if ( $company ) update_user_meta( $user_id, 'company', $company );

				if ( $send_email ) {
					datalkemi_send_client_invite_email( $user );
				}

				$notice  = sprintf(
					__( 'Client account created for %s (%s).%s', 'datalkemi' ),
					'<strong>' . esc_html( $first_name . ' ' . $last_name ) . '</strong>',
					esc_html( $email ),
					$send_email ? ' Invitation email sent.' : ' No invitation email sent (you can resend from the client list).'
				);
				$success = true;
			}
		}
	}
	?>
	<div class="wrap dk-admin-wrap">
		<h1>
			<span class="dashicons dashicons-email-alt" style="font-size:1.5rem;width:auto;height:auto;"></span>
			<?php esc_html_e( 'Invite New Client', 'datalkemi' ); ?>
		</h1>

		<?php if ( $notice ) : ?>
			<div class="dk-notice-<?php echo $success ? 'success' : 'success'; ?>"><?php echo wp_kses_post( $notice ); ?></div>
		<?php endif; ?>
		<?php if ( $error ) : ?>
			<div class="dk-notice-error"><?php echo wp_kses_post( $error ); ?></div>
		<?php endif; ?>

		<?php if ( $success ) : ?>
			<p>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=datalkemi-clients' ) ); ?>" class="button button-primary">
					<?php esc_html_e( 'View All Clients', 'datalkemi' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=datalkemi-invite-client' ) ); ?>" class="button" style="margin-left:.5rem;">
					<?php esc_html_e( 'Invite Another', 'datalkemi' ); ?>
				</a>
			</p>
		<?php else : ?>
		<div class="dk-invite-form">
			<p style="color:#64748b; margin-bottom:1.5rem;"><?php esc_html_e( 'Create a client account and send them an invitation email with a link to set their password and access the portal.', 'datalkemi' ); ?></p>
			<form method="post">
				<?php wp_nonce_field( 'dk_invite_client', 'dk_invite_nonce' ); ?>
				<table class="form-table">
					<tr>
						<th><label for="first_name"><?php esc_html_e( 'First Name *', 'datalkemi' ); ?></label></th>
						<td><input type="text" id="first_name" name="first_name" class="regular-text" required
							value="<?php echo esc_attr( $_POST['first_name'] ?? '' ); ?>"></td>
					</tr>
					<tr>
						<th><label for="last_name"><?php esc_html_e( 'Last Name', 'datalkemi' ); ?></label></th>
						<td><input type="text" id="last_name" name="last_name" class="regular-text"
							value="<?php echo esc_attr( $_POST['last_name'] ?? '' ); ?>"></td>
					</tr>
					<tr>
						<th><label for="client_email"><?php esc_html_e( 'Email Address *', 'datalkemi' ); ?></label></th>
						<td><input type="email" id="client_email" name="client_email" class="regular-text" required
							value="<?php echo esc_attr( $_POST['client_email'] ?? '' ); ?>"></td>
					</tr>
					<tr>
						<th><label for="company"><?php esc_html_e( 'Company', 'datalkemi' ); ?></label></th>
						<td><input type="text" id="company" name="company" class="regular-text"
							placeholder="<?php esc_attr_e( 'Optional', 'datalkemi' ); ?>"
							value="<?php echo esc_attr( $_POST['company'] ?? '' ); ?>"></td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Send Invitation Email', 'datalkemi' ); ?></th>
						<td>
							<label>
								<input type="checkbox" name="send_invite_email" value="1"
									<?php checked( ! isset( $_POST['dk_invite_nonce'] ) || ! empty( $_POST['send_invite_email'] ) ); ?>>
								<?php esc_html_e( 'Send an invitation email with a password setup link', 'datalkemi' ); ?>
							</label>
							<p class="description"><?php esc_html_e( 'The client will receive an email to set their password and access the portal.', 'datalkemi' ); ?></p>
						</td>
					</tr>
				</table>
				<div class="submit">
					<input type="submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Create Client & Send Invite', 'datalkemi' ); ?>">
				</div>
			</form>
		</div>
		<?php endif; ?>

		<hr style="margin:2rem 0;">
		<h2 style="font-size:1rem;"><?php esc_html_e( 'After creating a client account:', 'datalkemi' ); ?></h2>
		<ol style="color:#374151; line-height:2;">
			<li><?php esc_html_e( 'Go to Projects (CPT) → Add New to create a project for this client', 'datalkemi' ); ?></li>
			<li><?php esc_html_e( 'In the sidebar meta box "Client Portal Settings", assign the project to their account', 'datalkemi' ); ?></li>
			<li><?php esc_html_e( 'Set the project status, progress %, start date, and deadline', 'datalkemi' ); ?></li>
			<li><?php esc_html_e( 'The client logs in at /client-portal/ and sees their projects instantly', 'datalkemi' ); ?></li>
		</ol>
	</div>
	<?php
}

// ── Send invitation email ──────────────────────────────────────────────────
function datalkemi_send_client_invite_email( WP_User $user ): void {
	$reset_key  = get_password_reset_key( $user );
	if ( is_wp_error( $reset_key ) ) return;

	$reset_url  = add_query_arg( [
		'action' => 'rp',
		'key'    => $reset_key,
		'login'  => rawurlencode( $user->user_login ),
	], wp_login_url() );

	$portal_url = home_url( '/client-portal/' );
	$site_name  = get_bloginfo( 'name' );
	$first_name = get_user_meta( $user->ID, 'first_name', true ) ?: $user->display_name;

	$subject = sprintf( __( 'Your %s client portal is ready', 'datalkemi' ), $site_name );

	$body  = "Hi {$first_name},\n\n";
	$body .= "Your Datalkemi client portal account has been created.\n\n";
	$body .= "You can use the portal to track your project progress, access documents, and get support.\n\n";
	$body .= "Set your password and access your portal:\n";
	$body .= $reset_url . "\n\n";
	$body .= "This link expires in 24 hours. Once you have set your password, log in at:\n";
	$body .= $portal_url . "\n\n";
	$body .= "If you have any questions, just reply to this email.\n\n";
	$body .= "The Datalkemi Team\nhttps://datalkemi.com\n";

	$headers = [
		'Content-Type: text/plain; charset=UTF-8',
		'From: Datalkemi <' . get_option( 'admin_email' ) . '>',
	];

	wp_mail( $user->user_email, $subject, $body, $headers );
}

// ── Track last login time ──────────────────────────────────────────────────
function datalkemi_track_client_login( string $user_login, WP_User $user ): void {
	if ( in_array( 'client', (array) $user->roles, true ) ) {
		update_user_meta( $user->ID, 'dk_last_login', current_time( 'mysql' ) );
	}
}
add_action( 'wp_login', 'datalkemi_track_client_login', 10, 2 );

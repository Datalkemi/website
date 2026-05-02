<?php
/**
 * Client Portal role management, helpers, and admin meta boxes.
 */

defined( 'ABSPATH' ) || exit;

// ── Create 'client' user role ───────────────────────────────────────────────
function datalkemi_register_client_role() {
	if ( ! get_role( 'client' ) ) {
		add_role( 'client', __( 'Client', 'datalkemi' ), [
			'read'         => true,
			'upload_files' => false,
			'edit_posts'   => false,
		] );
	}
}
add_action( 'init', 'datalkemi_register_client_role' );

// ── Redirect client users away from wp-admin ───────────────────────────────
function datalkemi_client_admin_redirect() {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		$user = wp_get_current_user();
		if ( in_array( 'client', (array) $user->roles, true ) ) {
			wp_safe_redirect( home_url( '/client-portal/' ) );
			exit;
		}
	}
}
add_action( 'admin_init', 'datalkemi_client_admin_redirect' );

// ── Redirect client users after login ──────────────────────────────────────
function datalkemi_client_login_redirect( string $redirect_to, $request, $user ): string {
	if ( $user instanceof WP_User && in_array( 'client', (array) $user->roles, true ) ) {
		return home_url( '/client-portal/' );
	}
	return $redirect_to;
}
add_filter( 'login_redirect', 'datalkemi_client_login_redirect', 10, 3 );

// ── Get projects assigned to a client ──────────────────────────────────────
function datalkemi_get_client_projects( int $user_id ): array {
	$args = [
		'post_type'      => 'project',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'meta_query'     => [
			[
				'key'   => '_assigned_client',
				'value' => $user_id,
			],
		],
	];
	$query = new WP_Query( $args );
	return $query->posts;
}

// ── Get project status label and colour ────────────────────────────────────
function datalkemi_project_status( string $status ): array {
	$statuses = [
		'discovery'   => [ 'label' => 'Discovery',    'color' => '#a855f7' ],
		'in-progress' => [ 'label' => 'In Progress',  'color' => '#0284c7' ],
		'review'      => [ 'label' => 'In Review',    'color' => '#f59e0b' ],
		'complete'    => [ 'label' => 'Complete',      'color' => '#22c55e' ],
		'on-hold'     => [ 'label' => 'On Hold',       'color' => '#6b7280' ],
	];
	return $statuses[ $status ] ?? [ 'label' => ucfirst( $status ), 'color' => '#6b7280' ];
}

// ── Admin: Project meta box for client assignment ──────────────────────────
function datalkemi_project_meta_boxes() {
	add_meta_box(
		'datalkemi_client_assignment',
		__( 'Client Portal Settings', 'datalkemi' ),
		'datalkemi_render_client_meta_box',
		'project',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'datalkemi_project_meta_boxes' );

function datalkemi_render_client_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'datalkemi_client_meta', 'datalkemi_client_meta_nonce' );

	$assigned_client  = get_post_meta( $post->ID, '_assigned_client', true );
	$project_status   = get_post_meta( $post->ID, '_project_status', true ) ?: 'in-progress';
	$project_progress = get_post_meta( $post->ID, '_project_progress', true ) ?: 0;
	$live_url         = get_post_meta( $post->ID, '_project_live_url', true );
	$tech_stack       = get_post_meta( $post->ID, '_project_tech_stack', true );
	$project_category = get_post_meta( $post->ID, '_project_category', true );
	$start_date       = get_post_meta( $post->ID, '_project_start_date', true );
	$end_date         = get_post_meta( $post->ID, '_project_end_date', true );

	// Fetch client users
	$clients = get_users( [ 'role' => 'client', 'number' => 100 ] );
	?>
	<p style="margin-bottom:8px;"><strong><?php esc_html_e( 'Assign to Client:', 'datalkemi' ); ?></strong></p>
	<select name="datalkemi_assigned_client" style="width:100%; margin-bottom:12px;">
		<option value=""><?php esc_html_e( '- No client -', 'datalkemi' ); ?></option>
		<?php foreach ( $clients as $client ) : ?>
			<option value="<?php echo esc_attr( $client->ID ); ?>" <?php selected( $assigned_client, $client->ID ); ?>>
				<?php echo esc_html( $client->display_name . ' (' . $client->user_email . ')' ); ?>
			</option>
		<?php endforeach; ?>
	</select>

	<p style="margin-bottom:4px;"><strong><?php esc_html_e( 'Project Status:', 'datalkemi' ); ?></strong></p>
	<select name="datalkemi_project_status" style="width:100%; margin-bottom:12px;">
		<?php foreach ( [ 'discovery', 'in-progress', 'review', 'complete', 'on-hold' ] as $s ) :
			$info = datalkemi_project_status( $s );
		?>
			<option value="<?php echo esc_attr( $s ); ?>" <?php selected( $project_status, $s ); ?>>
				<?php echo esc_html( $info['label'] ); ?>
			</option>
		<?php endforeach; ?>
	</select>

	<p style="margin-bottom:4px;"><strong><?php esc_html_e( 'Progress (%):', 'datalkemi' ); ?></strong></p>
	<input type="number" name="datalkemi_project_progress" value="<?php echo esc_attr( $project_progress ); ?>"
		min="0" max="100" style="width:100%; margin-bottom:12px;" />

	<p style="margin-bottom:4px;"><strong><?php esc_html_e( 'Category:', 'datalkemi' ); ?></strong></p>
	<input type="text" name="datalkemi_project_category" value="<?php echo esc_attr( $project_category ); ?>"
		placeholder="e.g. Web Development" style="width:100%; margin-bottom:12px;" />

	<p style="margin-bottom:4px;"><strong><?php esc_html_e( 'Live URL:', 'datalkemi' ); ?></strong></p>
	<input type="url" name="datalkemi_project_live_url" value="<?php echo esc_attr( $live_url ); ?>"
		placeholder="https://..." style="width:100%; margin-bottom:12px;" />

	<p style="margin-bottom:4px;"><strong><?php esc_html_e( 'Tech Stack (comma-separated):', 'datalkemi' ); ?></strong></p>
	<input type="text" name="datalkemi_project_tech_stack" value="<?php echo esc_attr( $tech_stack ); ?>"
		placeholder="React, WordPress, Python" style="width:100%; margin-bottom:12px;" />

	<p style="margin-bottom:4px;"><strong><?php esc_html_e( 'Start Date:', 'datalkemi' ); ?></strong></p>
	<input type="date" name="datalkemi_project_start_date" value="<?php echo esc_attr( $start_date ); ?>"
		style="width:100%; margin-bottom:12px;" />

	<p style="margin-bottom:4px;"><strong><?php esc_html_e( 'End Date / Deadline:', 'datalkemi' ); ?></strong></p>
	<input type="date" name="datalkemi_project_end_date" value="<?php echo esc_attr( $end_date ); ?>"
		style="width:100%; margin-bottom:12px;" />
	<?php
}

function datalkemi_save_client_meta( int $post_id ): void {
	if (
		! isset( $_POST['datalkemi_client_meta_nonce'] ) ||
		! wp_verify_nonce( $_POST['datalkemi_client_meta_nonce'], 'datalkemi_client_meta' ) ||
		( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ||
		! current_user_can( 'edit_post', $post_id )
	) {
		return;
	}

	$fields = [
		'datalkemi_assigned_client'   => '_assigned_client',
		'datalkemi_project_status'    => '_project_status',
		'datalkemi_project_progress'  => '_project_progress',
		'datalkemi_project_category'  => '_project_category',
		'datalkemi_project_live_url'  => '_project_live_url',
		'datalkemi_project_tech_stack'=> '_project_tech_stack',
		'datalkemi_project_start_date'=> '_project_start_date',
		'datalkemi_project_end_date'  => '_project_end_date',
	];

	foreach ( $fields as $post_key => $meta_key ) {
		if ( isset( $_POST[ $post_key ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $post_key ] ) );
		}
	}
}
add_action( 'save_post_project', 'datalkemi_save_client_meta' );

// ── Admin: Team member meta box ─────────────────────────────────────────────
function datalkemi_team_meta_boxes() {
	add_meta_box(
		'datalkemi_team_meta',
		__( 'Team Member Details', 'datalkemi' ),
		'datalkemi_render_team_meta_box',
		'team_member',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'datalkemi_team_meta_boxes' );

function datalkemi_render_team_meta_box( WP_Post $post ): void {
	wp_nonce_field( 'datalkemi_team_meta', 'datalkemi_team_meta_nonce' );

	$role       = get_post_meta( $post->ID, '_team_role', true );
	$linkedin   = get_post_meta( $post->ID, '_team_linkedin', true );
	$twitter    = get_post_meta( $post->ID, '_team_twitter', true );
	$github     = get_post_meta( $post->ID, '_team_github', true );
	$order      = get_post_meta( $post->ID, '_team_order', true );
	?>
	<p><strong><?php esc_html_e( 'Job Title / Role:', 'datalkemi' ); ?></strong></p>
	<input type="text" name="datalkemi_team_role" value="<?php echo esc_attr( $role ); ?>"
		placeholder="e.g. Lead Developer" style="width:100%; margin-bottom:10px;" />

	<p><strong><?php esc_html_e( 'LinkedIn URL:', 'datalkemi' ); ?></strong></p>
	<input type="url" name="datalkemi_team_linkedin" value="<?php echo esc_attr( $linkedin ); ?>"
		placeholder="https://linkedin.com/in/..." style="width:100%; margin-bottom:10px;" />

	<p><strong><?php esc_html_e( 'GitHub URL:', 'datalkemi' ); ?></strong></p>
	<input type="url" name="datalkemi_team_github" value="<?php echo esc_attr( $github ); ?>"
		placeholder="https://github.com/..." style="width:100%; margin-bottom:10px;" />

	<p><strong><?php esc_html_e( 'Twitter/X URL:', 'datalkemi' ); ?></strong></p>
	<input type="url" name="datalkemi_team_twitter" value="<?php echo esc_attr( $twitter ); ?>"
		placeholder="https://x.com/..." style="width:100%; margin-bottom:10px;" />

	<p><strong><?php esc_html_e( 'Display Order:', 'datalkemi' ); ?></strong></p>
	<input type="number" name="datalkemi_team_order" value="<?php echo esc_attr( $order ); ?>"
		placeholder="1" style="width:100%;" />
	<?php
}

function datalkemi_save_team_meta( int $post_id ): void {
	if (
		! isset( $_POST['datalkemi_team_meta_nonce'] ) ||
		! wp_verify_nonce( $_POST['datalkemi_team_meta_nonce'], 'datalkemi_team_meta' ) ||
		( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ||
		! current_user_can( 'edit_post', $post_id )
	) {
		return;
	}

	$fields = [
		'datalkemi_team_role'     => '_team_role',
		'datalkemi_team_linkedin' => '_team_linkedin',
		'datalkemi_team_github'   => '_team_github',
		'datalkemi_team_twitter'  => '_team_twitter',
		'datalkemi_team_order'    => '_team_order',
	];

	foreach ( $fields as $post_key => $meta_key ) {
		if ( isset( $_POST[ $post_key ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $post_key ] ) );
		}
	}
}
add_action( 'save_post_team_member', 'datalkemi_save_team_meta' );

// ── AJAX: handle login from client portal ──────────────────────────────────
function datalkemi_portal_login_shortcode(): string {
	if ( is_user_logged_in() ) {
		return '';
	}
	ob_start();
	$args = [
		'redirect'       => home_url( '/client-portal/' ),
		'form_id'        => 'dk-login-form',
		'label_username' => __( 'Email Address', 'datalkemi' ),
		'label_password' => __( 'Password', 'datalkemi' ),
		'label_remember' => __( 'Keep me signed in', 'datalkemi' ),
		'label_log_in'   => __( 'Sign In to Portal', 'datalkemi' ),
		'remember'       => true,
	];
	wp_login_form( $args );
	return ob_get_clean();
}
add_shortcode( 'dk_login_form', 'datalkemi_portal_login_shortcode' );

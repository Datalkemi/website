<?php
/**
 * Individual project / case study template.
 */
get_header();

$category   = get_post_meta( get_the_ID(), '_project_category', true );
$live_url   = get_post_meta( get_the_ID(), '_project_live_url', true );
$tech_stack = get_post_meta( get_the_ID(), '_project_tech_stack', true );
$start_date = get_post_meta( get_the_ID(), '_project_start_date', true );
$end_date   = get_post_meta( get_the_ID(), '_project_end_date', true );
$hosting    = get_post_meta( get_the_ID(), '_project_hosting', true );

// Hero icon by project type (line icons, no background image in the hero)
$type_terms = get_the_terms( get_the_ID(), 'project_type' );
$type_slug  = ( $type_terms && ! is_wp_error( $type_terms ) ) ? $type_terms[0]->slug : '';
$icon_attr  = 'xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';
switch ( $type_slug ) {
	case 'data-science':
		$hero_icon = '<svg ' . $icon_attr . '><path d="M3 3v18h18"/><path d="M7 14l4-4 4 3 5-6"/></svg>';
		break;
	case 'web-application':
		$hero_icon = '<svg ' . $icon_attr . '><rect x="3" y="4" width="18" height="16" rx="1"/><path d="M3 9h18"/><path d="M7 14h5M7 17h8"/></svg>';
		break;
	default:
		$hero_icon = '<svg ' . $icon_attr . '><circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></svg>';
}

// Related projects (excluding current)
$related = new WP_Query( [
	'post_type'      => 'project',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'post__not_in'   => [ get_the_ID() ],
] );
?>

<!-- Project Hero -->
<section class="service-hero">
	<div class="service-hero-overlay"></div>
	<div class="dk-container service-hero-content" style="position:relative; z-index:2;">
		<span class="project-hero-icon"><?php echo $hero_icon; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<div class="service-hero-breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datalkemi' ); ?></a>
			<span>&#8250;</span>
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Projects', 'datalkemi' ); ?></a>
			<span>&#8250;</span>
			<span><?php the_title(); ?></span>
		</div>
		<?php if ( $category ) : ?>
			<p class="project-category" style="font-size:0.875rem; margin-bottom:0.75rem;"><?php echo esc_html( $category ); ?></p>
		<?php endif; ?>
		<h1 class="service-hero-title"><?php the_title(); ?></h1>
		<p class="service-hero-tagline"><?php the_excerpt(); ?></p>
		<?php if ( $live_url ) : ?>
			<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer" class="dk-btn dk-btn-primary">
				<?php esc_html_e( 'View Live Project &#8599;', 'datalkemi' ); ?>
			</a>
		<?php endif; ?>
	</div>
</section>

<!-- Project body -->
<section class="dk-section">
	<div class="dk-container">
		<div class="project-single-layout">

			<!-- Main content -->
			<div class="project-single-content">
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="project-figure">
						<?php the_post_thumbnail( 'large' ); ?>
					</figure>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>

			<!-- Sidebar -->
			<aside class="project-single-sidebar">

				<div class="dk-glass" style="padding:1.75rem; margin-bottom:1.5rem;">
					<h3 style="font-size:1rem; font-weight:500; color:var(--text); margin-bottom:1.25rem;">
						<?php esc_html_e( 'Project Details', 'datalkemi' ); ?>
					</h3>
					<ul class="project-detail-list">
						<?php if ( $category ) : ?>
							<li class="project-detail-item">
								<span class="project-detail-label"><?php esc_html_e( 'Type', 'datalkemi' ); ?></span>
								<span class="project-detail-value"><?php echo esc_html( $category ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( $start_date ) : ?>
							<li class="project-detail-item">
								<span class="project-detail-label"><?php esc_html_e( 'Started', 'datalkemi' ); ?></span>
								<span class="project-detail-value"><?php echo esc_html( date_i18n( 'F Y', strtotime( $start_date ) ) ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( $end_date ) : ?>
							<li class="project-detail-item">
								<span class="project-detail-label"><?php esc_html_e( 'Delivered', 'datalkemi' ); ?></span>
								<span class="project-detail-value"><?php echo esc_html( date_i18n( 'F Y', strtotime( $end_date ) ) ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( $hosting ) : ?>
							<li class="project-detail-item">
								<span class="project-detail-label"><?php esc_html_e( 'Hosting', 'datalkemi' ); ?></span>
								<span class="project-detail-value"><?php echo esc_html( $hosting ); ?></span>
							</li>
						<?php endif; ?>
					</ul>
				</div>

				<?php if ( $tech_stack ) : ?>
					<div class="dk-glass" style="padding:1.75rem; margin-bottom:1.5rem;">
						<h3 style="font-size:1rem; font-weight:500; color:var(--text); margin-bottom:1rem;">
							<?php esc_html_e( 'Technology Used', 'datalkemi' ); ?>
						</h3>
						<div class="tech-tags">
							<?php foreach ( explode( ',', $tech_stack ) as $tech ) : ?>
								<span class="tech-tag"><?php echo esc_html( trim( $tech ) ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="dk-glass" style="padding:1.75rem; text-align:center;">
					<p style="color:var(--text); font-weight:600; margin-bottom:0.75rem; font-size:0.9375rem;">
						<?php esc_html_e( 'Need something similar?', 'datalkemi' ); ?>
					</p>
					<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary" style="width:100%;">
						<?php esc_html_e( 'Start Your Project', 'datalkemi' ); ?>
					</a>
				</div>

			</aside>
		</div>
	</div>
</section>

<!-- Related projects -->
<?php if ( $related->have_posts() ) : ?>
<section class="dk-section" style="background:var(--bg);">
	<div class="dk-container">
		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'More Work', 'datalkemi' ); ?></span>
		</div>
		<div class="dk-grid-3">
			<?php while ( $related->have_posts() ) : $related->the_post();
				$cat = get_post_meta( get_the_ID(), '_project_category', true );
			?>
				<a href="<?php the_permalink(); ?>" class="dk-card" style="text-decoration:none !important; display:block;">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="project-thumbnail"><?php the_post_thumbnail( 'medium_large' ); ?></div>
					<?php endif; ?>
					<?php if ( $cat ) : ?>
						<p class="project-category"><?php echo esc_html( $cat ); ?></p>
					<?php endif; ?>
					<h3 class="project-title"><?php the_title(); ?></h3>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div style="text-align:center; margin-top:2.5rem;">
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="dk-btn dk-btn-outline">
				<?php esc_html_e( 'View All Projects', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>
<?php endif; ?>

<?php get_footer(); ?>

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

// Related projects (excluding current)
$related = new WP_Query( [
	'post_type'      => 'project',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'post__not_in'   => [ get_the_ID() ],
] );
?>

<!-- Project Hero -->
<section class="service-hero" style="min-height:60vh;">
	<div class="service-hero-overlay"></div>
	<?php if ( has_post_thumbnail() ) : ?>
		<div style="position:absolute; inset:0; z-index:0;">
			<?php the_post_thumbnail( 'full', [ 'style' => 'width:100%; height:100%; object-fit:cover; opacity:0.25;' ] ); ?>
		</div>
	<?php endif; ?>
	<div class="dk-container service-hero-content" style="position:relative; z-index:2;">
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
				<?php the_content(); ?>
			</div>

			<!-- Sidebar -->
			<aside class="project-single-sidebar">

				<div class="dk-glass" style="padding:1.75rem; margin-bottom:1.5rem;">
					<h3 style="font-size:1rem; font-weight:700; color:#f9fafb; margin-bottom:1.25rem;">
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
					</ul>
				</div>

				<?php if ( $tech_stack ) : ?>
					<div class="dk-glass" style="padding:1.75rem; margin-bottom:1.5rem;">
						<h3 style="font-size:1rem; font-weight:700; color:#f9fafb; margin-bottom:1rem;">
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
					<p style="color:#f9fafb; font-weight:600; margin-bottom:0.75rem; font-size:0.9375rem;">
						<?php esc_html_e( 'Need something similar?', 'datalkemi' ); ?>
					</p>
					<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary" style="width:100%; justify-content:center;">
						<?php esc_html_e( 'Start Your Project', 'datalkemi' ); ?>
					</a>
				</div>

			</aside>
		</div>
	</div>
</section>

<!-- Related projects -->
<?php if ( $related->have_posts() ) : ?>
<section class="dk-section" style="background:rgba(17,24,39,0.95);">
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

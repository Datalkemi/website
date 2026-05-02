<?php
/**
 * Single service page in-depth service template.
 */
get_header();

$service_slug = get_post_field( 'post_name', get_the_ID() );
$data         = datalkemi_get_service_data( $service_slug );

$related_projects = new WP_Query( [
	'post_type'      => 'project',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
] );
?>

<!-- Service Hero -->
<section class="service-hero">
	<div class="service-hero-overlay"></div>
	<div class="dk-container service-hero-content">
		<nav class="service-hero-breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<span>/</span>
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a>
			<span>/</span>
			<span><?php the_title(); ?></span>
		</nav>
		<h1 class="service-hero-title"><?php the_title(); ?></h1>
		<?php if ( ! empty( $data['tagline'] ) ) : ?>
			<p class="service-hero-tagline"><?php echo esc_html( $data['tagline'] ); ?></p>
		<?php endif; ?>
		<div class="hero-buttons">
			<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary">
				Configure Your Project
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline">
				Talk to Us First
			</a>
		</div>
	</div>
</section>

<!-- Overview + Features -->
<section class="dk-section service-overview-section">
	<div class="dk-container">
		<div class="dk-grid-2" style="gap:4rem; align-items:start;">
			<div class="service-content-body">
				<?php if ( get_the_content() ) : ?>
					<?php the_content(); ?>
				<?php elseif ( ! empty( $data['overview'] ) ) : ?>
					<p class="about-text" style="font-size:1.0625rem !important; line-height:1.9 !important;">
						<?php echo esc_html( $data['overview'] ); ?>
					</p>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $data['features'] ) ) : ?>
			<div class="dk-glass" style="padding:2rem;">
				<h3 style="font-size:0.875rem; font-weight:700; color:#f9fafb; margin-bottom:1.25rem; text-transform:uppercase; letter-spacing:0.08em;">What is included</h3>
				<ul class="feature-list">
					<?php foreach ( $data['features'] as $feature ) : ?>
						<li class="feature-item">
							<span class="feature-check">&#10003;</span>
							<span class="feature-text"><?php echo esc_html( $feature ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- Problem + Approach -->
<?php if ( ! empty( $data['problem'] ) || ! empty( $data['approach'] ) ) : ?>
<section class="dk-section" style="background:rgba(17,24,39,0.95);">
	<div class="dk-container">
		<div class="dk-grid-2" style="gap:4rem; align-items:start;">
			<?php if ( ! empty( $data['problem'] ) ) : ?>
			<div>
				<p class="section-eyebrow" style="margin-bottom:0.75rem;">The Problem</p>
				<h2 style="font-size:1.625rem; font-weight:800; color:#f9fafb; margin-bottom:1.5rem; line-height:1.25;">
					<?php echo esc_html( $data['problem']['headline'] ); ?>
				</h2>
				<?php foreach ( $data['problem']['points'] as $pt ) : ?>
				<div style="display:flex; gap:1rem; margin-bottom:1.125rem; align-items:flex-start;">
					<span style="color:#ef4444; font-size:1rem; flex-shrink:0; margin-top:0.15rem;">&#215;</span>
					<p style="color:#9ca3af; font-size:0.9375rem; line-height:1.75; margin:0;"><?php echo esc_html( $pt ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
			<?php if ( ! empty( $data['approach'] ) ) : ?>
			<div>
				<p class="section-eyebrow" style="margin-bottom:0.75rem;">Our Approach</p>
				<h2 style="font-size:1.625rem; font-weight:800; color:#f9fafb; margin-bottom:1.5rem; line-height:1.25;">
					<?php echo esc_html( $data['approach']['headline'] ); ?>
				</h2>
				<?php foreach ( $data['approach']['points'] as $pt ) : ?>
				<div style="display:flex; gap:1rem; margin-bottom:1.125rem; align-items:flex-start;">
					<span style="color:#4ade80; font-size:1rem; flex-shrink:0; margin-top:0.15rem;">&#10003;</span>
					<p style="color:#9ca3af; font-size:0.9375rem; line-height:1.75; margin:0;"><?php echo esc_html( $pt ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Process -->
<?php if ( ! empty( $data['process'] ) ) : ?>
<section class="dk-section process-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow">How It Works</p>
			<span class="dk-section-title">The Delivery Process</span>
			<p class="dk-section-subtitle">Structured milestones, clear communication, no guesswork.</p>
		</div>
		<div class="process-steps-grid">
			<?php foreach ( $data['process'] as $step ) : ?>
			<div class="process-card dk-glass">
				<span class="process-card-number"><?php echo esc_html( $step['step'] ); ?></span>
				<h3 class="process-card-title"><?php echo esc_html( $step['title'] ); ?></h3>
				<p class="process-card-desc"><?php echo esc_html( $step['desc'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Results -->
<?php if ( ! empty( $data['results'] ) ) : ?>
<section class="dk-section" style="background:var(--color-bg); padding:4rem 0;">
	<div class="dk-container">
		<div class="dk-section-header" style="margin-bottom:2.5rem;">
			<p class="section-eyebrow">Typical Outcomes</p>
			<span class="dk-section-title">What Our Clients See</span>
		</div>
		<div class="outcomes-grid">
			<?php foreach ( $data['results'] as $result ) : ?>
			<div class="outcome-card dk-glass">
				<div class="outcome-metric"><?php echo esc_html( $result['metric'] ); ?></div>
				<div class="outcome-label"><?php echo esc_html( $result['label'] ); ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Related projects -->
<?php if ( $related_projects->have_posts() ) : ?>
<section class="dk-section" style="background:rgba(17,24,39,0.95);">
	<div class="dk-container">
		<div class="dk-section-header">
			<span class="dk-section-title">Work We Have Done</span>
		</div>
		<div class="dk-grid-3">
			<?php while ( $related_projects->have_posts() ) : $related_projects->the_post();
				$category = get_post_meta( get_the_ID(), '_project_category', true );
			?>
			<a href="<?php the_permalink(); ?>" class="dk-card" style="text-decoration:none !important;">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="project-thumbnail"><?php the_post_thumbnail( 'medium_large' ); ?></div>
				<?php endif; ?>
				<?php if ( $category ) : ?>
					<p class="project-category"><?php echo esc_html( $category ); ?></p>
				<?php endif; ?>
				<h3 class="project-title"><?php the_title(); ?></h3>
				<p class="project-desc"><?php the_excerpt(); ?></p>
			</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<div style="text-align:center; margin-top:2.5rem;">
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="dk-btn dk-btn-outline">View All Projects</a>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Pricing / Configurator -->
<section class="dk-section" style="background:var(--color-bg); padding:4rem 0;">
	<div class="dk-container">
		<div class="config-promo">
			<div class="config-promo-text">
				<p class="section-eyebrow">Pricing</p>
				<h2 style="font-size:clamp(1.5rem,3.5vw,2.25rem); font-weight:800; color:#f9fafb; margin-bottom:0.75rem; line-height:1.25;">
					Configure your project, price it instantly
				</h2>
				<p style="color:#9ca3af; font-size:1rem; max-width:32rem; line-height:1.75;">
					Select only the components your project needs. Your estimate updates in real time, and we follow up with a full written proposal.
				</p>
			</div>
			<div class="config-promo-action">
				<a href="<?php echo esc_url( home_url( '/build-your-project/?service=' . $service_slug ) ); ?>" class="dk-btn dk-btn-primary" style="font-size:1rem; padding:0.9rem 2rem;">
					Open Configurator
				</a>
			</div>
		</div>
	</div>
</section>

<!-- FAQ -->
<?php if ( ! empty( $data['faqs'] ) ) : ?>
<section class="dk-section faq-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<span class="dk-section-title">Frequently Asked Questions</span>
		</div>
		<div class="faq-list">
			<?php foreach ( $data['faqs'] as $i => $faq ) : ?>
			<div class="faq-item" id="faq-<?php echo esc_attr( $i ); ?>">
				<button class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo esc_attr( $i ); ?>">
					<span><?php echo esc_html( $faq['q'] ); ?></span>
					<span class="faq-icon">&#43;</span>
				</button>
				<div class="faq-answer" id="faq-answer-<?php echo esc_attr( $i ); ?>" hidden>
					<p><?php echo esc_html( $faq['a'] ); ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title">Ready to start your <?php the_title(); ?> project?</h2>
			<p class="cta-banner-subtitle">Configure online and get an instant estimate, or book a free 30-minute call to talk through your requirements.</p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary">Configure Your Project</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline" style="border-color:#fff; color:#fff;">Book a Free Call</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

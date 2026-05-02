<?php
/**
 * Individual service page template.
 * Pulls content from the Service CPT post + inc/service-data.php.
 */
get_header();

$service_slug = get_post_field( 'post_name', get_the_ID() );
$data         = datalkemi_get_service_data( $service_slug );

// Related projects
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
		<div class="service-hero-breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datalkemi' ); ?></a>
			<span>&#8250;</span>
			<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'datalkemi' ); ?></a>
			<span>&#8250;</span>
			<span><?php the_title(); ?></span>
		</div>
		<div class="service-hero-icon"><?php echo isset( $data['icon'] ) ? $data['icon'] : '&#9998;'; ?></div>
		<h1 class="service-hero-title"><?php the_title(); ?></h1>
		<?php if ( ! empty( $data['tagline'] ) ) : ?>
			<p class="service-hero-tagline"><?php echo esc_html( $data['tagline'] ); ?></p>
		<?php endif; ?>
		<div class="hero-buttons">
			<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary">
				<?php esc_html_e( 'Get a Quote', 'datalkemi' ); ?>
			</a>
			<a href="#pricing" class="dk-btn dk-btn-outline">
				<?php esc_html_e( 'View Pricing', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>

<!-- Overview / Post Content -->
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

			<!-- Features list -->
			<?php if ( ! empty( $data['features'] ) ) : ?>
				<div class="dk-glass" style="padding:2rem;">
					<h3 style="font-size:1.125rem; font-weight:700; color:#f9fafb; margin-bottom:1.25rem;">
						<?php esc_html_e( "What's Included", 'datalkemi' ); ?>
					</h3>
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

<!-- Process steps -->
<?php if ( ! empty( $data['process'] ) ) : ?>
<section class="dk-section process-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'How It Works', 'datalkemi' ); ?></p>
			<span class="dk-section-title"><?php esc_html_e( 'Our Delivery Process', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle">
				<?php esc_html_e( 'A clear, structured process that keeps you informed and in control at every stage.', 'datalkemi' ); ?>
			</p>
		</div>
		<div class="process-steps-grid">
			<?php foreach ( $data['process'] as $step ) : ?>
				<div class="process-card">
					<span class="process-card-number"><?php echo esc_html( $step['step'] ); ?></span>
					<h3 class="process-card-title"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="process-card-desc"><?php echo esc_html( $step['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Pricing tables -->
<?php if ( ! empty( $data['pricing'] ) ) : ?>
<section class="dk-section pricing-section" id="pricing">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'Transparent Pricing', 'datalkemi' ); ?></p>
			<span class="dk-section-title"><?php esc_html_e( 'Choose Your Plan', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle">
				<?php esc_html_e( 'No hidden costs, no surprises. Every price reflects the full scope of work. Enterprise? Contact us for a custom quote.', 'datalkemi' ); ?>
			</p>
		</div>
		<div class="pricing-grid">
			<?php foreach ( $data['pricing'] as $tier ) :
				$is_featured = ! empty( $tier['featured'] );
			?>
				<div class="pricing-card<?php echo $is_featured ? ' pricing-card--featured' : ''; ?>">
					<?php if ( $is_featured ) : ?>
						<div class="pricing-badge"><?php esc_html_e( 'Most Popular', 'datalkemi' ); ?></div>
					<?php endif; ?>
					<h3 class="pricing-tier-name"><?php echo esc_html( $tier['name'] ); ?></h3>
					<div class="pricing-price-block">
						<span class="pricing-price"><?php echo esc_html( $tier['price'] ); ?></span>
						<?php if ( $tier['period'] !== 'quote' ) : ?>
							<span class="pricing-period"><?php echo esc_html( $tier['period'] ); ?></span>
						<?php endif; ?>
					</div>
					<p class="pricing-desc"><?php echo esc_html( $tier['desc'] ); ?></p>
					<ul class="pricing-features">
						<?php foreach ( $tier['features'] as $feature ) : ?>
							<li>
								<span class="pricing-check">&#10003;</span>
								<?php echo esc_html( $feature ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo esc_url( home_url( '/get-a-quote/?service=' . $service_slug . '&tier=' . strtolower( $tier['name'] ) ) ); ?>"
						class="dk-btn <?php echo $is_featured ? 'dk-btn-primary' : 'dk-btn-outline'; ?> pricing-cta">
						<?php echo esc_html( $tier['cta'] ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<p class="pricing-footnote">
			&#128204; <?php esc_html_e( 'All prices exclusive of VAT. Payment terms and instalments available. Contact us to discuss your specific requirements.', 'datalkemi' ); ?>
		</p>
	</div>
</section>
<?php endif; ?>

<!-- Related Projects -->
<?php if ( $related_projects->have_posts() ) : ?>
<section class="dk-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Recent Work', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( "A selection of projects we've delivered. See what's possible.", 'datalkemi' ); ?></p>
		</div>
		<div class="dk-grid-3">
			<?php while ( $related_projects->have_posts() ) : $related_projects->the_post();
				$category = get_post_meta( get_the_ID(), '_project_category', true );
				$live_url = get_post_meta( get_the_ID(), '_project_live_url', true );
			?>
				<a href="<?php the_permalink(); ?>" class="dk-card project-card-link" style="text-decoration:none !important;">
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
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="dk-btn dk-btn-outline">
				<?php esc_html_e( 'View All Projects', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- FAQs -->
<?php if ( ! empty( $data['faqs'] ) ) : ?>
<section class="dk-section faq-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Frequently Asked Questions', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( "Everything you need to know before getting started. Can't find your answer? Just ask us.", 'datalkemi' ); ?></p>
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
		<p style="text-align:center; margin-top:2rem;" class="dk-section-subtitle">
			<?php esc_html_e( 'Still have questions?', 'datalkemi' ); ?>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color:var(--color-primary) !important;">
				<?php esc_html_e( 'Contact us', 'datalkemi' ); ?>
			</a>
			<?php esc_html_e( 'and we\'ll be happy to help.', 'datalkemi' ); ?>
		</p>
	</div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title"><?php printf( esc_html__( "Ready to Get Started with %s?", 'datalkemi' ), get_the_title() ); ?></h2>
			<p class="cta-banner-subtitle"><?php esc_html_e( "Tell us about your project and we'll put together a detailed proposal within 48 hours.", 'datalkemi' ); ?></p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/get-a-quote/?service=' . $service_slug ) ); ?>" class="dk-btn dk-btn-primary">
				<?php esc_html_e( 'Request a Proposal', 'datalkemi' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline" style="border-color:#fff; color:#fff;">
				<?php esc_html_e( 'Ask a Question', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

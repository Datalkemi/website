<?php
/**
 * Projects archive portfolio / case studies listing.
 */
get_header();

$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$industries = get_terms( [ 'taxonomy' => 'project_industry', 'hide_empty' => true ] );
$types      = get_terms( [ 'taxonomy' => 'project_type',     'hide_empty' => true ] );
?>

<!-- Page Hero -->
<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Our Work', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Projects &', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'Case Studies', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle">
			<?php esc_html_e( 'A selection of the work we\'re most proud of. Every project here represents a real business challenge and the solution we built to solve it.', 'datalkemi' ); ?>
		</p>
	</div>
</section>

<!-- Filters -->
<?php if ( ! empty( $industries ) || ! empty( $types ) ) : ?>
<div class="project-filters">
	<div class="dk-container">
		<div class="filter-bar">
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"
				class="filter-pill <?php echo ! is_tax() ? 'filter-pill--active' : ''; ?>">
				<?php esc_html_e( 'All Projects', 'datalkemi' ); ?>
			</a>
			<?php foreach ( $industries as $term ) : ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
					class="filter-pill <?php echo is_tax( 'project_industry', $term ) ? 'filter-pill--active' : ''; ?>">
					<?php echo esc_html( $term->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<!-- Projects grid -->
<section class="dk-section">
	<div class="dk-container">
		<?php if ( have_posts() ) : ?>
			<div class="dk-grid-3">
				<?php while ( have_posts() ) : the_post();
					$category   = get_post_meta( get_the_ID(), '_project_category', true );
					$tech_stack = get_post_meta( get_the_ID(), '_project_tech_stack', true );
					$live_url   = get_post_meta( get_the_ID(), '_project_live_url', true );
					$status_key = get_post_meta( get_the_ID(), '_project_status', true );
				?>
					<article class="dk-card project-archive-card" style="display:flex; flex-direction:column;">
						<a href="<?php the_permalink(); ?>" class="project-thumb-link">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="project-thumbnail">
									<?php the_post_thumbnail( 'medium_large' ); ?>
								</div>
							<?php else : ?>
								<div class="project-thumb-placeholder">
									<span>&#128196;</span>
								</div>
							<?php endif; ?>
						</a>
						<div style="padding:0; flex:1; display:flex; flex-direction:column;">
							<?php if ( $category ) : ?>
								<p class="project-category"><?php echo esc_html( $category ); ?></p>
							<?php endif; ?>
							<h2 class="project-title" style="font-size:1.125rem !important;">
								<a href="<?php the_permalink(); ?>" style="color:#f9fafb !important; -webkit-text-fill-color:#f9fafb !important;">
									<?php the_title(); ?>
								</a>
							</h2>
							<p class="project-desc"><?php the_excerpt(); ?></p>
							<?php if ( $tech_stack ) : ?>
								<div class="tech-tags">
									<?php foreach ( array_slice( explode( ',', $tech_stack ), 0, 4 ) as $tech ) : ?>
										<span class="tech-tag"><?php echo esc_html( trim( $tech ) ); ?></span>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class="project-actions">
								<a href="<?php the_permalink(); ?>" class="dk-btn dk-btn-primary" style="font-size:0.8125rem; padding:0.5rem 1.25rem;">
									<?php esc_html_e( 'View Case Study', 'datalkemi' ); ?>
								</a>
								<?php if ( $live_url ) : ?>
									<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer"
										class="dk-btn dk-btn-outline" style="font-size:0.8125rem; padding:0.5rem 1rem;">
										<?php esc_html_e( 'Live Site &#8599;', 'datalkemi' ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<div class="pagination-wrap">
				<?php
				echo paginate_links( [
					'total'     => $GLOBALS['wp_query']->max_num_pages,
					'current'   => $paged,
					'prev_text' => '&larr; ' . __( 'Previous', 'datalkemi' ),
					'next_text' => __( 'Next', 'datalkemi' ) . ' &rarr;',
				] );
				?>
			</div>

		<?php else : ?>
			<div style="text-align:center; padding:4rem 0;">
				<p style="font-size:4rem; margin-bottom:1rem;">&#127775;</p>
				<h2 class="dk-section-title"><?php esc_html_e( 'Projects Coming Soon', 'datalkemi' ); ?></h2>
				<p class="dk-section-subtitle" style="margin-bottom:2rem;">
					<?php esc_html_e( 'We\'re preparing our case studies showcase. Check back shortly there\'s a lot in the pipeline.', 'datalkemi' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-primary">
					<?php esc_html_e( 'Discuss Your Project', 'datalkemi' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- CTA -->
<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title"><?php esc_html_e( 'Want to Be Our Next Success Story?', 'datalkemi' ); ?></h2>
			<p class="cta-banner-subtitle"><?php esc_html_e( "Every great project starts with a conversation. Let's talk about yours.", 'datalkemi' ); ?></p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary">
				<?php esc_html_e( 'Start a Project', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

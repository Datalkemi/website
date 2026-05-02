<?php
/**
 * Projects section pulls from Projects CPT
 */
$projects = new WP_Query( [
	'post_type'      => 'project',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
] );
?>
<section id="projects" class="dk-section">
	<div class="dk-container">

		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Project Highlights', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( "A glimpse into some of the impactful solutions we've delivered for our clients.", 'datalkemi' ); ?></p>
		</div>

		<?php if ( $projects->have_posts() ) : ?>
			<div class="dk-grid-3">
				<?php while ( $projects->have_posts() ) : $projects->the_post();
					$live_url       = get_post_meta( get_the_ID(), '_project_live_url', true );
					$case_study_url = get_post_meta( get_the_ID(), '_project_case_study_url', true );
					$tech_stack     = get_post_meta( get_the_ID(), '_project_tech_stack', true );
					$category       = get_post_meta( get_the_ID(), '_project_category', true );
				?>
					<div class="dk-card" style="display:flex; flex-direction:column;">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="project-thumbnail">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</div>
						<?php endif; ?>
						<?php if ( $category ) : ?>
							<p class="project-category"><?php echo esc_html( $category ); ?></p>
						<?php endif; ?>
						<h3 class="project-title"><?php the_title(); ?></h3>
						<p class="project-desc"><?php the_excerpt(); ?></p>
						<?php if ( $tech_stack ) : ?>
							<div class="tech-tags">
								<?php foreach ( explode( ',', $tech_stack ) as $tech ) : ?>
									<span class="tech-tag"><?php echo esc_html( trim( $tech ) ); ?></span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<div class="project-actions">
							<?php if ( $live_url ) : ?>
								<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer" class="dk-btn dk-btn-outline" style="font-size:0.8125rem; padding:0.5rem 1rem;">
									<?php esc_html_e( 'View Live', 'datalkemi' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( $case_study_url ) : ?>
								<a href="<?php echo esc_url( $case_study_url ); ?>" target="_blank" rel="noopener noreferrer" class="post-readmore" style="align-self:center;">
									<?php esc_html_e( 'Case Study', 'datalkemi' ); ?> &rarr;
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p style="text-align:center;" class="dk-section-subtitle">
				<?php esc_html_e( 'Projects coming soon. Check back shortly!', 'datalkemi' ); ?>
			</p>
		<?php endif; ?>

		<div style="text-align:center; margin-top:3rem;">
			<a href="#contact" class="dk-btn dk-btn-primary"><?php esc_html_e( 'Discuss Your Project', 'datalkemi' ); ?></a>
		</div>

	</div>
</section>

<?php
/**
 * Projects section — pulls from Projects CPT
 */
$projects = new WP_Query( [
	'post_type'      => 'project',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
] );
?>
<section id="projects" style="background: rgba(31,41,55,0.5);">
	<div class="container">

		<div style="text-align:center; margin-bottom:4rem;">
			<h2 class="section-title gradient-text"><?php esc_html_e( 'Project Highlights', 'datalkemi' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( "A glimpse into some of the impactful solutions we've delivered for our clients.", 'datalkemi' ); ?></p>
		</div>

		<?php if ( $projects->have_posts() ) : ?>
			<div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:2rem;">
				<?php while ( $projects->have_posts() ) : $projects->the_post();
					$live_url        = get_post_meta( get_the_ID(), '_project_live_url', true );
					$case_study_url  = get_post_meta( get_the_ID(), '_project_case_study_url', true );
					$tech_stack      = get_post_meta( get_the_ID(), '_project_tech_stack', true );
					$category        = get_post_meta( get_the_ID(), '_project_category', true );
				?>
					<div class="card" style="display:flex; flex-direction:column;">
						<?php if ( has_post_thumbnail() ) : ?>
							<div style="border-radius:0.375rem; overflow:hidden; margin-bottom:1rem; aspect-ratio:16/9;">
								<?php the_post_thumbnail( 'medium_large', [ 'style' => 'width:100%;height:100%;object-fit:cover;' ] ); ?>
							</div>
						<?php endif; ?>
						<?php if ( $category ) : ?>
							<p style="font-size:0.75rem; color:var(--color-primary); font-weight:600; margin-bottom:0.5rem;">
								<?php echo esc_html( $category ); ?>
							</p>
						<?php endif; ?>
						<h3 style="font-size:1.125rem; font-weight:600; color:#f9fafb; margin-bottom:0.75rem;">
							<?php the_title(); ?>
						</h3>
						<p style="color:var(--color-text-muted); font-size:0.9rem; line-height:1.7; flex:1;">
							<?php the_excerpt(); ?>
						</p>
						<?php if ( $tech_stack ) : ?>
							<div style="display:flex; flex-wrap:wrap; gap:0.5rem; margin-top:1rem;">
								<?php foreach ( explode( ',', $tech_stack ) as $tech ) : ?>
									<span style="font-size:0.75rem; background:rgba(31,41,55,0.8); color:var(--color-accent); padding:0.25rem 0.625rem; border-radius:9999px;">
										<?php echo esc_html( trim( $tech ) ); ?>
									</span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<div style="display:flex; gap:0.75rem; margin-top:1.25rem; padding-top:1rem; border-top:1px solid var(--color-border);">
							<?php if ( $live_url ) : ?>
								<a href="<?php echo esc_url( $live_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-outline" style="font-size:0.8125rem; padding:0.5rem 1rem;">
									<?php esc_html_e( 'View Live', 'datalkemi' ); ?>
								</a>
							<?php endif; ?>
							<?php if ( $case_study_url ) : ?>
								<a href="<?php echo esc_url( $case_study_url ); ?>" target="_blank" rel="noopener noreferrer" style="font-size:0.8125rem; color:var(--color-text-muted); align-self:center; text-decoration:none;">
									<?php esc_html_e( 'Case Study', 'datalkemi' ); ?> &rarr;
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p style="text-align:center; color:var(--color-text-muted);">
				<?php esc_html_e( 'Projects coming soon. Check back shortly!', 'datalkemi' ); ?>
			</p>
		<?php endif; ?>

		<div style="text-align:center; margin-top:3rem;">
			<a href="#contact" class="btn-primary"><?php esc_html_e( 'Discuss Your Project', 'datalkemi' ); ?></a>
		</div>

	</div>
</section>

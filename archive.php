<?php
/**
 * Blog archive / Insights listing template
 */
get_header(); ?>

<main id="main" class="site-main">
	<section style="padding: 6rem 0;">
		<div class="container">

			<div style="text-align:center; margin-bottom: 4rem;">
				<h1 class="section-title gradient-text">
					<?php
					if ( is_category() ) {
						single_cat_title();
					} elseif ( is_tag() ) {
						single_tag_title( 'Tag: ' );
					} else {
						esc_html_e( 'Insights & Latest Tech', 'datalkemi' );
					}
					?>
				</h1>
				<p class="section-subtitle">
					<?php esc_html_e( 'Stay updated with the latest trends, tips, and insights from the world of web development and data analytics.', 'datalkemi' ); ?>
				</p>
			</div>

			<?php if ( have_posts() ) : ?>
				<div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?> style="display:flex; flex-direction:column;">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" style="display:block; margin-bottom:1rem; border-radius:0.375rem; overflow:hidden;">
									<?php the_post_thumbnail( 'medium_large', [ 'style' => 'width:100%;height:200px;object-fit:cover;' ] ); ?>
								</a>
							<?php endif; ?>
							<div style="flex:1; display:flex; flex-direction:column;">
								<div style="font-size:0.75rem; color:var(--color-accent); margin-bottom:0.5rem;">
									<?php echo esc_html( get_the_date() ); ?> &bull; <?php the_category( ', ' ); ?>
								</div>
								<h2 style="font-size:1.25rem; font-weight:600; margin-bottom:0.75rem;">
									<a href="<?php the_permalink(); ?>" style="color:var(--color-text); text-decoration:none;">
										<?php the_title(); ?>
									</a>
								</h2>
								<p style="color:var(--color-text-muted); font-size:0.9rem; flex:1;">
									<?php the_excerpt(); ?>
								</p>
								<a href="<?php the_permalink(); ?>" class="btn-outline" style="align-self:flex-start; margin-top:1.25rem; padding:0.5rem 1.25rem; font-size:0.875rem;">
									<?php esc_html_e( 'Read More', 'datalkemi' ); ?> &rarr;
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<div style="margin-top:3rem; text-align:center;">
					<?php the_posts_pagination( [
						'prev_text' => '&larr; ' . __( 'Previous', 'datalkemi' ),
						'next_text' => __( 'Next', 'datalkemi' ) . ' &rarr;',
					] ); ?>
				</div>

			<?php else : ?>
				<p style="text-align:center; color:var(--color-text-muted);">
					<?php esc_html_e( 'No posts found. Check back soon!', 'datalkemi' ); ?>
				</p>
			<?php endif; ?>

		</div>
	</section>
</main>

<?php get_footer();

<?php
/**
 * Blog preview section — latest 3 posts
 */
$blog_posts = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
] );
?>
<section id="blog-preview" style="background: rgba(31,41,55,0.3);">
	<div class="container">

		<div style="text-align:center; margin-bottom:4rem;">
			<h2 class="section-title gradient-text">&#128218; <?php esc_html_e( 'Insights & Latest Tech', 'datalkemi' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Stay updated with the latest trends, tips, and insights from the world of web development and data analytics.', 'datalkemi' ); ?></p>
		</div>

		<?php if ( $blog_posts->have_posts() ) : ?>
			<div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:2rem;">
				<?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
					<div class="card" style="display:flex; flex-direction:column;">
						<?php if ( has_post_thumbnail() ) : ?>
							<div style="border-radius:0.375rem; overflow:hidden; margin-bottom:1rem; aspect-ratio:16/9;">
								<?php the_post_thumbnail( 'medium_large', [ 'style' => 'width:100%;height:100%;object-fit:cover;' ] ); ?>
							</div>
						<?php endif; ?>
						<div style="font-size:0.75rem; color:var(--color-text-muted); margin-bottom:0.5rem;">
							<?php echo esc_html( get_the_date() ); ?> &bull;
							<span style="color:var(--color-accent);"><?php the_category( ', ' ); ?></span>
						</div>
						<h3 style="font-size:1.125rem; font-weight:600; margin-bottom:0.75rem; flex:1;">
							<a href="<?php the_permalink(); ?>" style="color:#f9fafb; text-decoration:none;">
								<?php the_title(); ?>
							</a>
						</h3>
						<p style="color:var(--color-text-muted); font-size:0.9rem; line-height:1.7; margin-bottom:1.25rem;">
							<?php the_excerpt(); ?>
						</p>
						<a href="<?php the_permalink(); ?>" style="color:var(--color-primary); font-weight:500; text-decoration:none; font-size:0.9rem; margin-top:auto;">
							<?php esc_html_e( 'Read More', 'datalkemi' ); ?> &rarr;
						</a>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p style="text-align:center; color:var(--color-text-muted);">
				<?php esc_html_e( 'Blog posts coming soon. Stay tuned!', 'datalkemi' ); ?>
			</p>
		<?php endif; ?>

		<div style="text-align:center; margin-top:3rem;">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="btn-outline">
				<?php esc_html_e( 'Visit Our Blog', 'datalkemi' ); ?> &rarr;
			</a>
		</div>

	</div>
</section>

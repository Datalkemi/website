<?php
/**
 * Blog preview section latest 3 posts
 */
$blog_posts = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
] );
?>
<section id="blog-preview" class="dk-section">
	<div class="dk-container">

		<div class="dk-section-header">
			<span class="dk-section-title">&#128218; <?php esc_html_e( 'Insights & Latest Tech', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Stay updated with the latest trends, tips, and insights from the world of web development and data analytics.', 'datalkemi' ); ?></p>
		</div>

		<?php if ( $blog_posts->have_posts() ) : ?>
			<div class="dk-grid-3">
				<?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
					<div class="dk-card" style="display:flex; flex-direction:column;">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-thumbnail">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</div>
						<?php endif; ?>
						<p class="post-meta">
							<?php echo esc_html( get_the_date() ); ?> &bull;
							<span class="post-category"><?php the_category( ', ' ); ?></span>
						</p>
						<h3 class="post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<p class="post-excerpt"><?php the_excerpt(); ?></p>
						<a href="<?php the_permalink(); ?>" class="post-readmore" style="margin-top:auto;">
							<?php esc_html_e( 'Read More', 'datalkemi' ); ?> &rarr;
						</a>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p style="text-align:center;" class="dk-section-subtitle">
				<?php esc_html_e( 'Blog posts coming soon. Stay tuned!', 'datalkemi' ); ?>
			</p>
		<?php endif; ?>

		<div style="text-align:center; margin-top:3rem;">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="dk-btn dk-btn-outline">
				<?php esc_html_e( 'Visit Our Blog', 'datalkemi' ); ?> &rarr;
			</a>
		</div>

	</div>
</section>

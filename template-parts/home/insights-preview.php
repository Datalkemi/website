<?php
/**
 * Template Part: Homepage — Insights Preview
 *
 * Fetches the 3 most recent published posts and renders them as
 * insight cards. Reading time is calculated from post content
 * (str_word_count / 200 wpm, minimum 1 min). Excerpt is trimmed
 * to 18 words via wp_trim_words().
 *
 * If no posts are found, this section renders nothing.
 *
 * @package Datalkemi
 * @since   2.0.0
 */

$hp_insights_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => 1,
	)
);

if ( ! $hp_insights_query->have_posts() ) {
	return;
}
?>

<section class="hp-insights" aria-labelledby="insights-heading">
	<div class="hp-container">

		<div class="hp-insights-header">
			<h2 id="insights-heading">
				<?php esc_html_e( 'Recent insights', 'datalkemi' ); ?>
			</h2>
			<a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">
				<?php esc_html_e( 'Read all insights', 'datalkemi' ); ?>
			</a>
		</div>

		<div class="hp-insights-grid">

			<?php
			while ( $hp_insights_query->have_posts() ) :
				$hp_insights_query->the_post();

				// Calculate reading time: word count divided by 200 wpm, minimum 1 min.
				$hp_word_count    = str_word_count( wp_strip_all_tags( get_the_content() ) );
				$hp_reading_time  = max( 1, (int) ceil( $hp_word_count / 200 ) );

				// Excerpt trimmed to 18 words.
				$hp_excerpt = wp_trim_words( get_the_excerpt(), 18, '&hellip;' );
				?>

				<article class="hp-insight-card">
					<p class="hp-insight-meta">
						<?php
						printf(
							/* translators: %d: estimated reading time in minutes */
							esc_html( _n( '%d min read', '%d min read', $hp_reading_time, 'datalkemi' ) ),
							absint( $hp_reading_time )
						);
						?>
					</p>
					<a
						class="hp-insight-title"
						href="<?php the_permalink(); ?>"
					>
						<?php the_title(); ?>
					</a>
					<?php if ( $hp_excerpt ) : ?>
						<p class="hp-insight-excerpt">
							<?php echo esc_html( $hp_excerpt ); ?>
						</p>
					<?php endif; ?>
				</article><!-- /.hp-insight-card -->

			<?php endwhile; ?>

		</div><!-- /.hp-insights-grid -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-insights -->

<?php wp_reset_postdata(); ?>

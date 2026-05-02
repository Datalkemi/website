<?php
/**
 * Testimonials section — pulls from Testimonials CPT
 */
$testimonials = new WP_Query( [
	'post_type'      => 'testimonial',
	'posts_per_page' => 3,
	'post_status'    => 'publish',
] );
?>
<section id="testimonials" class="dk-section">
	<div class="dk-container">

		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Client Testimonials', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Hear what our satisfied clients have to say about their experience with Datalkemi.', 'datalkemi' ); ?></p>
		</div>

		<?php if ( $testimonials->have_posts() ) : ?>
			<div class="dk-grid-3">
				<?php while ( $testimonials->have_posts() ) : $testimonials->the_post();
					$rating = (int) get_post_meta( get_the_ID(), '_testimonial_rating', true );
					$role   = get_post_meta( get_the_ID(), '_testimonial_role', true );
					$rating = $rating ?: 5;
				?>
					<div class="dk-glass" style="padding:2rem; display:flex; flex-direction:column; gap:1rem;">
						<div style="display:flex; align-items:center; gap:1rem;">
							<div class="testimonial-avatar">
								<?php if ( has_post_thumbnail() ) :
									the_post_thumbnail( 'thumbnail' );
								else : ?>
									&#128100;
								<?php endif; ?>
							</div>
							<div>
								<p class="testimonial-name"><?php the_title(); ?></p>
								<?php if ( $role ) : ?>
									<p class="testimonial-role"><?php echo esc_html( $role ); ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div class="testimonial-stars">
							<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
								<span class="<?php echo $i <= $rating ? 'star-filled' : 'star-empty'; ?>">&#9733;</span>
							<?php endfor; ?>
						</div>
						<p class="testimonial-text">
							&ldquo;<?php echo wp_kses_post( get_the_content() ); ?>&rdquo;
						</p>
						<p class="testimonial-verified"><?php esc_html_e( 'Verified Client Feedback', 'datalkemi' ); ?></p>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p style="text-align:center;" class="dk-section-subtitle">
				<?php esc_html_e( 'Client testimonials coming soon.', 'datalkemi' ); ?>
			</p>
		<?php endif; ?>

	</div>
</section>

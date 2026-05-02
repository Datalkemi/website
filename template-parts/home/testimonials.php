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
<section id="testimonials" style="background: var(--color-bg);">
	<div class="container">

		<div style="text-align:center; margin-bottom:4rem;">
			<h2 class="section-title gradient-text"><?php esc_html_e( 'Client Testimonials', 'datalkemi' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Hear what our satisfied clients have to say about their experience with Datalkemi.', 'datalkemi' ); ?></p>
		</div>

		<?php if ( $testimonials->have_posts() ) : ?>
			<div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:2rem;">
				<?php while ( $testimonials->have_posts() ) : $testimonials->the_post();
					$rating   = (int) get_post_meta( get_the_ID(), '_testimonial_rating', true );
					$role     = get_post_meta( get_the_ID(), '_testimonial_role', true );
					$rating   = $rating ?: 5;
				?>
					<div class="glassmorphism" style="padding:2rem; border-radius:0.75rem; display:flex; flex-direction:column;">
						<div style="display:flex; align-items:center; gap:1rem; margin-bottom:1rem;">
							<?php if ( has_post_thumbnail() ) : ?>
								<div style="width:3rem; height:3rem; border-radius:50%; overflow:hidden; flex-shrink:0;">
									<?php the_post_thumbnail( 'thumbnail', [ 'style' => 'width:100%;height:100%;object-fit:cover;' ] ); ?>
								</div>
							<?php else : ?>
								<div style="width:3rem; height:3rem; border-radius:50%; background:var(--color-bg-alt); display:flex; align-items:center; justify-content:center; font-size:1.25rem; flex-shrink:0;">&#128100;</div>
							<?php endif; ?>
							<div>
								<p style="font-weight:600; color:#f9fafb; margin:0;"><?php the_title(); ?></p>
								<?php if ( $role ) : ?>
									<p style="font-size:0.75rem; color:var(--color-text-muted); margin:0;"><?php echo esc_html( $role ); ?></p>
								<?php endif; ?>
							</div>
						</div>
						<div style="display:flex; gap:0.25rem; margin-bottom:1rem;">
							<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
								<span style="color:<?php echo $i <= $rating ? '#facc15' : 'var(--color-border)'; ?>; font-size:1.125rem;">&#9733;</span>
							<?php endfor; ?>
						</div>
						<p style="color:#d1d5db; line-height:1.7; font-style:italic; flex:1;">
							&ldquo;<?php echo wp_kses_post( get_the_content() ); ?>&rdquo;
						</p>
						<p style="font-size:0.75rem; color:var(--color-text-muted); margin-top:1rem;">
							<?php esc_html_e( 'Verified Client Feedback', 'datalkemi' ); ?>
						</p>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p style="text-align:center; color:var(--color-text-muted);">
				<?php esc_html_e( 'Client testimonials coming soon.', 'datalkemi' ); ?>
			</p>
		<?php endif; ?>

	</div>
</section>

<?php
/**
 * Single blog post template
 */
get_header(); ?>

<main id="main" class="site-main">
	<div class="container" style="max-width: 800px; padding-top: 6rem; padding-bottom: 6rem;">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header" style="margin-bottom: 2rem;">
					<div style="margin-bottom: 1rem;">
						<span style="color: var(--color-accent); font-size: 0.875rem; font-weight: 600;">
							<?php the_category( ', ' ); ?>
						</span>
						<span style="color: var(--color-text-muted); font-size: 0.875rem; margin-left: 1rem;">
							<?php echo esc_html( get_the_date() ); ?>
						</span>
					</div>
					<h1 class="entry-title gradient-text" style="font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 700; margin-bottom: 1.5rem;">
						<?php the_title(); ?>
					</h1>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="entry-thumbnail" style="margin-bottom: 2rem; border-radius: 0.5rem; overflow: hidden;">
							<?php the_post_thumbnail( 'large', [ 'style' => 'width:100%; height:auto;' ] ); ?>
						</div>
					<?php endif; ?>
				</header>

				<div class="entry-content" style="color: var(--color-text-muted); line-height: 1.8; font-size: 1.0625rem;">
					<?php the_content(); ?>
				</div>

				<footer class="entry-footer" style="margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid var(--color-border);">
					<?php the_tags( '<div class="entry-tags" style="margin-bottom:1rem;">', ' ', '</div>' ); ?>
					<?php
					$prev = get_previous_post();
					$next = get_next_post();
					?>
					<nav class="post-navigation" style="display:flex; justify-content:space-between; gap:1rem;">
						<?php if ( $prev ) : ?>
							<a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" style="color:var(--color-primary);">
								&larr; <?php echo esc_html( get_the_title( $prev ) ); ?>
							</a>
						<?php endif; ?>
						<?php if ( $next ) : ?>
							<a href="<?php echo esc_url( get_permalink( $next ) ); ?>" style="color:var(--color-primary); margin-left:auto;">
								<?php echo esc_html( get_the_title( $next ) ); ?> &rarr;
							</a>
						<?php endif; ?>
					</nav>
				</footer>

			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php get_footer();

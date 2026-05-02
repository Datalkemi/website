<?php
/**
 * 404 error page
 */
get_header(); ?>

<main id="main" class="site-main">
	<section style="min-height: 70vh; display:flex; align-items:center; justify-content:center; text-align:center; padding: 4rem 1.5rem;">
		<div>
			<h1 style="font-size: clamp(5rem, 15vw, 10rem); font-weight:800; line-height:1;" class="gradient-text">404</h1>
			<h2 style="font-size: clamp(1.5rem, 3vw, 2rem); margin-bottom: 1rem;">
				<?php esc_html_e( 'Page Not Found', 'datalkemi' ); ?>
			</h2>
			<p style="color: var(--color-text-muted); max-width: 480px; margin: 0 auto 2rem;">
				<?php esc_html_e( "The page you're looking for doesn't exist or has been moved.", 'datalkemi' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">
				<?php esc_html_e( 'Back to Home', 'datalkemi' ); ?>
			</a>
		</div>
	</section>
</main>

<?php get_footer();

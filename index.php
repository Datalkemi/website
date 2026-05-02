<?php
/**
 * Fallback template — WordPress requires this file.
 * Actual homepage is handled by front-page.php
 */
get_header(); ?>

<main id="main" class="site-main container">
	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;
	else : ?>
		<p><?php esc_html_e( 'No content found.', 'datalkemi' ); ?></p>
	<?php endif; ?>
</main>

<?php get_footer();

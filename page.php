<?php
/**
 * Generic page template
 */
get_header(); ?>

<main id="main" class="site-main">
	<div class="container" style="padding-top: 6rem; padding-bottom: 6rem;">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="page-title gradient-text"><?php the_title(); ?></h1>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php get_footer();

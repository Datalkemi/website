<?php
/**
 * Homepage template displays all sections
 */
get_header(); ?>

<main id="main" class="site-main">

	<?php get_template_part( 'template-parts/home/hero' ); ?>
	<?php get_template_part( 'template-parts/home/about' ); ?>
	<?php get_template_part( 'template-parts/home/services' ); ?>
<?php get_template_part( 'template-parts/home/projects' ); ?>
	<?php get_template_part( 'template-parts/home/testimonials' ); ?>
	<?php get_template_part( 'template-parts/home/blog-preview' ); ?>
	<?php get_template_part( 'template-parts/home/contact' ); ?>

</main>

<?php get_footer();

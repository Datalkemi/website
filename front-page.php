<?php
/**
 * Homepage template  -  includes ten section template parts in order.
 * Do not add section logic here; edit the individual template parts.
 */
get_header();
?>
<main id="main" class="site-main">

	<?php get_template_part( 'template-parts/home/hero' ); ?>
	<?php get_template_part( 'template-parts/home/logo-strip' ); ?>
	<?php get_template_part( 'template-parts/home/problem' ); ?>
	<?php get_template_part( 'template-parts/home/what-we-build' ); ?>
	<?php get_template_part( 'template-parts/home/why-datalkemi' ); ?>
	<?php get_template_part( 'template-parts/home/how-we-work' ); ?>
	<?php get_template_part( 'template-parts/home/cta-band' ); ?>
	<?php get_template_part( 'template-parts/home/insights-preview' ); ?>
	<?php get_template_part( 'template-parts/home/about-snippet' ); ?>
	<?php get_template_part( 'template-parts/home/final-cta' ); ?>

</main>
<?php get_footer();

<?php
/**
 * Contact page template. Applies to the page with slug "contact".
 * Renders the contact section (email, location, socials, and form).
 */
get_header();
?>
<main id="main" class="site-main">

	<?php get_template_part( 'template-parts/home/contact' ); ?>

</main>
<?php get_footer();

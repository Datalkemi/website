<?php
/**
 * Frequently asked questions (slug: faq).
 *
 * WordPress uses this file automatically for the page with the slug faq.
 * Questions live in inc/faq-data.php, which also feeds the FAQPage
 * structured data in inc/seo.php.
 *
 * @package Datalkemi
 * @since   2.6.0
 */
get_header();

$groups = datalkemi_faq_groups();
?>

<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Help', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title"><?php esc_html_e( 'Frequently asked questions', 'datalkemi' ); ?></h1>
		<p class="page-hero-subtitle"><?php esc_html_e( 'Pricing, timelines, ownership, and how we work with businesses in Australia, India, and around the world.', 'datalkemi' ); ?></p>
	</div>
</section>

<section class="dk-section faq-section faq-page">
	<div class="dk-container">

		<nav class="faq-page-nav" aria-label="<?php esc_attr_e( 'Question topics', 'datalkemi' ); ?>">
			<?php foreach ( $groups as $g => $group ) : ?>
				<a href="#faq-topic-<?php echo esc_attr( $g ); ?>"><?php echo esc_html( $group['title'] ); ?></a>
			<?php endforeach; ?>
		</nav>

		<?php $n = 0; foreach ( $groups as $g => $group ) : ?>
			<div class="faq-page-group" id="faq-topic-<?php echo esc_attr( $g ); ?>">
				<h2 class="faq-page-title"><?php echo esc_html( $group['title'] ); ?></h2>
				<div class="faq-list">
					<?php foreach ( $group['items'] as $faq ) : $n++; ?>
						<div class="faq-item">
							<button class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo esc_attr( $n ); ?>">
								<span><?php echo esc_html( $faq['q'] ); ?></span>
								<span class="faq-icon" aria-hidden="true">&#43;</span>
							</button>
							<div class="faq-answer" id="faq-answer-<?php echo esc_attr( $n ); ?>" hidden>
								<p><?php echo esc_html( $faq['a'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>

	</div>
</section>

<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title"><?php esc_html_e( 'Still have a question?', 'datalkemi' ); ?></h2>
			<p class="cta-banner-subtitle"><?php esc_html_e( 'Send us a message or get an instant estimate for your project.', 'datalkemi' ); ?></p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary"><?php esc_html_e( 'Estimate your project', 'datalkemi' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline" style="border-color:var(--text); color:var(--text);"><?php esc_html_e( 'Contact us', 'datalkemi' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();

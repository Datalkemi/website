<?php
/**
 * Website development for businesses in India (slug: website-development-india).
 *
 * WordPress uses this file automatically for the page with this slug.
 * Content lives in inc/india-data.php so the FAQ structured data in
 * inc/seo.php matches what visitors read. The Australian version of this
 * page is the web-development service page; both link to each other and
 * carry hreflang alternates.
 *
 * @package Datalkemi
 * @since   2.5.0
 */
get_header();

$india = datalkemi_india_page_data();
?>

<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Website development for India', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Website development', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'for businesses in India', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle"><?php esc_html_e( 'Custom websites, online stores, and web applications that load fast on any phone and are ready for Google from day one. Built by Datalkemi, with working hours that overlap with IST.', 'datalkemi' ); ?></p>
		<div class="hero-buttons product-hero-buttons">
			<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary"><?php esc_html_e( 'Estimate your website', 'datalkemi' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline"><?php esc_html_e( 'Talk to us', 'datalkemi' ); ?></a>
		</div>
	</div>
</section>

<section class="dk-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'What we build', 'datalkemi' ); ?></p>
			<h2 class="product-heading"><?php esc_html_e( 'Websites that bring in enquiries', 'datalkemi' ); ?></h2>
			<p class="dk-section-subtitle"><?php esc_html_e( 'From a small business website to a full booking platform, every project is designed around how your customers in India search, browse, and get in touch.', 'datalkemi' ); ?></p>
		</div>
		<div class="india-grid">
			<?php foreach ( $india['services'] as $item ) : ?>
				<div class="dk-card product-feature">
					<span class="product-feature-icon"><?php echo $item['svg']; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<h3 class="product-feature-title"><?php echo esc_html( $item['title'] ); ?></h3>
					<p class="product-feature-desc"><?php echo esc_html( $item['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="dk-section india-band">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'Why Datalkemi', 'datalkemi' ); ?></p>
			<h2 class="product-heading"><?php esc_html_e( 'Remote, but never out of reach', 'datalkemi' ); ?></h2>
		</div>
		<div class="india-grid">
			<?php foreach ( $india['reasons'] as $item ) : ?>
				<div class="dk-card product-feature">
					<span class="product-feature-icon"><?php echo $item['svg']; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<h3 class="product-feature-title"><?php echo esc_html( $item['title'] ); ?></h3>
					<p class="product-feature-desc"><?php echo esc_html( $item['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="dk-section">
	<div class="dk-container">
		<div class="india-case">
			<div>
				<p class="section-eyebrow"><?php esc_html_e( 'Recent work in India', 'datalkemi' ); ?></p>
				<h2 class="product-heading"><?php esc_html_e( 'CP Study Centre, Kerala', 'datalkemi' ); ?></h2>
				<p class="india-case-text"><?php esc_html_e( 'An education provider offering school tuition, language test preparation, and career skills courses. We built a mobile-first course catalogue where every course has its own page, with enquiry forms and a WhatsApp shortcut for families who prefer to message.', 'datalkemi' ); ?></p>
				<a class="svc-areas-link" href="<?php echo esc_url( home_url( '/projects/cp-study-centre-website/' ) ); ?>">
					<?php esc_html_e( 'Read the case study', 'datalkemi' ); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</a>
			</div>
			<?php if ( file_exists( DATALKEMI_DIR . '/assets/img/projects/cp-study-centre-website.jpg' ) ) : ?>
				<figure class="india-case-figure">
					<img src="<?php echo esc_url( DATALKEMI_URI . '/assets/img/projects/cp-study-centre-website.jpg' ); ?>"
						alt="<?php esc_attr_e( 'CP Study Centre website home page', 'datalkemi' ); ?>"
						width="1200" height="750"
						loading="lazy">
				</figure>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="dk-section process-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'How it works', 'datalkemi' ); ?></p>
			<h2 class="product-heading"><?php esc_html_e( 'Four steps from call to launch', 'datalkemi' ); ?></h2>
		</div>
		<div class="india-grid">
			<?php foreach ( $india['process'] as $step ) : ?>
				<div class="process-card dk-glass">
					<span class="process-card-number"><?php echo esc_html( $step['step'] ); ?></span>
					<h3 class="process-card-title"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="process-card-desc"><?php echo esc_html( $step['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="dk-section faq-section">
	<div class="dk-container">
		<div class="dk-section-header">
			<h2 class="product-heading"><?php esc_html_e( 'Frequently asked questions', 'datalkemi' ); ?></h2>
		</div>
		<div class="faq-list">
			<?php foreach ( $india['faqs'] as $i => $faq ) : ?>
				<div class="faq-item">
					<button class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo esc_attr( $i ); ?>">
						<span><?php echo esc_html( $faq['q'] ); ?></span>
						<span class="faq-icon" aria-hidden="true">&#43;</span>
					</button>
					<div class="faq-answer" id="faq-answer-<?php echo esc_attr( $i ); ?>" hidden>
						<p><?php echo esc_html( $faq['a'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title"><?php esc_html_e( 'Ready to plan your website?', 'datalkemi' ); ?></h2>
			<p class="cta-banner-subtitle">
				<?php esc_html_e( 'Get an instant estimate in AUD or USD, or book a call in your morning.', 'datalkemi' ); ?>
				<a href="<?php echo esc_url( home_url( '/services/web-development/' ) ); ?>"><?php esc_html_e( 'Based in Australia? See website development in Australia.', 'datalkemi' ); ?></a>
			</p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/build-your-project/' ) ); ?>" class="dk-btn dk-btn-primary"><?php esc_html_e( 'Estimate your website', 'datalkemi' ); ?></a>
			<a href="https://meetings-ap1.hubspot.com/naufal" class="dk-btn dk-btn-outline" style="border-color:var(--text); color:var(--text);"><?php esc_html_e( 'Book a call', 'datalkemi' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();

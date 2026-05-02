<?php
/**
 * Hero section
 */
$video_url = DATALKEMI_URI . '/assets/videos/hero-bg.mp4';
?>
<section id="hero">

	<!-- Background video -->
	<video class="hero-video" autoplay muted loop playsinline>
		<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
	</video>

	<!-- Dark overlay -->
	<div class="hero-overlay"></div>

	<!-- Animated blobs -->
	<div class="hero-blob-1"></div>
	<div class="hero-blob-2"></div>

	<!-- Content -->
	<div class="hero-content">
		<h1 class="hero-title">
			<span class="hero-title-brand">Datalkemi</span>
			<span class="hero-title-sub"><?php esc_html_e( 'Crafting Digital Excellence.', 'datalkemi' ); ?></span>
		</h1>
		<p class="hero-description">
			<?php esc_html_e( 'Elevating your online presence with innovative web design & development, powerful in-code SEO, and insightful data analytics & BI solutions.', 'datalkemi' ); ?>
		</p>
		<div class="hero-buttons">
			<a href="#services" class="dk-btn dk-btn-primary"><?php esc_html_e( 'Our Services', 'datalkemi' ); ?> &rarr;</a>
			<a href="#contact" class="dk-btn dk-btn-outline"><?php esc_html_e( 'Contact Us', 'datalkemi' ); ?></a>
		</div>
	</div>

	<!-- Bottom fade -->
	<div class="hero-fade"></div>
</section>

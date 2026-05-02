<?php
/**
 * Hero section
 */
$video_url = DATALKEMI_URI . '/assets/videos/hero-bg.mp4';
?>
<section id="hero" style="position:relative; min-height:100vh; display:flex; align-items:center; justify-content:center; overflow:hidden; background:#000;">

	<!-- Background video -->
	<video autoplay muted loop playsinline style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:0;">
		<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
	</video>

	<!-- Overlay -->
	<div style="position:absolute; inset:0; background:rgba(0,0,0,0.75); backdrop-filter:blur(2px); z-index:1;"></div>

	<!-- Animated blobs -->
	<div style="position:absolute; inset:0; z-index:1; pointer-events:none; opacity:0.15;">
		<span style="position:absolute; top:25%; left:25%; width:16rem; height:16rem; background:var(--color-primary); border-radius:50%; filter:blur(4rem);"></span>
		<span style="position:absolute; bottom:25%; right:25%; width:18rem; height:18rem; background:var(--color-accent); border-radius:50%; filter:blur(4rem);"></span>
	</div>

	<!-- Content -->
	<div class="container" style="position:relative; z-index:2; text-align:center; padding-top:5rem; padding-bottom:5rem;">
		<h1 style="font-size:clamp(2.5rem, 8vw, 5rem); font-weight:800; line-height:1.1; margin-bottom:1.5rem;">
			<span class="gradient-text">Datalkemi</span><br>
			<span style="color:#f9fafb;">Crafting Digital Excellence.</span>
		</h1>
		<p style="font-size:clamp(1rem, 2.5vw, 1.25rem); color:#d1d5db; max-width:42rem; margin:0 auto 2.5rem;">
			<?php esc_html_e( 'Elevating your online presence with innovative web design & development, powerful in-code SEO, and insightful data analytics & BI solutions.', 'datalkemi' ); ?>
		</p>
		<div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
			<a href="#services" class="btn-primary"><?php esc_html_e( 'Our Services', 'datalkemi' ); ?> &rarr;</a>
			<a href="#contact" class="btn-outline"><?php esc_html_e( 'Contact Us', 'datalkemi' ); ?></a>
		</div>
	</div>

	<!-- Bottom fade -->
	<div style="position:absolute; bottom:0; left:0; right:0; height:8rem; background:linear-gradient(to top, #111827, transparent); z-index:2;"></div>
</section>

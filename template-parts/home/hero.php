<?php
/**
 * Template Part: Homepage Hero
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-hero" aria-labelledby="hero-headline">
	<div class="hp-hero-overlay" aria-hidden="true"></div>
	<div class="hp-hero-orb hp-hero-orb--1" aria-hidden="true"></div>
	<div class="hp-hero-orb hp-hero-orb--2" aria-hidden="true"></div>
	<div class="hp-container">
		<div class="hp-hero-inner">

			<span class="hp-eyebrow">
				<?php esc_html_e( 'Perth-based. Working with clients across Australia and beyond.', 'datalkemi' ); ?>
			</span>

			<h1 id="hero-headline" class="hp-hero-headline">
				<?php esc_html_e( 'We build the systems your business depends on — ', 'datalkemi' ); ?><span class="hp-accent-text"><?php esc_html_e( 'properly engineered', 'datalkemi' ); ?></span><?php esc_html_e( ', end-to-end.', 'datalkemi' ); ?>
			</h1>

			<p class="hp-hero-sub">
				<?php esc_html_e( 'From web applications to data pipelines, document intelligence, and internal tools — we build the systems that run your operations. Perth-based, working with clients across Australia and beyond.', 'datalkemi' ); ?>
			</p>

			<div class="hp-hero-actions">
				<a
					href="BOOKING_URL_PLACEHOLDER"
					class="hp-btn-primary"
				>
					<?php esc_html_e( 'Book a discovery call', 'datalkemi' ); ?>
				</a>
				<a
					href="<?php echo esc_url( home_url( '/services/' ) ); ?>"
					class="hp-btn-text"
				>
					<?php esc_html_e( 'See how we work', 'datalkemi' ); ?>
				</a>
			</div>

		</div><!-- /.hp-hero-inner -->
	</div><!-- /.hp-container -->
</section><!-- /.hp-hero -->

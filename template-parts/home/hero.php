<?php
/**
 * Template Part: Homepage Hero
 *
 * Headline options — rendering Option B:
 *
 * A: Custom software and data systems for finance businesses that have
 *    outgrown spreadsheets and workarounds.
 *
 * B (active): The software and data infrastructure your finance business is missing.
 *
 * C: Finance teams run better when their systems are built for how they
 *    actually work.
 *
 * Sub-headline options — rendering Option A:
 *
 * A (active): We build custom web applications, data platforms, document
 *             intelligence tools, and operational software for finance businesses
 *             that need purpose-built systems. Perth-based, working with clients
 *             across Australia.
 *
 * B: From document automation to data pipelines and client portals — we build
 *    the internal systems finance businesses rely on. Perth-based, working
 *    Australia-wide.
 *
 * C: Your team has outgrown the tools they started with. We build the software
 *    and data infrastructure to replace them. Perth-based, working with clients
 *    across Australia.
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
				<?php esc_html_e( 'Perth-based. Working with clients across Australia.', 'datalkemi' ); ?>
			</span>

			<h1 id="hero-headline" class="hp-hero-headline">
				<?php esc_html_e( 'The software and data infrastructure your finance business is missing.', 'datalkemi' ); ?>
			</h1>

			<p class="hp-hero-sub">
				<?php esc_html_e( 'We build custom web applications, data platforms, document intelligence tools, and operational software for finance businesses that need purpose-built systems. Perth-based, working with clients across Australia.', 'datalkemi' ); ?>
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

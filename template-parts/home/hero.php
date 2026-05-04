<?php
/**
 * Template Part: Homepage Hero
 *
 * Headline options — rendering Option A:
 *
 * A (active): Custom software and data systems for businesses that have
 *             outgrown their current tools.
 *             Accent span on "data systems".
 *
 * B: We build the systems your business depends on —
 *    properly engineered, end-to-end.
 *    Accent span on "properly engineered".
 *
 * C: Software and data infrastructure for businesses that need
 *    purpose-built systems, not off-the-shelf compromises.
 *    Accent span on "purpose-built systems".
 *
 * Sub-headline options — rendering Option A:
 *
 * A (active): We build custom web applications, data platforms, document
 *             intelligence tools, internal tools, and operational software
 *             for businesses that need purpose-built systems. Perth-based,
 *             working with clients across Australia and beyond.
 *
 * B: From web applications to data pipelines, document intelligence, and
 *    internal tools — we build the systems that run your operations.
 *    Perth-based, working with clients across Australia and beyond.
 *
 * C: Custom software, data platforms, document intelligence, and operational
 *    tools — built properly, integrated end-to-end. Perth-based, working
 *    with clients across Australia and beyond.
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
				<?php esc_html_e( 'Custom software and', 'datalkemi' ); ?>
				<span class="hp-accent-text"><?php esc_html_e( 'data systems', 'datalkemi' ); ?></span>
				<?php esc_html_e( 'for businesses that have outgrown their current tools.', 'datalkemi' ); ?>
			</h1>

			<p class="hp-hero-sub">
				<?php esc_html_e( 'We build custom web applications, data platforms, document intelligence tools, internal tools, and operational software for businesses that need purpose-built systems. Perth-based, working with clients across Australia and beyond.', 'datalkemi' ); ?>
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

<?php
/**
 * Template Part: Homepage Hero
 *
 * Geography moved from the eyebrow to the sub-headline.
 * Eyebrow now shows capability categories.
 *
 * Headline options  -  rendering Option A:
 *
 * A (active): Software backed by data engineering.
 *             Accent span on "data engineering".
 *
 * B: Custom software, engineered like infrastructure.
 *    Accent span on "engineered like infrastructure".
 *
 * C: We build software that's engineered, not assembled.
 *    Accent span on "engineered".
 *
 * Sub-headline options  -  rendering Option C:
 *
 * A: We build custom web applications, data platforms, and operational
 *    software for businesses that need purpose-built systems. Perth-based,
 *    working with clients across Australia and beyond.
 *
 * B: Web applications, data platforms, document intelligence, and internal
 *    tools, built properly, integrated end-to-end. Perth-based, working
 *    with clients across Australia and beyond.
 *
 * C (active): Custom software and data systems, built end-to-end by people
 *             who understand both. Perth-based, working with clients across
 *             Australia and beyond.
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
				<?php esc_html_e( 'Custom software · Data systems · Internal tools', 'datalkemi' ); ?>
			</span>

			<!--
				Headline options:
				A (active): Software backed by data engineering.
				B: Custom software, engineered like infrastructure.
				C: We build software that's engineered, not assembled.
			-->
			<h1 id="hero-headline" class="hp-hero-headline">
				<?php esc_html_e( 'Software backed by ', 'datalkemi' ); ?><span class="hp-accent-text"><?php esc_html_e( 'data engineering', 'datalkemi' ); ?></span><?php esc_html_e( '.', 'datalkemi' ); ?>
			</h1>

			<!--
				Sub-headline options:
				A: We build custom web applications, data platforms, and operational software for businesses that need purpose-built systems. Perth-based, working with clients across Australia and beyond.
				B: Web applications, data platforms, document intelligence, and internal tools, built properly, integrated end-to-end. Perth-based, working with clients across Australia and beyond.
				C (active): Custom software and data systems, built end-to-end by people who understand both. Perth-based, working with clients across Australia and beyond.
			-->
			<p class="hp-hero-sub">
				<?php esc_html_e( 'Custom software and data systems, built end-to-end by people who understand both. Perth-based, working with clients across Australia and beyond.', 'datalkemi' ); ?>
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

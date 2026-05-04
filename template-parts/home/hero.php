<?php
/**
 * Template Part: Homepage Hero
 *
 * Two-column layout on desktop: copy left, differentiator card right.
 * Geography is in the sub-headline, not the eyebrow.
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

			<!-- ── Left: headline, sub-headline, CTAs ── -->
			<div class="hp-hero-left">

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

			</div><!-- /.hp-hero-left -->

			<!-- ── Right: differentiator card (decorative, aria-hidden) ── -->
			<div class="hp-hero-right" aria-hidden="true">
				<div class="hp-hero-card">

					<p class="hp-hero-card-title">
						<?php esc_html_e( 'Why Datalkemi', 'datalkemi' ); ?>
					</p>

					<ul class="hp-hero-card-list" role="list">

						<li class="hp-hero-card-item">
							<span class="hp-hero-card-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
							</span>
							<div class="hp-hero-card-body">
								<strong><?php esc_html_e( 'Data engineering first', 'datalkemi' ); ?></strong>
								<span><?php esc_html_e( 'Software built on the right foundation, not bolted on afterwards.', 'datalkemi' ); ?></span>
							</div>
						</li>

						<li class="hp-hero-card-item">
							<span class="hp-hero-card-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
							</span>
							<div class="hp-hero-card-body">
								<strong><?php esc_html_e( 'Enterprise-scale background', 'datalkemi' ); ?></strong>
								<span><?php esc_html_e( 'Real experience across ERP implementations, Azure data platforms, and large-scale migrations.', 'datalkemi' ); ?></span>
							</div>
						</li>

						<li class="hp-hero-card-item">
							<span class="hp-hero-card-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
							</span>
							<div class="hp-hero-card-body">
								<strong><?php esc_html_e( 'Direct access to the builder', 'datalkemi' ); ?></strong>
								<span><?php esc_html_e( 'No account managers or handoffs. You work with the person writing the code.', 'datalkemi' ); ?></span>
							</div>
						</li>

						<li class="hp-hero-card-item">
							<span class="hp-hero-card-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
							</span>
							<div class="hp-hero-card-body">
								<strong><?php esc_html_e( 'Master of Data Science, UWA', 'datalkemi' ); ?></strong>
								<span><?php esc_html_e( 'Academic rigour applied to real-world systems and operational problems.', 'datalkemi' ); ?></span>
							</div>
						</li>

					</ul>

				</div><!-- /.hp-hero-card -->
			</div><!-- /.hp-hero-right -->

		</div><!-- /.hp-hero-inner -->
	</div><!-- /.hp-container -->
</section><!-- /.hp-hero -->

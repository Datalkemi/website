<?php
/**
 * Template Part: Homepage Hero
 *
 * Two-column layout on desktop: copy left, dashboard mockup right.
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

			<!-- ── Right: CSS dashboard mockup (decorative) ── -->
			<div class="hp-hero-right" aria-hidden="true">
				<div class="hp-dash">

					<!-- Window chrome -->
					<div class="hp-dash-chrome">
						<span class="hp-dash-dot hp-dash-dot--red"></span>
						<span class="hp-dash-dot hp-dash-dot--yellow"></span>
						<span class="hp-dash-dot hp-dash-dot--green"></span>
						<span class="hp-dash-chrome-title">Analytics Dashboard</span>
					</div>

					<!-- KPI row -->
					<div class="hp-dash-kpis">
						<div class="hp-dash-kpi">
							<span class="hp-dash-kpi-label">Revenue</span>
							<span class="hp-dash-kpi-value">$2.4M</span>
							<span class="hp-dash-kpi-delta hp-dash-delta--up">↑ 18%</span>
						</div>
						<div class="hp-dash-kpi">
							<span class="hp-dash-kpi-label">Pipeline</span>
							<span class="hp-dash-kpi-value">641</span>
							<span class="hp-dash-kpi-delta hp-dash-delta--up">↑ 7%</span>
						</div>
						<div class="hp-dash-kpi">
							<span class="hp-dash-kpi-label">Margin</span>
							<span class="hp-dash-kpi-value">34%</span>
							<span class="hp-dash-kpi-delta hp-dash-delta--down">↓ 2%</span>
						</div>
					</div>

					<!-- Bar chart -->
					<div class="hp-dash-chart">
						<div class="hp-dash-chart-bars">
							<div class="hp-dash-bar-col">
								<div class="hp-dash-bar" style="height:55%"></div>
								<span class="hp-dash-bar-label">Jan</span>
							</div>
							<div class="hp-dash-bar-col">
								<div class="hp-dash-bar" style="height:72%"></div>
								<span class="hp-dash-bar-label">Feb</span>
							</div>
							<div class="hp-dash-bar-col">
								<div class="hp-dash-bar" style="height:48%"></div>
								<span class="hp-dash-bar-label">Mar</span>
							</div>
							<div class="hp-dash-bar-col">
								<div class="hp-dash-bar hp-dash-bar--accent" style="height:88%"></div>
								<span class="hp-dash-bar-label">Apr</span>
							</div>
							<div class="hp-dash-bar-col">
								<div class="hp-dash-bar" style="height:65%"></div>
								<span class="hp-dash-bar-label">May</span>
							</div>
							<div class="hp-dash-bar-col">
								<div class="hp-dash-bar hp-dash-bar--accent" style="height:94%"></div>
								<span class="hp-dash-bar-label">Jun</span>
							</div>
						</div>
					</div>

					<!-- Data table rows -->
					<div class="hp-dash-table">
						<div class="hp-dash-row hp-dash-row--head">
							<span>Source</span>
							<span>Records</span>
							<span>Status</span>
						</div>
						<div class="hp-dash-row">
							<span>CRM sync</span>
							<span>12,840</span>
							<span class="hp-dash-pill hp-dash-pill--ok">Live</span>
						</div>
						<div class="hp-dash-row">
							<span>Finance API</span>
							<span>3,201</span>
							<span class="hp-dash-pill hp-dash-pill--ok">Live</span>
						</div>
						<div class="hp-dash-row">
							<span>Doc pipeline</span>
							<span>894</span>
							<span class="hp-dash-pill hp-dash-pill--warn">Running</span>
						</div>
					</div>

				</div><!-- /.hp-dash -->
			</div><!-- /.hp-hero-right -->

		</div><!-- /.hp-hero-inner -->
	</div><!-- /.hp-container -->
</section><!-- /.hp-hero -->

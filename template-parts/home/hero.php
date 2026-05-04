<?php
/**
 * Template Part: Homepage Hero
 *
 * Headline options — rendering Option A:
 *
 * A (active): Custom software and data systems for finance businesses that have
 *             outgrown spreadsheets and workarounds.
 *
 * B: The software and data infrastructure your finance business is missing.
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
	<div class="hp-container">
		<div class="hp-hero-inner">

			<!-- ── Left column: content ── -->
			<div class="hp-hero-content">

				<span class="hp-eyebrow">
					<?php esc_html_e( 'Perth-based. Working with clients across Australia.', 'datalkemi' ); ?>
				</span>

				<h1 id="hero-headline" class="hp-hero-headline">
					<?php esc_html_e( 'Custom software and data systems for finance businesses that have outgrown', 'datalkemi' ); ?>
					<span class="hp-accent-text">
						<?php esc_html_e( 'spreadsheets and workarounds.', 'datalkemi' ); ?>
					</span>
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

			</div><!-- /.hp-hero-content -->

			<!-- ── Right column: graphic ── -->
			<div class="hp-hero-graphic" aria-hidden="true">

				<!--
					Minimal data-line / grid SVG motif.
					480 × 320 viewBox. Communicates "data systems" at a glance:
					- Dot-grid background via <pattern>
					- Faint Y-axis reference lines with axis labels
					- Rising trend polyline in primary colour with soft area fill
					- Circular data points and highlight ring on final point
					- Secondary dashed reference line (second metric)
				-->
				<svg
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 480 320"
					width="480"
					height="320"
					fill="none"
				>
					<defs>
						<pattern
							id="hp-grid"
							x="0"
							y="0"
							width="24"
							height="24"
							patternUnits="userSpaceOnUse"
						>
							<circle cx="1" cy="1" r="1" fill="rgba(255,255,255,0.07)" />
						</pattern>
					</defs>

					<!-- Dot grid background -->
					<rect width="480" height="320" fill="url(#hp-grid)" />

					<!-- Y-axis reference lines -->
					<g stroke="rgba(255,255,255,0.06)" stroke-width="1">
						<line x1="48" y1="60"  x2="456" y2="60" />
						<line x1="48" y1="120" x2="456" y2="120" />
						<line x1="48" y1="180" x2="456" y2="180" />
						<line x1="48" y1="240" x2="456" y2="240" />
					</g>

					<!-- Y-axis labels -->
					<g
						font-family="'Inter', system-ui, sans-serif"
						font-size="10"
						fill="rgba(255,255,255,0.2)"
						text-anchor="end"
					>
						<text x="42" y="64">100</text>
						<text x="42" y="124">75</text>
						<text x="42" y="184">50</text>
						<text x="42" y="244">25</text>
					</g>

					<!-- X-axis baseline -->
					<line
						x1="48"
						y1="260"
						x2="456"
						y2="260"
						stroke="rgba(255,255,255,0.1)"
						stroke-width="1"
					/>

					<!-- X-axis labels -->
					<g
						font-family="'Inter', system-ui, sans-serif"
						font-size="10"
						fill="rgba(255,255,255,0.2)"
						text-anchor="middle"
					>
						<text x="100" y="276">Q1</text>
						<text x="200" y="276">Q2</text>
						<text x="300" y="276">Q3</text>
						<text x="400" y="276">Q4</text>
					</g>

					<!-- Area fill under trend line -->
					<polygon
						points="100,230 150,210 200,195 250,165 300,140 350,105 400,72 400,260 100,260"
						fill="rgba(2,132,199,0.06)"
					/>

					<!-- Rising trend line -->
					<polyline
						points="100,230 150,210 200,195 250,165 300,140 350,105 400,72"
						stroke="#0284c7"
						stroke-width="2.5"
						stroke-linejoin="round"
						stroke-linecap="round"
					/>

					<!-- Secondary dashed reference line -->
					<polyline
						points="100,245 150,240 200,232 250,225 300,220 350,215 400,208"
						stroke="rgba(255,255,255,0.12)"
						stroke-width="1.5"
						stroke-dasharray="4 4"
						stroke-linejoin="round"
						stroke-linecap="round"
					/>

					<!-- Data point circles -->
					<g fill="#0284c7">
						<circle cx="100" cy="230" r="4" />
						<circle cx="200" cy="195" r="4" />
						<circle cx="300" cy="140" r="4" />
						<circle cx="400" cy="72"  r="4" />
					</g>

					<!-- Highlight ring on final data point -->
					<circle
						cx="400"
						cy="72"
						r="8"
						stroke="#38bdf8"
						stroke-width="1.5"
						fill="rgba(56,189,248,0.1)"
					/>

				</svg>

			</div><!-- /.hp-hero-graphic -->

		</div><!-- /.hp-hero-inner -->
	</div><!-- /.hp-container -->
</section><!-- /.hp-hero -->

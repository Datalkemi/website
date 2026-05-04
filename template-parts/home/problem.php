<?php
/**
 * Template Part: Homepage Problem Section
 *
 * Section heading options — rendering Option A:
 *
 * A (active): Most businesses are held back by the systems they rely on.
 *
 * B: The tools that got you here will not take you to the next stage.
 *
 * C: When your systems are slowing the business down, software is usually
 *    the answer.
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-problem" aria-labelledby="problem-heading">
	<div class="hp-container">

		<div class="hp-problem-intro">
			<span class="hp-eyebrow">
				<?php esc_html_e( 'The problem', 'datalkemi' ); ?>
			</span>
			<h2 id="problem-heading" class="hp-section-title">
				<?php esc_html_e( 'Most businesses are held back by the systems they rely on.', 'datalkemi' ); ?>
			</h2>
		</div>

		<div class="hp-problem-grid">

			<!-- Card 1: Manual processes -->
			<div class="hp-problem-card">
				<svg
					class="hp-problem-icon"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="1.5"
					stroke-linecap="round"
					stroke-linejoin="round"
					aria-hidden="true"
				>
					<!-- Document body -->
					<rect x="4" y="2" width="13" height="18" rx="2" ry="2" />
					<!-- Document lines -->
					<line x1="7" y1="7"  x2="14" y2="7" />
					<line x1="7" y1="11" x2="14" y2="11" />
					<line x1="7" y1="15" x2="11" y2="15" />
					<!-- Clock overlay (bottom-right corner) -->
					<circle cx="18" cy="18" r="4" stroke="currentColor" stroke-width="1.5" fill="none" />
					<polyline points="18,16 18,18 19.5,19.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
				</svg>

				<h3><?php esc_html_e( 'Manual work that should not exist', 'datalkemi' ); ?></h3>
				<p>
					<?php esc_html_e( 'Invoices, receipts, reconciliations, and approvals that move through email and spreadsheets introduce errors and cost hours every week. These are problems software should solve, not people.', 'datalkemi' ); ?>
				</p>
			</div><!-- /.hp-problem-card -->

			<!-- Card 2: Disconnected tools -->
			<div class="hp-problem-card">
				<svg
					class="hp-problem-icon"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="1.5"
					stroke-linecap="round"
					stroke-linejoin="round"
					aria-hidden="true"
				>
					<!-- Left node -->
					<circle cx="5" cy="12" r="3" />
					<!-- Right node -->
					<circle cx="19" cy="12" r="3" />
					<!-- Broken link: left segment -->
					<line x1="8"  y1="12" x2="10" y2="12" />
					<!-- Gap indicates disconnection -->
					<!-- Right segment -->
					<line x1="14" y1="12" x2="16" y2="12" />
					<!-- Broken link indicator (small diagonal marks) -->
					<line x1="11" y1="10" x2="13" y2="14" stroke-dasharray="1 1" />
				</svg>

				<h3><?php esc_html_e( 'Systems that do not talk to each other', 'datalkemi' ); ?></h3>
				<p>
					<?php esc_html_e( 'Your CRM, finance tools, project management software, and custom spreadsheets each hold part of the picture. The missing piece is a layer that connects them and keeps the data consistent.', 'datalkemi' ); ?>
				</p>
			</div><!-- /.hp-problem-card -->

			<!-- Card 3: Reporting -->
			<div class="hp-problem-card">
				<svg
					class="hp-problem-icon"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="1.5"
					stroke-linecap="round"
					stroke-linejoin="round"
					aria-hidden="true"
				>
					<!-- Bar chart bars (three, different heights) -->
					<rect x="3"  y="10" width="4" height="11" rx="1" />
					<rect x="10" y="6"  width="4" height="15" rx="1" />
					<rect x="17" y="13" width="4" height="8"  rx="1" />
					<!-- X-axis baseline -->
					<line x1="2" y1="21" x2="22" y2="21" />
					<!-- Question mark above right bar -->
					<text
						x="19"
						y="10"
						font-family="'Inter', system-ui, sans-serif"
						font-size="6"
						font-weight="700"
						fill="currentColor"
						stroke="none"
						text-anchor="middle"
					>?</text>
				</svg>

				<h3><?php esc_html_e( 'Reporting that lags behind the business', 'datalkemi' ); ?></h3>
				<p>
					<?php esc_html_e( 'When management reports take a day to compile and are out of date by the time they are read, decisions get made on old information. Dashboards should run themselves.', 'datalkemi' ); ?>
				</p>
			</div><!-- /.hp-problem-card -->

		</div><!-- /.hp-problem-grid -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-problem -->

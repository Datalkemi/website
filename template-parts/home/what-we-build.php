<?php
/**
 * Template Part: Homepage  -  What We Build
 *
 * Section heading options  -  rendering Option A:
 *
 * A (active): What we build
 *
 * B: Three areas of capability
 *
 * C: The work we do
 *
 * Three columns separated by borders (no card shadows).
 * Column links point to anchor sections on the Services page.
 *
 * Industries strip label options  -  rendering Option A:
 *
 * A (active): Industries we work with
 *
 * B: Who we work with
 *
 * C: Sectors we serve
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-build" aria-labelledby="build-heading">
	<div class="hp-container">

		<div class="hp-build-intro">
			<h2 id="build-heading" class="hp-section-title">
				<?php esc_html_e( 'What we build', 'datalkemi' ); ?>
			</h2>
		</div>

		<div class="hp-build-grid">

			<!-- Column 1: Custom Software -->
			<div class="hp-build-col">
				<span class="hp-build-col-label">
					<?php esc_html_e( 'Software &amp; Tools', 'datalkemi' ); ?>
				</span>
				<h3>
					<?php esc_html_e( 'Custom software and internal tools', 'datalkemi' ); ?>
				</h3>
				<p>
					<?php esc_html_e( 'Web applications, client portals, workflow automation, and integrations built to match the way your team actually operates. We scope and ship to a fixed brief, with clear milestones.', 'datalkemi' ); ?>
				</p>
				<a
					href="<?php echo esc_url( home_url( '/services/#software' ) ); ?>"
					class="hp-build-link"
				>
					<?php esc_html_e( 'Software and tools', 'datalkemi' ); ?> &rarr;
				</a>
			</div><!-- /.hp-build-col -->

			<!-- Column 2: Data & Intelligence -->
			<div class="hp-build-col">
				<span class="hp-build-col-label">
					<?php esc_html_e( 'Data &amp; Intelligence', 'datalkemi' ); ?>
				</span>
				<h3>
					<?php esc_html_e( 'Data platforms and intelligence', 'datalkemi' ); ?>
				</h3>
				<p>
					<?php esc_html_e( 'Operational dashboards, reporting pipelines, document intelligence, and machine-learning features that connect your data and surface what matters. Built on Azure, not spreadsheet formulas.', 'datalkemi' ); ?>
				</p>
				<a
					href="<?php echo esc_url( home_url( '/services/#data' ) ); ?>"
					class="hp-build-link"
				>
					<?php esc_html_e( 'Data and intelligence', 'datalkemi' ); ?> &rarr;
				</a>
			</div><!-- /.hp-build-col -->

			<!-- Column 3: Digital Presence -->
			<div class="hp-build-col">
				<span class="hp-build-col-label">
					<?php esc_html_e( 'Digital Presence', 'datalkemi' ); ?>
				</span>
				<h3>
					<?php esc_html_e( 'Websites and online platforms', 'datalkemi' ); ?>
				</h3>
				<p>
					<?php esc_html_e( 'Websites and digital platforms designed to perform, not just look good. Built on reliable infrastructure, optimised for search, and integrated with the systems behind your business.', 'datalkemi' ); ?>
				</p>
				<a
					href="<?php echo esc_url( home_url( '/services/#digital' ) ); ?>"
					class="hp-build-link"
				>
					<?php esc_html_e( 'Digital presence', 'datalkemi' ); ?> &rarr;
				</a>
			</div><!-- /.hp-build-col -->

		</div><!-- /.hp-build-grid -->

		<!-- ── Industries strip ── -->
		<div class="hp-industries">
			<p class="hp-industries-label">
				<?php
				/*
				 * Label options  -  rendering Option A:
				 *
				 * A (active): Industries we work with
				 * B: Who we work with
				 * C: Sectors we serve
				 */
				esc_html_e( 'Industries we work with', 'datalkemi' );
				?>
			</p>
			<ul class="hp-industries-list" role="list">
				<li class="hp-industry-pill"><?php esc_html_e( 'Finance', 'datalkemi' ); ?></li>
				<li class="hp-industry-pill"><?php esc_html_e( 'Professional services', 'datalkemi' ); ?></li>
				<li class="hp-industry-pill"><?php esc_html_e( 'Healthcare', 'datalkemi' ); ?></li>
				<li class="hp-industry-pill"><?php esc_html_e( 'And other operations-heavy sectors', 'datalkemi' ); ?></li>
			</ul>
		</div><!-- /.hp-industries -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-build -->

<?php
/**
 * Template Part: Homepage — Why Datalkemi
 *
 * Section heading options — rendering Option A:
 *
 * A (active): Software backed by data engineering, not the other way around.
 *
 * B: Built by a data consultant, not a web agency.
 *
 * C: Enterprise data experience. Boutique team. Direct access.
 *
 * Layout: left column (heading + intro), right column (4 numbered points).
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-why" aria-labelledby="why-heading">
	<div class="hp-container">
		<div class="hp-why-layout">

			<!-- ── Left column: heading + intro ── -->
			<div class="hp-why-left">
				<span class="hp-eyebrow">
					<?php esc_html_e( 'Why Datalkemi', 'datalkemi' ); ?>
				</span>
				<h2 id="why-heading" class="hp-section-title">
					<?php esc_html_e( 'Software backed by data engineering, not the other way around.', 'datalkemi' ); ?>
				</h2>
				<p class="hp-why-intro">
					<?php esc_html_e( 'Most software agencies are built around front-end developers who add analytics as an afterthought. Datalkemi starts from the data layer and works outward — which means the systems we build are measurable, connected, and built to last.', 'datalkemi' ); ?>
				</p>
			</div><!-- /.hp-why-left -->

			<!-- ── Right column: numbered points ── -->
			<div class="hp-why-points">

				<div class="hp-why-point">
					<span class="hp-why-point-num">01</span>
					<div class="hp-why-point-body">
						<h3><?php esc_html_e( 'Master of Data Science — UWA', 'datalkemi' ); ?></h3>
						<p>
							<?php esc_html_e( 'Datalkemi is founded by a Data and Analytics Consultant with a Master of Data Science from the University of Western Australia, with a background in enterprise data consulting.', 'datalkemi' ); ?>
						</p>
					</div>
				</div>

				<div class="hp-why-point">
					<span class="hp-why-point-num">02</span>
					<div class="hp-why-point-body">
						<h3><?php esc_html_e( 'Enterprise-scale data experience', 'datalkemi' ); ?></h3>
						<p>
							<?php esc_html_e( 'Real experience with ERPs, large-scale data migration, Azure data platforms, and production systems — not toy projects or tutorial demos.', 'datalkemi' ); ?>
						</p>
					</div>
				</div>

				<div class="hp-why-point">
					<span class="hp-why-point-num">03</span>
					<div class="hp-why-point-body">
						<h3><?php esc_html_e( 'Document intelligence and ML in production', 'datalkemi' ); ?></h3>
						<p>
							<?php esc_html_e( 'We have built and shipped systems that use machine learning and document intelligence to automate processes that used to require manual review.', 'datalkemi' ); ?>
						</p>
					</div>
				</div>

				<div class="hp-why-point">
					<span class="hp-why-point-num">04</span>
					<div class="hp-why-point-body">
						<h3><?php esc_html_e( 'Small and senior — you work with us directly', 'datalkemi' ); ?></h3>
						<p>
							<?php esc_html_e( 'No account managers, no handoffs to junior developers. The people scoping your project are the people building it.', 'datalkemi' ); ?>
						</p>
					</div>
				</div>

			</div><!-- /.hp-why-points -->

		</div><!-- /.hp-why-layout -->
	</div><!-- /.hp-container -->
</section><!-- /.hp-why -->

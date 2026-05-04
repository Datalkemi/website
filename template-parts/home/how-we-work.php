<?php
/**
 * Template Part: Homepage — How We Work
 *
 * Four-step process section. No copy options needed for this section.
 * The horizontal connector line between steps is rendered via CSS
 * (.hp-process-steps::before) — see assets/css/home.css.
 *
 * Step numbers are displayed as large faint numerals (01–04) using
 * .hp-step-number, styled with low-opacity primary colour.
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-process" aria-labelledby="process-heading">
	<div class="hp-container">

		<div class="hp-process-intro">
			<span class="hp-eyebrow">
				<?php esc_html_e( 'Our process', 'datalkemi' ); ?>
			</span>
			<h2 id="process-heading" class="hp-section-title">
				<?php esc_html_e( 'How we work', 'datalkemi' ); ?>
			</h2>
			<p class="hp-section-sub">
				<?php esc_html_e( 'Four stages. Clear ownership at each one.', 'datalkemi' ); ?>
			</p>
		</div>

		<div class="hp-process-steps">

			<div class="hp-process-step">
				<span class="hp-step-number" aria-hidden="true">01</span>
				<h3 class="hp-step-title">
					<?php esc_html_e( 'Discover', 'datalkemi' ); ?>
				</h3>
				<p class="hp-step-desc">
					<?php esc_html_e( 'We map the problem, your existing systems, and your constraints before writing a line of code.', 'datalkemi' ); ?>
				</p>
			</div>

			<div class="hp-process-step">
				<span class="hp-step-number" aria-hidden="true">02</span>
				<h3 class="hp-step-title">
					<?php esc_html_e( 'Design', 'datalkemi' ); ?>
				</h3>
				<p class="hp-step-desc">
					<?php esc_html_e( 'We propose a clear approach with defined scope, timeline, and cost. You approve before we build.', 'datalkemi' ); ?>
				</p>
			</div>

			<div class="hp-process-step">
				<span class="hp-step-number" aria-hidden="true">03</span>
				<h3 class="hp-step-title">
					<?php esc_html_e( 'Build', 'datalkemi' ); ?>
				</h3>
				<p class="hp-step-desc">
					<?php esc_html_e( 'We develop, test, and ship in iterative milestones with regular check-ins.', 'datalkemi' ); ?>
				</p>
			</div>

			<div class="hp-process-step">
				<span class="hp-step-number" aria-hidden="true">04</span>
				<h3 class="hp-step-title">
					<?php esc_html_e( 'Support', 'datalkemi' ); ?>
				</h3>
				<p class="hp-step-desc">
					<?php esc_html_e( 'We stay on as a technical partner after launch. You have direct access to the team that built it.', 'datalkemi' ); ?>
				</p>
			</div>

		</div><!-- /.hp-process-steps -->

	</div><!-- /.hp-container -->
</section><!-- /.hp-process -->

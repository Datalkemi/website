<?php
/**
 * Template Part: Homepage  -  About Snippet
 *
 * Single-column text layout. Founder photo removed.
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-about" aria-labelledby="about-heading">
	<div class="hp-container">
		<div class="hp-about-text">

			<span class="hp-eyebrow">
				<?php esc_html_e( 'About', 'datalkemi' ); ?>
			</span>

			<h2 id="about-heading">
				<?php esc_html_e( 'About Datalkemi', 'datalkemi' ); ?>
			</h2>

			<p>
				<?php esc_html_e( 'Datalkemi is founded by Naufal, a Data and Analytics Consultant with a Master of Data Science from the University of Western Australia. Before founding Datalkemi, he worked across enterprise data consulting, delivering data migration projects, building reporting systems, and working with organisations on ERP implementations and analytics infrastructure.', 'datalkemi' ); ?>
			</p>

			<p>
				<?php esc_html_e( 'Datalkemi exists because the gap between what businesses need and what most software agencies can build is wider than it should be. We work with a small number of clients at a time, which means the work gets the attention it deserves.', 'datalkemi' ); ?>
			</p>

			<a
				href="<?php echo esc_url( home_url( '/about/' ) ); ?>"
				class="hp-btn-text"
			>
				<?php esc_html_e( 'More about Datalkemi', 'datalkemi' ); ?>
			</a>

		</div><!-- /.hp-about-text -->
	</div><!-- /.hp-container -->
</section><!-- /.hp-about -->

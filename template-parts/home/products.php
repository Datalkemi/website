<?php
/**
 * Template Part: Homepage Products
 *
 * Overview of Exnami, the household finance app built and run by Datalkemi.
 *
 * @package Datalkemi
 * @since   2.1.0
 */

$points = [
	[ 'One number that matters', 'Cash across every account plus available credit, so you know what you can actually spend today.' ],
	[ 'Bills before they bite',  'Rent, subscriptions, loan repayments, and card due dates on a calendar, with a nudge before each one.' ],
	[ 'Split without the spreadsheet', 'Share a dinner or a trip, see who owes whom, and settle up inside the app.' ],
];
?>

<section class="hp-products" aria-labelledby="products-heading">
	<div class="hp-container">
		<div class="hp-products-layout">

			<div class="hp-products-copy">
				<span class="hp-eyebrow"><?php esc_html_e( 'Our products', 'datalkemi' ); ?></span>
				<h2 id="products-heading" class="hp-section-title"><?php esc_html_e( 'Exnami, the household finance app', 'datalkemi' ); ?></h2>
				<p class="hp-section-sub"><?php esc_html_e( 'We build software for clients, and we build our own. Exnami connects your accounts, budgets, debts, and income into one clear view. Free to use, no ads, and your data stays yours.', 'datalkemi' ); ?></p>

				<ul class="hp-products-points">
					<?php foreach ( $points as $pt ) : ?>
						<li>
							<strong><?php echo esc_html( $pt[0] ); ?></strong>
							<span><?php echo esc_html( $pt[1] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="hp-products-actions">
					<a href="<?php echo esc_url( home_url( '/exnami/' ) ); ?>" class="hp-btn-primary"><?php esc_html_e( 'Explore Exnami', 'datalkemi' ); ?></a>
					<a href="https://www.exnami.com/" class="hp-btn-text" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Open the app', 'datalkemi' ); ?></a>
				</div>
			</div>

			<figure class="hp-products-figure">
				<img src="<?php echo esc_url( DATALKEMI_URI . '/assets/img/products/exnami-dashboard.jpg' ); ?>"
					alt="<?php esc_attr_e( 'The Exnami dashboard: spendable now, net for the month, and upcoming payments', 'datalkemi' ); ?>"
					width="2000" height="1118" loading="lazy">
			</figure>

		</div>
	</div>
</section><!-- /.hp-products -->

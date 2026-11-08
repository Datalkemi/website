<?php
/**
 * Template Name: Our Products
 *
 * Landing page for products built and run by Datalkemi. Add entries to
 * $products as new ones launch; the header dropdown is a WordPress menu.
 *
 * @package Datalkemi
 * @since   2.1.0
 */
get_header();

$products = [
	[
		'name'  => 'Exnami',
		'tag'   => 'Household finance app',
		'desc'  => 'See every dollar and spend with confidence. Accounts, budgets, bills, debts, and shared costs in one clear view, free to use and private by design.',
		'shot'  => 'exnami-dashboard',
		'page'  => home_url( '/exnami/' ),
		'app'   => 'https://www.exnami.com/',
	],
];
?>

<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Our products', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Software we build', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'and run ourselves', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle">
			<?php esc_html_e( 'Alongside client work, Datalkemi builds its own products. They are where we test ideas end to end, and they are free to use.', 'datalkemi' ); ?>
		</p>
	</div>
</section>

<section class="dk-section">
	<div class="dk-container">
		<div class="products-grid">
			<?php foreach ( $products as $p ) : ?>
				<article class="dk-card product-card">
					<div class="product-card-media">
						<?php datalkemi_product_shot( $p['shot'], sprintf( __( 'The %s dashboard', 'datalkemi' ), $p['name'] ) ); ?>
					</div>
					<p class="project-category"><?php echo esc_html( $p['tag'] ); ?></p>
					<h2><?php echo esc_html( $p['name'] ); ?></h2>
					<p><?php echo esc_html( $p['desc'] ); ?></p>
					<div class="project-actions">
						<a href="<?php echo esc_url( $p['page'] ); ?>" class="dk-btn dk-btn-primary"><?php esc_html_e( 'About the product', 'datalkemi' ); ?></a>
						<a href="<?php echo esc_url( $p['app'] ); ?>" class="dk-btn dk-btn-outline" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Open the app', 'datalkemi' ); ?></a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_footer();

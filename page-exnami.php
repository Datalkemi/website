<?php
/**
 * Template Name: Exnami Product
 *
 * Product page for Exnami, the household finance app built and run by
 * Datalkemi. Copy mirrors exnami.com so the two stay consistent.
 *
 * @package Datalkemi
 * @since   2.1.0
 */
get_header();

$app_url = 'https://www.exnami.com/';
$icon    = 'xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';

$features = [
	[
		'title' => 'Real spendable balance',
		'desc'  => 'Cash across every account plus available credit, converted to your currency. The number that actually matters, up top.',
		'svg'   => '<svg ' . $icon . '><rect x="2" y="5" width="20" height="14" rx="1"/><path d="M2 10h20"/><path d="M6 15h4"/></svg>',
	],
	[
		'title' => 'Multidimensional views',
		'desc'  => 'Slice the same spending by category, by month or week, and by goal. Three lenses on one truth.',
		'svg'   => '<svg ' . $icon . '><path d="M12 3 2 8l10 5 10-5-10-5z"/><path d="M2 13l10 5 10-5"/></svg>',
	],
	[
		'title' => 'Ahead of every bill',
		'desc'  => 'Bills, debt repayments, and card due dates land on your calendar before they hit your balance.',
		'svg'   => '<svg ' . $icon . '><rect x="3" y="4" width="18" height="17" rx="1"/><path d="M3 9h18"/><path d="M8 2v4M16 2v4"/><path d="M9 15l2 2 4-4"/></svg>',
	],
	[
		'title' => 'Budgets that fit you',
		'desc'  => 'Monthly, fortnightly, or weekly, with per-category limits and goal budgets for the big items.',
		'svg'   => '<svg ' . $icon . '><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></svg>',
	],
	[
		'title' => 'Debts and cards, handled',
		'desc'  => 'Loan amortisation, repayment schedules, statements, and pay a card from your bank in one move.',
		'svg'   => '<svg ' . $icon . '><path d="M3 12h18"/><path d="M12 3v18"/><circle cx="12" cy="12" r="9"/></svg>',
	],
	[
		'title' => 'Split with friends',
		'desc'  => 'Share an expense, track who owes whom, and settle up. No awkward spreadsheets.',
		'svg'   => '<svg ' . $icon . '><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3 20a6 6 0 0 1 12 0"/><path d="M15 20a5 5 0 0 1 7-4.5"/></svg>',
	],
];

$stats = [
	[ '3 ways',       'to see every expense: category, time, purpose' ],
	[ 'All accounts', 'bank, savings, cash, and credit cards in one balance' ],
	[ '5 countries',  'income tax estimates built in' ],
	[ '0 ads',        'we never sell or mine your data' ],
];

$privacy = [
	'Row-level security so only you can read your records',
	'Encrypted in transit, passwords only ever stored hashed',
	'Export or permanently delete your data at any time',
];

$stack = [
	[ 'Next.js and React', 'An installable progressive web app that works on a phone, tablet, or desktop.' ],
	[ 'Supabase and PostgreSQL', 'A relational schema of more than forty tables, isolated per user with row-level security.' ],
	[ 'Vercel, Sydney region', 'Deployed close to Australian users, with push notifications for upcoming bills.' ],
];
?>

<!-- Hero -->
<section class="page-hero">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'A product by Datalkemi', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Exnami. See every dollar.', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'Spend with confidence.', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle">
			<?php esc_html_e( 'Exnami connects your accounts, budgets, debts, and income into one clear view, so you always know what you can actually spend, and where your money really goes. Free to use, private by design.', 'datalkemi' ); ?>
		</p>
		<div class="hero-buttons product-hero-buttons">
			<a href="<?php echo esc_url( $app_url ); ?>" class="dk-btn dk-btn-primary" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'Start tracking free', 'datalkemi' ); ?>
			</a>
			<a href="<?php echo esc_url( $app_url ); ?>" class="dk-btn dk-btn-outline" target="_blank" rel="noopener noreferrer" style="border-color:var(--text); color:var(--text);">
				<?php esc_html_e( 'Visit exnami.com', 'datalkemi' ); ?>
			</a>
		</div>
		<p class="product-hero-note"><?php esc_html_e( 'No card required. No ads, ever. Delete anytime.', 'datalkemi' ); ?></p>
	</div>
</section>

<!-- Screenshot and stats -->
<section class="dk-section product-intro">
	<div class="dk-container">
		<figure class="product-screen">
			<img src="<?php echo esc_url( DATALKEMI_URI . '/assets/img/products/exnami-hero.jpg' ); ?>"
				alt="<?php esc_attr_e( 'The Exnami dashboard showing spendable balance, income against spend, and category breakdown', 'datalkemi' ); ?>"
				width="1200" height="750" loading="lazy">
		</figure>
		<div class="product-stats">
			<?php foreach ( $stats as $s ) : ?>
				<div class="product-stat">
					<p class="product-stat-figure"><?php echo esc_html( $s[0] ); ?></p>
					<p class="product-stat-label"><?php echo esc_html( $s[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Features -->
<section class="dk-section product-features">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'The whole picture', 'datalkemi' ); ?></p>
			<h2 class="product-heading"><?php esc_html_e( 'Not another transaction list', 'datalkemi' ); ?></h2>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Most apps show you what you spent. Exnami shows you what it means, and what you can do next.', 'datalkemi' ); ?></p>
		</div>
		<div class="dk-grid-3">
			<?php foreach ( $features as $f ) : ?>
				<div class="dk-card product-feature">
					<span class="product-feature-icon"><?php echo $f['svg']; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<h3 class="product-feature-title"><?php echo esc_html( $f['title'] ); ?></h3>
					<p class="product-feature-desc"><?php echo esc_html( $f['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Privacy -->
<section class="dk-section product-privacy">
	<div class="dk-container product-two-col">
		<div>
			<p class="section-eyebrow"><?php esc_html_e( 'Privacy first', 'datalkemi' ); ?></p>
			<h2 class="product-heading"><?php esc_html_e( 'Your money is nobody else\'s business', 'datalkemi' ); ?></h2>
			<p class="product-copy"><?php esc_html_e( 'Exnami is built on a simple rule: your financial data belongs to you, and only you. It is isolated per user at the database level, never sold, and never used for ads.', 'datalkemi' ); ?></p>
			<ul class="feature-list">
				<?php foreach ( $privacy as $line ) : ?>
					<li class="feature-item">
						<span class="feature-check"><svg <?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput ?>><path d="M20 6 9 17l-5-5"/></svg></span>
						<span class="feature-text"><?php echo esc_html( $line ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<p class="section-eyebrow"><?php esc_html_e( 'Why not a generic app', 'datalkemi' ); ?></p>
			<h2 class="product-heading"><?php esc_html_e( 'Built for clarity, not for selling you things', 'datalkemi' ); ?></h2>
			<div class="product-reasons">
				<div>
					<h3><?php esc_html_e( 'No product pushing', 'datalkemi' ); ?></h3>
					<p><?php esc_html_e( 'No credit card or loan recommendations and no referral fees. The app works for you.', 'datalkemi' ); ?></p>
				</div>
				<div>
					<h3><?php esc_html_e( 'No paywalled basics', 'datalkemi' ); ?></h3>
					<p><?php esc_html_e( 'Multidimensional views and budgets are standard, not a premium upsell.', 'datalkemi' ); ?></p>
				</div>
				<div>
					<h3><?php esc_html_e( 'Yours to control', 'datalkemi' ); ?></h3>
					<p><?php esc_html_e( 'Currencies, tax country, budget periods, even your chart colours. Configure it your way.', 'datalkemi' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- How it is built -->
<section class="dk-section product-stack">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'How it is built', 'datalkemi' ); ?></p>
			<h2 class="product-heading"><?php esc_html_e( 'The same engineering we bring to client work', 'datalkemi' ); ?></h2>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Exnami is our own product, built and run by Datalkemi. It is the reference build for the data-backed applications we deliver for clients.', 'datalkemi' ); ?></p>
		</div>
		<div class="dk-grid-3">
			<?php foreach ( $stack as $s ) : ?>
				<div class="dk-card">
					<h3 class="product-feature-title"><?php echo esc_html( $s[0] ); ?></h3>
					<p class="product-feature-desc"><?php echo esc_html( $s[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<p class="product-stack-cta">
			<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-outline">
				<?php esc_html_e( 'Build something like this', 'datalkemi' ); ?>
			</a>
		</p>
	</div>
</section>

<!-- CTA -->
<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title"><?php esc_html_e( 'Start seeing your money clearly', 'datalkemi' ); ?></h2>
			<p class="cta-banner-subtitle"><?php esc_html_e( 'Free to use. Record your first expense in under a minute.', 'datalkemi' ); ?></p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( $app_url ); ?>" class="dk-btn dk-btn-primary" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'Create your free account', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer();

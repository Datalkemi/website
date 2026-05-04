<?php
/**
 * Template Part: Homepage  -  About Snippet
 *
 * Two-column layout: company text left, credentials panel right.
 *
 * @package Datalkemi
 * @since   2.0.0
 */
?>

<section class="hp-about" aria-labelledby="about-heading">
	<div class="hp-container">
		<div class="hp-about-layout">

			<!-- ── Left: company text ── -->
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

			<!-- ── Right: credentials panel ── -->
			<div class="hp-about-creds" aria-hidden="true">
				<ul class="hp-cred-list" role="list">

					<li class="hp-cred-item">
						<span class="hp-cred-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
						</span>
						<div>
							<strong><?php esc_html_e( 'Master of Data Science', 'datalkemi' ); ?></strong>
							<span><?php esc_html_e( 'University of Western Australia', 'datalkemi' ); ?></span>
						</div>
					</li>

					<li class="hp-cred-item">
						<span class="hp-cred-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
						</span>
						<div>
							<strong><?php esc_html_e( 'Enterprise data consulting', 'datalkemi' ); ?></strong>
							<span><?php esc_html_e( 'ERP, Azure data platforms, large-scale migration', 'datalkemi' ); ?></span>
						</div>
					</li>

					<li class="hp-cred-item">
						<span class="hp-cred-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="23" y1="11" x2="23" y2="17"/><line x1="20" y1="14" x2="26" y2="14"/></svg>
						</span>
						<div>
							<strong><?php esc_html_e( 'Small client roster', 'datalkemi' ); ?></strong>
							<span><?php esc_html_e( 'You work directly with the person building your system', 'datalkemi' ); ?></span>
						</div>
					</li>

					<li class="hp-cred-item">
						<span class="hp-cred-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
						</span>
						<div>
							<strong><?php esc_html_e( 'Perth-based', 'datalkemi' ); ?></strong>
							<span><?php esc_html_e( 'Working with clients across Australia and beyond', 'datalkemi' ); ?></span>
						</div>
					</li>

				</ul>
			</div><!-- /.hp-about-creds -->

		</div><!-- /.hp-about-layout -->
	</div><!-- /.hp-container -->
</section><!-- /.hp-about -->

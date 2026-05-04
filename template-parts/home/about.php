<?php
/**
 * About section  -  homepage
 */
$usps = [
	[ 'title' => 'One team, full stack',     'desc' => 'Design through data in-house. No outsourcing, no broken handoffs.' ],
	[ 'title' => 'Defined before it starts', 'desc' => 'Scope, timeline, and deliverables fixed in writing before any invoice is raised.' ],
	[ 'title' => 'Outcomes, not outputs',    'desc' => 'We agree on success metrics at kickoff. You always know what return you are getting.' ],
	[ 'title' => 'Support past go-live',     'desc' => 'Every project includes a structured post-launch period. We do not disappear after delivery.' ],
];
?>
<section id="about" class="dk-section">
	<div class="dk-container">

		<div class="dk-grid-2" style="gap:4rem; align-items:center;">

			<!-- Story -->
			<div>
				<p class="section-eyebrow">About Datalkemi</p>
				<h2 class="dk-section-title" style="text-align:left; margin-bottom:1.5rem !important;">
					Built at the Intersection of<br>
					<span class="gradient-text">Design, Code, and Data</span>
				</h2>
				<p class="about-text">
					Most businesses have great products but lack the digital presence and data capability to show it. That gap is not a talent problem. It is a technology and strategy problem. Datalkemi was built to close it.
				</p>
				<p class="about-text">
					We combine web development, strategic design, and data science so clients get the full digital stack they actually need, handled by one team, from brief to delivery.
				</p>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="dk-btn dk-btn-outline" style="margin-top:1.5rem;">
					<?php esc_html_e( 'More About Us', 'datalkemi' ); ?>
				</a>
			</div>

			<!-- Why Choose Us -->
			<div class="dk-glass" style="padding:2rem 2.25rem;">
				<p style="font-size:0.8125rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:var(--color-accent); margin-bottom:1.25rem;">
					<?php esc_html_e( 'Why Datalkemi', 'datalkemi' ); ?>
				</p>
				<?php foreach ( $usps as $usp ) : ?>
				<div class="usp-item" style="margin-bottom:1rem;">
					<span class="usp-check">&#10003;</span>
					<div>
						<strong style="color:#f9fafb; font-size:0.9375rem; display:block; margin-bottom:0.2rem;">
							<?php echo esc_html( $usp['title'] ); ?>
						</strong>
						<span class="usp-text"><?php echo esc_html( $usp['desc'] ); ?></span>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>

<?php
/**
 * About section
 */
$usps = [
	__( 'Client-Centric Approach: Your success is our priority.', 'datalkemi' ),
	__( 'Innovative Solutions: Leveraging cutting-edge technologies.', 'datalkemi' ),
	__( 'Transparent Communication: Keeping you informed every step.', 'datalkemi' ),
	__( 'Quality Driven: Delivering excellence in every project.', 'datalkemi' ),
	__( 'Data-Powered Insights: Making decisions based on facts.', 'datalkemi' ),
];
?>
<section id="about" style="background: var(--color-bg);">
	<div class="container">

		<div style="text-align:center; margin-bottom:4rem;">
			<h2 class="section-title gradient-text"><?php esc_html_e( 'About Datalkemi', 'datalkemi' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Pioneering digital transformation through expert web development and insightful data analytics.', 'datalkemi' ); ?></p>
		</div>

		<div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:start;">

			<!-- Story / Mission / Vision -->
			<div>
				<h3 style="font-size:1.5rem; font-weight:600; color:var(--color-primary); margin-bottom:1rem; display:flex; align-items:center; gap:0.75rem;">
					&#128101; <?php esc_html_e( 'Our Story', 'datalkemi' ); ?>
				</h3>
				<p style="color:var(--color-text-muted); line-height:1.8; margin-bottom:1.5rem;">
					<?php esc_html_e( 'Datalkemi was founded with a singular vision: to empower businesses by bridging the gap between innovative technology and actionable intelligence. We are a team of passionate developers, designers, and data scientists dedicated to crafting bespoke digital solutions that drive growth and efficiency.', 'datalkemi' ); ?>
				</p>
				<div style="margin-bottom:1.5rem;">
					<h4 style="font-size:1.125rem; font-weight:600; color:var(--color-accent); margin-bottom:0.5rem;">&#127919; <?php esc_html_e( 'Our Mission', 'datalkemi' ); ?></h4>
					<p style="color:var(--color-text-muted); line-height:1.8;">
						<?php esc_html_e( 'To deliver exceptional digital experiences and data-driven strategies that enable businesses to thrive in an ever-evolving technological landscape.', 'datalkemi' ); ?>
					</p>
				</div>
				<div>
					<h4 style="font-size:1.125rem; font-weight:600; color:var(--color-accent); margin-bottom:0.5rem;">&#9889; <?php esc_html_e( 'Our Vision', 'datalkemi' ); ?></h4>
					<p style="color:var(--color-text-muted); line-height:1.8;">
						<?php esc_html_e( 'To be a leading partner in digital innovation, recognised for our expertise, integrity, and transformative impact on businesses globally.', 'datalkemi' ); ?>
					</p>
				</div>
			</div>

			<!-- Why Choose Us -->
			<div class="glassmorphism" style="padding:2rem; border-radius:0.75rem;">
				<h3 style="font-size:1.5rem; font-weight:600; color:var(--color-primary); margin-bottom:1.5rem;">
					<?php esc_html_e( 'Why Choose Us?', 'datalkemi' ); ?>
				</h3>
				<ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:1rem;">
					<?php foreach ( $usps as $usp ) : ?>
						<li style="display:flex; align-items:flex-start; gap:0.75rem;">
							<span style="color:#4ade80; font-size:1.25rem; flex-shrink:0;">&#10003;</span>
							<span style="color:#e5e7eb;"><?php echo esc_html( $usp ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

		</div>
	</div>
</section>

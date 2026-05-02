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
<section id="about" class="dk-section">
	<div class="dk-container">

		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'About Datalkemi', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'Pioneering digital transformation through expert web development and insightful data analytics.', 'datalkemi' ); ?></p>
		</div>

		<div class="dk-grid-2">

			<!-- Story / Mission / Vision -->
			<div>
				<h3 class="about-story-title">&#128101; <?php esc_html_e( 'Our Story', 'datalkemi' ); ?></h3>
				<p class="about-text">
					<?php esc_html_e( 'Datalkemi was founded with a singular vision: to empower businesses by bridging the gap between innovative technology and actionable intelligence. We are a team of passionate developers, designers, and data scientists dedicated to crafting bespoke digital solutions that drive growth and efficiency.', 'datalkemi' ); ?>
				</p>
				<div>
					<h4 class="about-subtitle">&#127919; <?php esc_html_e( 'Our Mission', 'datalkemi' ); ?></h4>
					<p class="about-text">
						<?php esc_html_e( 'To deliver exceptional digital experiences and data-driven strategies that enable businesses to thrive in an ever-evolving technological landscape.', 'datalkemi' ); ?>
					</p>
				</div>
				<div>
					<h4 class="about-subtitle">&#9889; <?php esc_html_e( 'Our Vision', 'datalkemi' ); ?></h4>
					<p class="about-text">
						<?php esc_html_e( 'To be a leading partner in digital innovation, recognised for our expertise, integrity, and transformative impact on businesses globally.', 'datalkemi' ); ?>
					</p>
				</div>
			</div>

			<!-- Why Choose Us -->
			<div class="dk-glass" style="padding:2rem;">
				<h3 class="about-story-title"><?php esc_html_e( 'Why Choose Us?', 'datalkemi' ); ?></h3>
				<ul class="usp-list">
					<?php foreach ( $usps as $usp ) : ?>
						<li class="usp-item">
							<span class="usp-check">&#10003;</span>
							<span class="usp-text"><?php echo esc_html( $usp ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

		</div>
	</div>
</section>

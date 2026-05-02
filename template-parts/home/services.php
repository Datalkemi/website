<?php
/**
 * Services section
 */
$services = [
	[ 'icon' => '&#127912;', 'title' => __( 'Website Design', 'datalkemi' ),              'desc' => __( 'Crafting visually stunning, user-centric designs that reflect your brand and engage your audience effectively.', 'datalkemi' ) ],
	[ 'icon' => '&#128187;', 'title' => __( 'Full-Stack Web Development', 'datalkemi' ),  'desc' => __( 'Building robust, scalable, and high-performance websites and applications from frontend to backend.', 'datalkemi' ) ],
	[ 'icon' => '&#128269;', 'title' => __( 'In-Code SEO Optimisation', 'datalkemi' ),    'desc' => __( "Integrating SEO best practices directly into your website's architecture for enhanced visibility and ranking.", 'datalkemi' ) ],
	[ 'icon' => '&#128202;', 'title' => __( 'Data Analytics Solutions', 'datalkemi' ),    'desc' => __( 'Transforming complex data into actionable insights to drive informed business decisions and growth strategies.', 'datalkemi' ) ],
	[ 'icon' => '&#128203;', 'title' => __( 'Business Intelligence & Reporting', 'datalkemi' ), 'desc' => __( 'Developing comprehensive BI solutions and interactive reports to monitor performance and uncover opportunities.', 'datalkemi' ) ],
	[ 'icon' => '&#128200;', 'title' => __( 'Custom Dashboards', 'datalkemi' ),            'desc' => __( 'Creating tailored dashboards that provide a clear, real-time view of your key performance indicators.', 'datalkemi' ) ],
];
?>
<section id="services" class="dk-section">
	<div class="dk-container">

		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Our Expertise', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'We provide a wide array of services designed to elevate your business in the digital and data-driven landscape.', 'datalkemi' ); ?></p>
		</div>

		<div class="dk-grid-3">
			<?php foreach ( $services as $service ) : ?>
				<div class="dk-card" style="text-align:center;">
					<span class="service-icon"><?php echo $service['icon']; ?></span>
					<h3 class="service-title"><?php echo esc_html( $service['title'] ); ?></h3>
					<p class="service-desc"><?php echo esc_html( $service['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

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
<section id="services" style="background: rgba(31,41,55,0.3);">
	<div class="container">

		<div style="text-align:center; margin-bottom:4rem;">
			<h2 class="section-title gradient-text"><?php esc_html_e( 'Our Expertise', 'datalkemi' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'We provide a wide array of services designed to elevate your business in the digital and data-driven landscape.', 'datalkemi' ); ?></p>
		</div>

		<div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:2rem;">
			<?php foreach ( $services as $service ) : ?>
				<div class="card" style="text-align:center;">
					<div style="font-size:2.5rem; margin-bottom:1rem;"><?php echo $service['icon']; ?></div>
					<h3 style="font-size:1.25rem; font-weight:600; color:#f9fafb; margin-bottom:0.75rem;">
						<?php echo esc_html( $service['title'] ); ?>
					</h3>
					<p style="color:var(--color-text-muted); line-height:1.7; font-size:0.9375rem;">
						<?php echo esc_html( $service['desc'] ); ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

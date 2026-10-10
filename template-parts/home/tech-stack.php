<?php
/**
 * Tech Stack section
 */
$categories = [
	// Brand ladder only: ink, teal, azure, sky, slate.
	[ 'name' => __( 'Frontend', 'datalkemi' ),      'border' => '#0688C0', 'tools' => [ 'React', 'Vite', 'Tailwind CSS', 'Figma', 'HTML5', 'CSS3', 'JavaScript (ES6+)' ] ],
	[ 'name' => __( 'Backend', 'datalkemi' ),       'border' => '#02587C', 'tools' => [ 'Node.js', 'Python (Django/Flask)', 'Express.js', 'REST APIs', 'GraphQL' ] ],
	[ 'name' => __( 'Databases', 'datalkemi' ),     'border' => '#022D3F', 'tools' => [ 'SQL (PostgreSQL, MySQL)', 'NoSQL (MongoDB)', 'Supabase', 'Firebase' ] ],
	[ 'name' => __( 'Data & BI', 'datalkemi' ),     'border' => '#51CBFF', 'tools' => [ 'Power BI', 'Tableau', 'Pandas', 'NumPy', 'Scikit-learn', 'Jupyter' ] ],
	[ 'name' => __( 'DevOps & Cloud', 'datalkemi' ),'border' => '#5E7F91', 'tools' => [ 'AWS', 'Docker', 'Git & GitHub', 'Netlify', 'Vercel', 'CI/CD' ] ],
	[ 'name' => __( 'General Tools', 'datalkemi' ), 'border' => '#0688C0', 'tools' => [ 'VS Code', 'NPM/Yarn', 'ESLint', 'Prettier', 'Jira', 'Slack' ] ],
];
?>
<section id="tech-stack" class="dk-section">
	<div class="dk-container">

		<div class="dk-section-header">
			<span class="dk-section-title"><?php esc_html_e( 'Our Technology Stack', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle"><?php esc_html_e( 'We leverage a modern and robust set of tools and technologies to deliver high-quality solutions.', 'datalkemi' ); ?></p>
		</div>

		<div class="dk-grid-3">
			<?php foreach ( $categories as $cat ) : ?>
				<div class="dk-glass tech-card" style="border-top:4px solid <?php echo esc_attr( $cat['border'] ); ?>;">
					<h3 class="tech-name"><?php echo esc_html( $cat['name'] ); ?></h3>
					<ul class="tech-list">
						<?php foreach ( $cat['tools'] as $tool ) : ?>
							<li><?php echo esc_html( $tool ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

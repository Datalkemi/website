<?php
/**
 * Tech Stack section
 */
$categories = [
	[ 'name' => __( 'Frontend', 'datalkemi' ),      'border' => '#0ea5e9', 'tools' => [ 'React', 'Vite', 'Tailwind CSS', 'Figma', 'HTML5', 'CSS3', 'JavaScript (ES6+)' ] ],
	[ 'name' => __( 'Backend', 'datalkemi' ),       'border' => '#10b981', 'tools' => [ 'Node.js', 'Python (Django/Flask)', 'Express.js', 'REST APIs', 'GraphQL' ] ],
	[ 'name' => __( 'Databases', 'datalkemi' ),     'border' => '#f43f5e', 'tools' => [ 'SQL (PostgreSQL, MySQL)', 'NoSQL (MongoDB)', 'Supabase', 'Firebase' ] ],
	[ 'name' => __( 'Data & BI', 'datalkemi' ),     'border' => '#f59e0b', 'tools' => [ 'Power BI', 'Tableau', 'Pandas', 'NumPy', 'Scikit-learn', 'Jupyter' ] ],
	[ 'name' => __( 'DevOps & Cloud', 'datalkemi' ),'border' => '#a855f7', 'tools' => [ 'AWS', 'Docker', 'Git & GitHub', 'Netlify', 'Vercel', 'CI/CD' ] ],
	[ 'name' => __( 'General Tools', 'datalkemi' ), 'border' => '#6366f1', 'tools' => [ 'VS Code', 'NPM/Yarn', 'ESLint', 'Prettier', 'Jira', 'Slack' ] ],
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

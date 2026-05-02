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
<section id="tech-stack" style="background: rgba(17,24,39,0.7);">
	<div class="container">

		<div style="text-align:center; margin-bottom:4rem;">
			<h2 class="section-title gradient-text"><?php esc_html_e( 'Our Technology Stack', 'datalkemi' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'We leverage a modern and robust set of tools and technologies to deliver high-quality solutions.', 'datalkemi' ); ?></p>
		</div>

		<div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:2rem;">
			<?php foreach ( $categories as $cat ) : ?>
				<div class="glassmorphism" style="border-top: 4px solid <?php echo esc_attr( $cat['border'] ); ?>; border-radius:0.75rem; padding:2rem; text-align:center;">
					<h3 style="font-size:1.25rem; font-weight:600; color:#f9fafb; margin-bottom:1.25rem;">
						<?php echo esc_html( $cat['name'] ); ?>
					</h3>
					<ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:0.5rem;">
						<?php foreach ( $cat['tools'] as $tool ) : ?>
							<li style="color:var(--color-text-muted); font-size:0.9375rem;"><?php echo esc_html( $tool ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<?php
/**
 * Template Name: About Page
 * About Us — company story, mission, vision, values, process, team.
 */
get_header();

$values = [
	[ 'icon' => '&#127919;', 'title' => 'Client-First Always',    'desc' => 'Every decision we make starts with one question: does this serve our client\'s best interest? We measure our success by yours.' ],
	[ 'icon' => '&#128200;', 'title' => 'Data-Driven Thinking',   'desc' => 'We don\'t rely on gut feelings. Every recommendation we make is backed by data, research, and measurable outcomes.' ],
	[ 'icon' => '&#9889;',   'title' => 'Relentless Innovation',  'desc' => 'Technology moves fast. We stay ahead. Our team continuously learns, experiments, and adopts new tools that give our clients an edge.' ],
	[ 'icon' => '&#128274;', 'title' => 'Transparency',           'desc' => 'No hidden fees, no vague timelines, no surprises. You always know exactly where your project stands and why we\'re recommending what we are.' ],
	[ 'icon' => '&#127775;', 'title' => 'Excellence in Craft',    'desc' => 'Good enough is never good enough. We hold our work to the highest standards — from clean code and pixel-perfect design to meticulous data quality.' ],
	[ 'icon' => '&#129309;', 'title' => 'Long-Term Partnership',  'desc' => 'We\'re not a transactional agency. We invest in understanding your business deeply and building relationships that grow with you.' ],
];

$stats = [
	[ 'number' => '50+',  'label' => 'Projects Delivered' ],
	[ 'number' => '98%',  'label' => 'Client Satisfaction' ],
	[ 'number' => '6+',   'label' => 'Years of Expertise' ],
	[ 'number' => '12+',  'label' => 'Industries Served' ],
];

$process = [
	[ 'step' => '01', 'title' => 'Discovery',       'desc' => 'We start every engagement with a structured discovery process — understanding your business model, goals, existing systems, competitive landscape, and the problems you need solved.' ],
	[ 'step' => '02', 'title' => 'Strategy',         'desc' => 'Informed by discovery, we develop a clear, prioritised strategy. You receive a detailed proposal with scope, timeline, milestones, and success metrics before any work begins.' ],
	[ 'step' => '03', 'title' => 'Design & Build',   'desc' => 'Work is delivered in collaborative sprints with regular demos and reviews. You\'re involved throughout — not just at the start and end.' ],
	[ 'step' => '04', 'title' => 'Test & Refine',    'desc' => 'Everything is rigorously tested before delivery. We address every piece of feedback methodically and transparently, documenting all changes.' ],
	[ 'step' => '05', 'title' => 'Launch & Support', 'desc' => 'We oversee every launch to ensure a smooth go-live. Post-launch, we provide structured support and ongoing optimisation to ensure you keep growing.' ],
];

$team_members = new WP_Query( [
	'post_type'      => 'team_member',
	'posts_per_page' => 12,
	'post_status'    => 'publish',
	'orderby'        => 'meta_value_num',
	'meta_key'       => '_team_order',
	'order'          => 'ASC',
] );
?>

<!-- Page Hero -->
<section class="page-hero page-hero--about">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'About Datalkemi', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'We Turn Technology Into', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'Tangible Business Value', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle">
			<?php esc_html_e( 'Datalkemi is a digital agency built at the intersection of web development, design, and data intelligence. We partner with ambitious businesses to build digital products and data capabilities that drive real growth.', 'datalkemi' ); ?>
		</p>
	</div>
</section>

<!-- Stats strip -->
<section class="stats-section">
	<div class="dk-container">
		<div class="stats-grid">
			<?php foreach ( $stats as $stat ) : ?>
				<div class="stat-item">
					<span class="stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
					<span class="stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Story section -->
<section class="dk-section" id="our-story">
	<div class="dk-container">
		<div class="dk-grid-2" style="gap:4rem; align-items:center;">
			<div>
				<p class="section-eyebrow"><?php esc_html_e( 'Our Story', 'datalkemi' ); ?></p>
				<h2 class="dk-section-title" style="text-align:left; margin-bottom:1.5rem !important;">
					<?php esc_html_e( 'Built on a Belief That Data and Design Should Work Together', 'datalkemi' ); ?>
				</h2>
				<p class="about-text">
					<?php esc_html_e( 'Datalkemi was founded on a simple but powerful observation: most businesses had great products and services, but lacked the digital presence and data capabilities to show it. The gap between what companies could achieve and what they were achieving wasn\'t a talent gap — it was a technology and strategy gap.', 'datalkemi' ); ?>
				</p>
				<p class="about-text">
					<?php esc_html_e( 'We built Datalkemi to close that gap. Our name reflects what we do: we apply chemistry to data — transforming raw, complex information into something beautiful, useful, and actionable. We combine expert web development, strategic design, and deep data science to give our clients the full digital stack they need.', 'datalkemi' ); ?>
				</p>
				<p class="about-text">
					<?php esc_html_e( 'Today we work with businesses across industries — from startups building their digital presence for the first time to established companies transforming their data operations. Every engagement starts with the same commitment: your success is the only metric we care about.', 'datalkemi' ); ?>
				</p>
			</div>
			<div style="display:flex; flex-direction:column; gap:1.5rem;">
				<div class="dk-glass about-highlight-card">
					<div class="about-highlight-icon">&#127919;</div>
					<div>
						<h3 class="about-subtitle"><?php esc_html_e( 'Our Mission', 'datalkemi' ); ?></h3>
						<p class="about-text" style="margin-bottom:0 !important;">
							<?php esc_html_e( 'To deliver exceptional digital experiences and data-driven strategies that enable businesses to thrive in an ever-evolving technological landscape.', 'datalkemi' ); ?>
						</p>
					</div>
				</div>
				<div class="dk-glass about-highlight-card">
					<div class="about-highlight-icon">&#9889;</div>
					<div>
						<h3 class="about-subtitle"><?php esc_html_e( 'Our Vision', 'datalkemi' ); ?></h3>
						<p class="about-text" style="margin-bottom:0 !important;">
							<?php esc_html_e( 'To be the most trusted partner for businesses seeking to harness the power of technology and data — recognised globally for integrity, expertise, and transformative impact.', 'datalkemi' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Values section -->
<section class="dk-section values-section" id="our-values">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'What Drives Us', 'datalkemi' ); ?></p>
			<span class="dk-section-title"><?php esc_html_e( 'Our Core Values', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle">
				<?php esc_html_e( 'These aren\'t corporate platitudes. These are the principles we apply to every project, every client interaction, and every decision we make.', 'datalkemi' ); ?>
			</p>
		</div>
		<div class="dk-grid-3">
			<?php foreach ( $values as $value ) : ?>
				<div class="dk-card value-card">
					<span class="value-icon"><?php echo $value['icon']; ?></span>
					<h3 class="value-title"><?php echo esc_html( $value['title'] ); ?></h3>
					<p class="value-desc"><?php echo esc_html( $value['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- How We Work -->
<section class="dk-section" id="how-we-work">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'Our Approach', 'datalkemi' ); ?></p>
			<span class="dk-section-title"><?php esc_html_e( 'How We Work', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle">
				<?php esc_html_e( 'A structured, transparent process that keeps you informed and in control at every stage — from first conversation to post-launch growth.', 'datalkemi' ); ?>
			</p>
		</div>
		<div class="process-timeline">
			<?php foreach ( $process as $step ) : ?>
				<div class="process-step">
					<div class="process-step-number"><?php echo esc_html( $step['step'] ); ?></div>
					<div class="process-step-content">
						<h3 class="process-step-title"><?php echo esc_html( $step['title'] ); ?></h3>
						<p class="process-step-desc"><?php echo esc_html( $step['desc'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Team section -->
<section class="dk-section team-section" id="our-team">
	<div class="dk-container">
		<div class="dk-section-header">
			<p class="section-eyebrow"><?php esc_html_e( 'The People Behind the Work', 'datalkemi' ); ?></p>
			<span class="dk-section-title"><?php esc_html_e( 'Meet the Team', 'datalkemi' ); ?></span>
			<p class="dk-section-subtitle">
				<?php esc_html_e( 'A diverse team of developers, designers, and data scientists united by a shared commitment to doing excellent work for our clients.', 'datalkemi' ); ?>
			</p>
		</div>

		<?php if ( $team_members->have_posts() ) : ?>
			<div class="team-grid">
				<?php while ( $team_members->have_posts() ) : $team_members->the_post();
					$role     = get_post_meta( get_the_ID(), '_team_role', true );
					$linkedin = get_post_meta( get_the_ID(), '_team_linkedin', true );
					$github   = get_post_meta( get_the_ID(), '_team_github', true );
					$twitter  = get_post_meta( get_the_ID(), '_team_twitter', true );
				?>
					<div class="team-card">
						<div class="team-card-photo">
							<?php if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'medium', [ 'class' => 'team-photo' ] );
							else : ?>
								<div class="team-photo-placeholder">
									<?php echo esc_html( substr( get_the_title(), 0, 1 ) ); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="team-card-info">
							<h3 class="team-name"><?php the_title(); ?></h3>
							<?php if ( $role ) : ?>
								<p class="team-role"><?php echo esc_html( $role ); ?></p>
							<?php endif; ?>
							<?php if ( get_the_content() ) : ?>
								<p class="team-bio"><?php echo wp_kses_post( wpautop( get_the_content() ) ); ?></p>
							<?php endif; ?>
							<div class="team-social">
								<?php if ( $linkedin ) : ?>
									<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="team-social-link">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
									</a>
								<?php endif; ?>
								<?php if ( $github ) : ?>
									<a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="team-social-link">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<!-- Placeholder team cards while team CPT is being populated -->
			<div class="team-grid">
				<?php
				$placeholder_team = [
					[ 'name' => 'Your Name', 'role' => 'Founder & Lead Developer', 'initial' => 'D' ],
					[ 'name' => 'Team Member', 'role' => 'Data Scientist', 'initial' => 'T' ],
					[ 'name' => 'Team Member', 'role' => 'UX Designer', 'initial' => 'T' ],
				];
				foreach ( $placeholder_team as $member ) : ?>
					<div class="team-card">
						<div class="team-card-photo">
							<div class="team-photo-placeholder"><?php echo esc_html( $member['initial'] ); ?></div>
						</div>
						<div class="team-card-info">
							<h3 class="team-name"><?php echo esc_html( $member['name'] ); ?></h3>
							<p class="team-role"><?php echo esc_html( $member['role'] ); ?></p>
							<p class="team-bio" style="font-style:italic; opacity:0.6;">
								<?php esc_html_e( 'Add team member bio in WP Admin → Team Members.', 'datalkemi' ); ?>
							</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- CTA section -->
<section class="cta-banner">
	<div class="dk-container cta-banner-inner">
		<div>
			<h2 class="cta-banner-title"><?php esc_html_e( 'Ready to Start Something Great?', 'datalkemi' ); ?></h2>
			<p class="cta-banner-subtitle"><?php esc_html_e( 'Tell us about your project and let\'s explore how Datalkemi can help you achieve your goals.', 'datalkemi' ); ?></p>
		</div>
		<div class="cta-banner-actions">
			<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary">
				<?php esc_html_e( 'Get a Free Quote', 'datalkemi' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dk-btn dk-btn-outline" style="border-color:#fff; color:#fff;">
				<?php esc_html_e( 'Contact Us', 'datalkemi' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>

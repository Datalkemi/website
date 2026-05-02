<?php
/**
 * Blog archive (used when a page is set as Posts Page in Reading Settings).
 * URL: /insights/ (or /blog/ depending on setup-content.php settings)
 */
get_header();

$current_cat = get_query_var( 'cat' ) ? get_query_var( 'cat' ) : 0;
$cats        = get_categories( [ 'hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC' ] );
?>

<!-- Page Hero -->
<section class="page-hero page-hero--compact">
	<div class="page-hero-overlay"></div>
	<div class="dk-container page-hero-content">
		<p class="page-hero-eyebrow"><?php esc_html_e( 'Knowledge Base', 'datalkemi' ); ?></p>
		<h1 class="page-hero-title">
			<?php esc_html_e( 'Insights &', 'datalkemi' ); ?><br>
			<span class="gradient-text"><?php esc_html_e( 'Technical Writing', 'datalkemi' ); ?></span>
		</h1>
		<p class="page-hero-subtitle">
			<?php esc_html_e( 'Practical guides, case studies, and technical breakdowns from the Datalkemi team.', 'datalkemi' ); ?>
		</p>
	</div>
</section>

<!-- Category filter -->
<?php if ( ! empty( $cats ) ) : ?>
<div class="insights-filter-bar" style="background:rgba(17,24,39,0.98); border-bottom:1px solid rgba(255,255,255,0.06); padding:1rem 0; position:sticky; top:70px; z-index:50;">
	<div class="dk-container">
		<div class="filter-bar" style="flex-wrap:nowrap; overflow-x:auto; padding-bottom:2px;">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/insights/' ) ); ?>"
				class="filter-pill <?php echo ! $current_cat ? 'filter-pill--active' : ''; ?>">
				<?php esc_html_e( 'All', 'datalkemi' ); ?>
			</a>
			<?php foreach ( $cats as $cat ) : ?>
				<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
					class="filter-pill <?php echo $current_cat === $cat->term_id ? 'filter-pill--active' : ''; ?>">
					<?php echo esc_html( $cat->name ); ?>
					<span style="opacity:0.5; font-size:0.75em; margin-left:0.25rem;"><?php echo $cat->count; ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<!-- Posts grid -->
<section class="dk-section" style="background:var(--color-bg);">
	<div class="dk-container">

		<?php if ( have_posts() ) : ?>
			<div class="insights-grid">
				<?php while ( have_posts() ) : the_post();
					$cats_post  = get_the_category();
					$cat_name   = ! empty( $cats_post ) ? $cats_post[0]->name : '';
					$cat_link   = ! empty( $cats_post ) ? get_category_link( $cats_post[0]->term_id ) : '#';
					$word_count = str_word_count( strip_tags( get_the_content() ) );
					$read_time  = max( 1, ceil( $word_count / 200 ) );
					$likes      = (int) get_post_meta( get_the_ID(), 'dk_like_count',    true );
					$dislikes   = (int) get_post_meta( get_the_ID(), 'dk_dislike_count', true );
					$voted      = $_COOKIE[ 'dk_voted_' . get_the_ID() ] ?? '';
				?>
				<article class="insights-card dk-glass" data-post-id="<?php the_ID(); ?>">

					<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="insights-card-thumb">
						<?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy' ] ); ?>
					</a>
					<?php endif; ?>

					<div class="insights-card-body">

						<div class="insights-card-meta">
							<?php if ( $cat_name ) : ?>
								<a href="<?php echo esc_url( $cat_link ); ?>" class="insights-cat"><?php echo esc_html( $cat_name ); ?></a>
							<?php endif; ?>
							<span class="insights-date"><?php echo get_the_date( 'd M Y' ); ?></span>
							<span class="insights-read-time"><?php echo $read_time; ?> min read</span>
						</div>

						<h2 class="insights-card-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>

						<p class="insights-card-excerpt"><?php echo wp_trim_words( get_the_excerpt() ?: get_the_content(), 22, '...' ); ?></p>

						<div class="insights-card-footer">
							<a href="<?php the_permalink(); ?>" class="insights-read-more">
								<?php esc_html_e( 'Read article', 'datalkemi' ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
							</a>
							<div class="insights-reactions">
								<button class="reaction-btn reaction-btn--like <?php echo $voted === 'like' ? 'is-voted' : ''; ?>"
									data-post="<?php the_ID(); ?>" data-reaction="like" title="Helpful"
									<?php echo $voted ? 'disabled' : ''; ?>>
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"/><path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
									<span class="reaction-count"><?php echo $likes ?: ''; ?></span>
								</button>
								<button class="reaction-btn reaction-btn--dislike <?php echo $voted === 'dislike' ? 'is-voted' : ''; ?>"
									data-post="<?php the_ID(); ?>" data-reaction="dislike" title="Not helpful"
									<?php echo $voted ? 'disabled' : ''; ?>>
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3H10z"/><path d="M17 2h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"/></svg>
									<span class="reaction-count"><?php echo $dislikes ?: ''; ?></span>
								</button>
								<?php if ( get_comments_number() > 0 ) : ?>
									<a href="<?php the_permalink(); ?>#comments" class="reaction-btn" title="Comments">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
										<span class="reaction-count"><?php echo get_comments_number(); ?></span>
									</a>
								<?php endif; ?>
							</div>
						</div>

					</div>
				</article>
				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<div class="insights-pagination">
				<?php
				echo paginate_links( [
					'prev_text' => '&larr; Newer',
					'next_text' => 'Older &rarr;',
					'type'      => 'list',
				] );
				?>
			</div>

		<?php else : ?>
			<div style="text-align:center; padding:5rem 0;">
				<p class="dk-section-subtitle"><?php esc_html_e( 'No articles yet. Check back soon.', 'datalkemi' ); ?></p>
			</div>
		<?php endif; ?>

	</div>
</section>

<?php get_footer(); ?>

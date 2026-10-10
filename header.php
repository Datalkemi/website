<?php
/**
 * Custom nav walker must be defined before wp_nav_menu() is called.
 */
if ( ! class_exists( 'Datalkemi_Nav_Walker' ) ) :
class Datalkemi_Nav_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );
		$class  = $depth === 0 ? 'sub-menu nav-dropdown' : 'sub-menu nav-sub-dropdown';
		$output .= "\n$indent<ul class=\"$class\">\n";
	}
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes   = empty( $item->classes ) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if ( $item->current ) { $classes[] = 'current-menu-item'; }
		if ( in_array( 'menu-item-has-children', $classes, true ) && $depth === 0 ) {
			$classes[] = 'nav-has-dropdown';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$output .= '<li class="' . esc_attr( $class_names ) . '">';
		$atts = [
			'href'   => $item->url,
			'title'  => $item->attr_title,
			'target' => $item->target,
			'rel'    => $item->xfn,
			'class'  => 'nav-link',
		];
		if ( $depth > 0 ) { $atts['class'] = 'nav-dropdown-link'; }
		$attr_string = '';
		foreach ( $atts as $key => $val ) {
			if ( ! empty( $val ) ) {
				$attr_string .= ' ' . $key . '="' . esc_attr( $val ) . '"';
			}
		}
		$title   = apply_filters( 'the_title', $item->title, $item->ID );
		$arrow   = ( in_array( 'menu-item-has-children', $classes, true ) && $depth === 0 )
			? '<span class="nav-arrow">&#8963;</span>'
			: '';
		$output .= "<a{$attr_string}>{$title}{$arrow}</a>";
	}
}
endif;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( ! has_site_icon() ) : // Brand: favicons carry the mark, never the wordmark ?>
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( DATALKEMI_URI . '/assets/brand/mark/Datalkemi_Logo_Colour.svg' ); ?>">
	<link rel="alternate icon" type="image/png" href="<?php echo esc_url( DATALKEMI_URI . '/assets/brand/mark/Datalkemi_Logo_Colour.png' ); ?>">
	<?php endif; ?>
	<script>
	/* Apply the saved theme before paint so there is no flash. Light is the brand default. */
	(function () {
		var t = 'light';
		try { var s = localStorage.getItem('dk-theme'); if (s === 'light' || s === 'dark') { t = s; } } catch (e) {}
		document.documentElement.setAttribute('data-theme', t);
	})();
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
	<nav class="site-nav">
		<!-- Logo -->
		<div class="nav-brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo-link" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				<img class="nav-logo dk-logo-light"
					src="<?php echo esc_url( DATALKEMI_URI . '/assets/brand/wordmark-tagline/Datalkemi_Text_Tagline_Colour.svg' ); ?>"
					alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="200" height="39">
				<img class="nav-logo dk-logo-dark"
					src="<?php echo esc_url( DATALKEMI_URI . '/assets/brand/wordmark-tagline/Datalkemi_Text_Tagline_Reverse.svg' ); ?>"
					alt="" aria-hidden="true" width="200" height="39">
			</a>
		</div>

		<!-- Mobile toggle -->
		<button class="nav-toggle" aria-controls="primary-menu" aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle menu', 'datalkemi' ); ?>">
			<span></span><span></span><span></span>
		</button>

		<!-- Primary menu + CTA -->
		<div class="nav-menu-wrap" id="primary-menu-wrap">
			<?php
			// Strip client-portal item from the public nav  -  it is not a marketing page
			add_filter( 'wp_nav_menu_objects', function( $items ) {
				return array_filter( $items, function( $item ) {
					return strpos( $item->url, '/client-portal' ) === false;
				} );
			} );
			wp_nav_menu( [
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'container'      => false,
				'menu_class'     => 'nav-menu',
				'fallback_cb'    => false,
				'walker'         => new Datalkemi_Nav_Walker(),
			] ); ?>

			<div class="nav-actions">
				<button type="button" class="dk-theme-toggle" data-theme-toggle
					aria-label="<?php esc_attr_e( 'Switch to dark theme', 'datalkemi' ); ?>">
					<svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
					<svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
				</button>
				<?php if ( is_user_logged_in() ) :
					$user       = wp_get_current_user();
					$is_client  = in_array( 'client', (array) $user->roles, true );
					$portal_url = $is_client ? home_url( '/client-portal/' ) : admin_url();
				?>
					<a href="<?php echo esc_url( $portal_url ); ?>" class="dk-btn dk-btn-outline nav-portal-btn">
						<?php echo $is_client ? esc_html__( 'My Portal', 'datalkemi' ) : esc_html__( 'Dashboard', 'datalkemi' ); ?>
					</a>
					<?php if ( $is_client ) : ?>
					<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="nav-text-link">
						<?php esc_html_e( 'Sign Out', 'datalkemi' ); ?>
					</a>
					<?php endif; ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/get-a-quote/' ) ); ?>" class="dk-btn dk-btn-primary nav-portal-btn">
						<?php esc_html_e( 'Get a Quote', 'datalkemi' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</nav>
</header>

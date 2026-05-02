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
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
	<nav class="site-nav">
		<!-- Logo -->
		<div class="nav-brand">
			<?php if ( has_custom_logo() ) :
				the_custom_logo();
			else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title-link">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- Mobile toggle -->
		<button class="nav-toggle" aria-controls="primary-menu" aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle menu', 'datalkemi' ); ?>">
			<span></span><span></span><span></span>
		</button>

		<!-- Primary menu + portal button -->
		<div class="nav-menu-wrap" id="primary-menu-wrap">
			<?php wp_nav_menu( [
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'container'      => false,
				'menu_class'     => 'nav-menu',
				'fallback_cb'    => false,
				'walker'         => new Datalkemi_Nav_Walker(),
			] ); ?>

			<div class="nav-actions">
				<?php if ( is_user_logged_in() ) :
					$user = wp_get_current_user();
					$portal_url = in_array( 'client', (array) $user->roles, true )
						? home_url( '/client-portal/' )
						: admin_url();
				?>
					<a href="<?php echo esc_url( $portal_url ); ?>" class="dk-btn dk-btn-outline nav-portal-btn">
						<?php esc_html_e( 'My Portal', 'datalkemi' ); ?>
					</a>
					<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="nav-text-link">
						<?php esc_html_e( 'Sign Out', 'datalkemi' ); ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/client-portal/' ) ); ?>" class="dk-btn dk-btn-outline nav-portal-btn">
						<?php esc_html_e( 'Client Portal', 'datalkemi' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</nav>
</header>

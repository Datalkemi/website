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
	<nav class="site-nav container">
		<div class="nav-brand">
			<?php if ( has_custom_logo() ) :
				the_custom_logo();
			else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<button class="nav-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'datalkemi' ); ?>">
			<span></span><span></span><span></span>
		</button>

		<?php wp_nav_menu( [
			'theme_location' => 'primary',
			'menu_id'        => 'primary-menu',
			'container'      => 'div',
			'container_class'=> 'nav-menu-wrap',
			'menu_class'     => 'nav-menu',
			'fallback_cb'    => false,
		] ); ?>
	</nav>
</header>

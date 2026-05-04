<?php
/**
 * Homepage SEO: JSON-LD schema, Open Graph, and Twitter Card meta tags.
 * Hooked into wp_head on the front page only.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_head', 'datalkemi_homepage_seo', 1 );

function datalkemi_homepage_seo(): void {
	if ( ! is_front_page() ) {
		return;
	}

	$site_url   = esc_url( home_url( '/' ) );
	$site_name  = get_bloginfo( 'name' );
	$site_desc  = get_bloginfo( 'description' );
	$logo_url   = esc_url( DATALKEMI_URI . '/assets/img/logo.png' );
	$og_image   = esc_url( DATALKEMI_URI . '/assets/img/og-home.jpg' );
	$twitter    = '@datalkemi';

	// ── JSON-LD: Organization + ProfessionalService ──────────────────────────
	$schema = [
		'@context'        => 'https://schema.org',
		'@graph'          => [
			[
				'@type'           => 'Organization',
				'@id'             => $site_url . '#organization',
				'name'            => 'Datalkemi',
				'url'             => $site_url,
				'logo'            => [
					'@type' => 'ImageObject',
					'url'   => $logo_url,
				],
				'sameAs'          => [
					'https://www.linkedin.com/company/datalkemi',
				],
				'address'         => [
					'@type'            => 'PostalAddress',
					'addressLocality'  => 'Perth',
					'addressRegion'    => 'WA',
					'addressCountry'   => 'AU',
				],
				'contactPoint'    => [
					'@type'       => 'ContactPoint',
					'email'       => 'info@datalkemi.com',
					'contactType' => 'customer service',
				],
			],
			[
				'@type'            => 'ProfessionalService',
				'@id'              => $site_url . '#service',
				'name'             => 'Datalkemi',
				'url'              => $site_url,
				'description'      => 'Custom software and data systems for finance businesses. Perth-based, working with clients across Australia.',
				'provider'         => [ '@id' => $site_url . '#organization' ],
				'areaServed'       => 'AU',
				'serviceType'      => [
					'Custom Software Development',
					'Data Platform Engineering',
					'Document Intelligence',
					'Business Intelligence Dashboards',
					'Internal Tools Development',
				],
				'knowsAbout'       => [
					'Data Analytics',
					'Business Intelligence',
					'Azure Data Services',
					'Machine Learning',
					'Web Application Development',
					'Finance Industry Technology',
				],
			],
		],
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";

	// ── Open Graph ───────────────────────────────────────────────────────────
	?>
	<meta property="og:type"        content="website">
	<meta property="og:url"         content="<?php echo $site_url; ?>">
	<meta property="og:site_name"   content="<?php echo esc_attr( $site_name ); ?>">
	<meta property="og:title"       content="<?php echo esc_attr( $site_name ); ?> - Custom Software &amp; Data Systems">
	<meta property="og:description" content="Custom software and data systems for finance businesses that have outgrown spreadsheets. Perth-based, working with clients across Australia.">
	<meta property="og:image"       content="<?php echo $og_image; ?>">
	<meta property="og:image:width"  content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:locale"      content="en_AU">
	<?php

	// ── Twitter Card ─────────────────────────────────────────────────────────
	?>
	<meta name="twitter:card"        content="summary_large_image">
	<meta name="twitter:site"        content="<?php echo esc_attr( $twitter ); ?>">
	<meta name="twitter:title"       content="<?php echo esc_attr( $site_name ); ?> - Custom Software &amp; Data Systems">
	<meta name="twitter:description" content="Custom software and data systems for finance businesses that have outgrown spreadsheets. Perth-based, working with clients across Australia.">
	<meta name="twitter:image"       content="<?php echo $og_image; ?>">
	<?php
}

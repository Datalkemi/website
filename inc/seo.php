<?php
/**
 * Theme SEO module.
 *
 * No SEO plugin runs on this site, so the theme owns search metadata:
 * document titles, meta descriptions, canonical links for archives,
 * hreflang between the Australian and Indian website development pages,
 * Open Graph and Twitter tags, structured data (JSON-LD), robots rules,
 * and the core sitemap contents.
 *
 * Page copy for titles and descriptions lives in datalkemi_seo_pages().
 * Service pages can override theirs with seo_title and seo_desc in
 * inc/service-data.php.
 *
 * @package Datalkemi
 * @since   2.5.0
 */

defined( 'ABSPATH' ) || exit;

const DATALKEMI_SEO_BRAND = 'Datalkemi';

/**
 * Titles and descriptions for pages, keyed by page slug.
 * Titles stay under about 60 characters and descriptions under 160.
 *
 * @return array<string, array{title: string, desc: string}>
 */
function datalkemi_seo_pages(): array {
	return [
		'home' => [
			'title' => 'Website Development Company in Australia and India | Datalkemi',
			'desc'  => 'Datalkemi builds fast, search-ready websites, web applications and data systems for businesses in Perth, across Australia and in India. Websites from A$500.',
		],
		'about' => [
			'title' => 'About Datalkemi | Website and Software Developers in Perth',
			'desc'  => 'Datalkemi is a Perth web development and data agency. We design, build and look after websites, web apps and reporting for businesses in Australia and India.',
		],
		'services' => [
			'title' => 'Website Development, SEO and Data Services | Datalkemi',
			'desc'  => 'Website design, full-stack web development, SEO, data analytics, business intelligence and custom dashboards, delivered from Perth to clients in Australia and India.',
		],
		'projects' => [
			'title' => 'Website and Software Projects | Datalkemi Case Studies',
			'desc'  => 'Websites, booking platforms and web applications we have built for businesses in Australia and India, with the brief, what we built and the outcome.',
		],
		'insights' => [
			'title' => 'Insights on Websites, SEO and Data | Datalkemi',
			'desc'  => 'Practical guides and technical write-ups on website development, SEO and data from the Datalkemi team in Perth.',
		],
		'contact' => [
			'title' => 'Contact Datalkemi | Website Development Enquiries',
			'desc'  => 'Talk to Datalkemi about a new website, web application or data project. Based in Perth, Western Australia, working with clients across Australia and India.',
		],
		'products' => [
			'title' => 'Our Products | Software Built by Datalkemi',
			'desc'  => 'Products Datalkemi builds and runs itself, including Exnami, a free household finance app. Free to use and private by design.',
		],
		'exnami' => [
			'title' => 'Exnami Household Finance App | Datalkemi',
			'desc'  => 'Exnami brings your accounts, budgets, debts and income into one clear view, so you know what you can spend. Free to use and private by design.',
		],
		'build-your-project' => [
			'title' => 'Website Cost Calculator | Estimate Your Project | Datalkemi',
			'desc'  => 'Work out what your website or web app will cost in AUD or USD. Choose the purpose and features, and see your estimate instantly. Websites from A$500.',
		],
		'get-a-quote' => [
			'title' => 'Get a Website Development Quote | Datalkemi',
			'desc'  => 'Tell us about your website or software project and receive a detailed, transparent proposal from Datalkemi. No obligation.',
		],
		'website-development-india' => [
			'title' => 'Website Development Services for Businesses in India | Datalkemi',
			'desc'  => 'Custom websites, online stores and web applications for businesses in India, built by Datalkemi. Working hours that overlap with IST and clear fixed quotes.',
		],
		'privacy-policy' => [
			'title' => 'Privacy Policy | Datalkemi',
			'desc'  => 'How Datalkemi collects, uses, stores and protects personal information, and how to access or correct yours.',
		],
		'terms-of-service' => [
			'title' => 'Terms of Service | Datalkemi',
			'desc'  => 'The terms that apply when you use datalkemi.com or engage Datalkemi for website, software or data work.',
		],
		'cookie-policy' => [
			'title' => 'Cookie Policy | Datalkemi',
			'desc'  => 'What datalkemi.com stores in your browser, why, and how to change your cookie choice at any time.',
		],
		'client-portal' => [
			'title' => 'Client Portal | Datalkemi',
			'desc'  => 'Sign in to the Datalkemi client portal.',
		],
	];
}

/**
 * Pages that should never appear in search results or the sitemap.
 *
 * @return string[]
 */
function datalkemi_seo_hidden_slugs(): array {
	return [ 'client-portal', 'sample-page', 'blog' ];
}

/**
 * Localised versions of the website development landing page.
 * Each URL lists every version, as hreflang requires.
 *
 * @return array<string, string> hreflang code to path.
 */
function datalkemi_seo_hreflang_set(): array {
	return [
		'en-AU'     => '/services/web-development/',
		'en-IN'     => '/website-development-india/',
		'x-default' => '/services/web-development/',
	];
}

/**
 * Shortens text to a clean meta description length.
 */
function datalkemi_seo_trim( string $text, int $max = 158 ): string {
	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( strip_shortcodes( $text ) ) ) );
	if ( mb_strlen( $text ) <= $max ) {
		return $text;
	}
	$cut   = mb_substr( $text, 0, $max );
	$space = mb_strrpos( $cut, ' ' );
	return rtrim( mb_substr( $cut, 0, $space ?: $max ), ' ,.;:' ) . '.';
}

/**
 * Current URL path relative to the site root, with a trailing slash.
 */
function datalkemi_seo_current_path(): string {
	$path = wp_parse_url( home_url( add_query_arg( [] ) ), PHP_URL_PATH ) ?: '/';
	$home = wp_parse_url( home_url( '/' ), PHP_URL_PATH ) ?: '/';
	$rel  = '/' . ltrim( substr( $path, strlen( rtrim( $home, '/' ) ) ), '/' );
	return trailingslashit( $rel );
}

/**
 * Works out the metadata for the current request once and caches it.
 *
 * @return array{title: string, desc: string, url: string, image: string, image_w: int, image_h: int, type: string, crumbs: array, faqs: array, service: array, locale: string}
 */
function datalkemi_seo_context(): array {
	static $ctx = null;
	if ( null !== $ctx ) {
		return $ctx;
	}

	$pages = datalkemi_seo_pages();
	$ctx   = [
		'title'   => '',
		'desc'    => '',
		'url'     => '',
		'image'   => DATALKEMI_URI . '/assets/img/og-home.jpg',
		'image_w' => 1200,
		'image_h' => 630,
		'type'    => 'website',
		'crumbs'  => [],
		'faqs'    => [],
		'service' => [],
		'locale'  => 'en_AU',
	];
	$home_crumb = [ 'name' => 'Home', 'url' => home_url( '/' ) ];

	if ( is_front_page() ) {
		$ctx['title'] = $pages['home']['title'];
		$ctx['desc']  = $pages['home']['desc'];
		$ctx['url']   = home_url( '/' );

	} elseif ( is_home() ) {
		$ctx['title']  = $pages['insights']['title'];
		$ctx['desc']   = $pages['insights']['desc'];
		$ctx['url']    = get_permalink( (int) get_option( 'page_for_posts' ) ) ?: home_url( '/insights/' );
		$ctx['crumbs'] = [ $home_crumb, [ 'name' => 'Insights', 'url' => $ctx['url'] ] ];

	} elseif ( is_post_type_archive( 'project' ) ) {
		$ctx['title']  = $pages['projects']['title'];
		$ctx['desc']   = $pages['projects']['desc'];
		$ctx['url']    = get_post_type_archive_link( 'project' );
		$ctx['crumbs'] = [ $home_crumb, [ 'name' => 'Projects', 'url' => $ctx['url'] ] ];

	} elseif ( is_tax( [ 'project_industry', 'project_type' ] ) || is_category() || is_tag() ) {
		$term          = get_queried_object();
		$is_project    = is_tax( [ 'project_industry', 'project_type' ] );
		$ctx['title']  = $term->name . ( $is_project ? ' Projects' : ' Articles' ) . ' | ' . DATALKEMI_SEO_BRAND;
		$ctx['desc']   = $term->description
			? datalkemi_seo_trim( $term->description )
			: ( $is_project
				? sprintf( '%s projects by Datalkemi: websites, web applications and data systems for businesses in Australia and India.', $term->name )
				: sprintf( 'Datalkemi articles about %s.', $term->name ) );
		$ctx['url']    = get_term_link( $term );
		$parent        = $is_project
			? [ 'name' => 'Projects', 'url' => get_post_type_archive_link( 'project' ) ]
			: [ 'name' => 'Insights', 'url' => home_url( '/insights/' ) ];
		$ctx['crumbs'] = [ $home_crumb, $parent, [ 'name' => $term->name, 'url' => $ctx['url'] ] ];

	} elseif ( is_singular() ) {
		$post         = get_queried_object();
		$slug         = $post->post_name;
		$title        = get_the_title( $post );
		$ctx['url']   = get_permalink( $post );

		if ( has_post_thumbnail( $post ) ) {
			$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'full' );
			if ( $img ) {
				$ctx['image']   = $img[0];
				$ctx['image_w'] = (int) $img[1];
				$ctx['image_h'] = (int) $img[2];
			}
		}

		if ( 'page' === $post->post_type ) {
			$ctx['title']  = $pages[ $slug ]['title'] ?? $title . ' | ' . DATALKEMI_SEO_BRAND;
			$ctx['desc']   = $pages[ $slug ]['desc'] ?? datalkemi_seo_trim( $post->post_excerpt ?: $post->post_content );
			$ctx['crumbs'] = [ $home_crumb, [ 'name' => $title, 'url' => $ctx['url'] ] ];

			if ( 'website-development-india' === $slug && function_exists( 'datalkemi_india_page_data' ) ) {
				$india          = datalkemi_india_page_data();
				$ctx['locale']  = 'en_IN';
				$ctx['faqs']    = $india['faqs'];
				$ctx['service'] = [
					'name'       => 'Website development for businesses in India',
					'type'       => 'Website development',
					'areaServed' => [ 'IN' ],
				];
			}
		} elseif ( 'service' === $post->post_type ) {
			$data          = function_exists( 'datalkemi_get_service_data' ) ? datalkemi_get_service_data( $slug ) : [];
			$ctx['title']  = $data['seo_title'] ?? $title . ' Services in Perth, Australia | ' . DATALKEMI_SEO_BRAND;
			$ctx['desc']   = $data['seo_desc'] ?? datalkemi_seo_trim( ( $data['tagline'] ?? '' ) . '. ' . ( $data['overview'] ?? $post->post_content ) );
			$ctx['faqs']   = $data['faqs'] ?? [];
			$ctx['crumbs'] = [
				$home_crumb,
				[ 'name' => 'Services', 'url' => home_url( '/services/' ) ],
				[ 'name' => $data['crumb'] ?? $title, 'url' => $ctx['url'] ],
			];
			$ctx['service'] = [
				'name'       => $data['h1'] ?? $title,
				'type'       => $title,
				'areaServed' => [ 'AU', 'IN' ],
				'from_aud'   => $data['from_aud'] ?? 0,
			];
		} elseif ( 'project' === $post->post_type ) {
			$ctx['title']  = $title . ' | Datalkemi Projects';
			$ctx['desc']   = datalkemi_seo_trim( $post->post_excerpt ?: $post->post_content );
			$ctx['type']   = 'article';
			$ctx['crumbs'] = [
				$home_crumb,
				[ 'name' => 'Projects', 'url' => get_post_type_archive_link( 'project' ) ],
				[ 'name' => $title, 'url' => $ctx['url'] ],
			];
			if ( ! has_post_thumbnail( $post ) && file_exists( DATALKEMI_DIR . '/assets/img/projects/' . $slug . '.jpg' ) ) {
				$ctx['image'] = DATALKEMI_URI . '/assets/img/projects/' . $slug . '.jpg';
				$size         = wp_getimagesize( DATALKEMI_DIR . '/assets/img/projects/' . $slug . '.jpg' );
				$ctx['image_w'] = $size ? (int) $size[0] : 0;
				$ctx['image_h'] = $size ? (int) $size[1] : 0;
			}
		} else {
			$ctx['title']  = $title . ' | Datalkemi Insights';
			$ctx['desc']   = datalkemi_seo_trim( $post->post_excerpt ?: $post->post_content );
			$ctx['type']   = 'article';
			$ctx['crumbs'] = [
				$home_crumb,
				[ 'name' => 'Insights', 'url' => home_url( '/insights/' ) ],
				[ 'name' => $title, 'url' => $ctx['url'] ],
			];
		}
	}

	if ( '' === $ctx['desc'] ) {
		$ctx['desc'] = $pages['home']['desc'];
	}

	$paged = max( 1, (int) get_query_var( 'paged' ) );
	if ( $paged > 1 && $ctx['url'] ) {
		$ctx['url']    = get_pagenum_link( $paged );
		$ctx['title'] .= ' | Page ' . $paged;
	}

	return $ctx;
}

// ── Document title ──────────────────────────────────────────────────────────
add_filter( 'pre_get_document_title', function ( $title ) {
	if ( is_404() || is_search() ) {
		return $title;
	}
	$ctx = datalkemi_seo_context();
	return $ctx['title'] ?: $title;
}, 20 );

add_filter( 'document_title_separator', function () {
	return '|';
} );

// ── Language attribute for the India page ───────────────────────────────────
add_filter( 'language_attributes', function ( $output ) {
	if ( is_page( 'website-development-india' ) ) {
		$output = preg_replace( '/lang="[^"]*"/', 'lang="en-IN"', $output );
	}
	return $output;
} );

// ── Robots ──────────────────────────────────────────────────────────────────
add_filter( 'wp_robots', function ( array $robots ) {
	if ( is_page( datalkemi_seo_hidden_slugs() ) || is_author() ) {
		return [ 'noindex' => true, 'follow' => true ];
	}
	if ( ! is_404() && ! is_search() ) {
		$robots['max-image-preview'] = 'large';
		$robots['max-snippet']       = '-1';
	}
	return $robots;
} );

// ── Redirects for retired and duplicate URLs ────────────────────────────────
add_action( 'template_redirect', function () {
	if ( is_page( 'sample-page' ) || is_author() ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}, 5 );

// ── Head output: description, canonical, hreflang, social tags, JSON-LD ─────
add_action( 'wp_head', 'datalkemi_seo_head', 2 );

function datalkemi_seo_head(): void {
	if ( is_404() || is_search() ) {
		return;
	}
	$ctx = datalkemi_seo_context();

	echo "\n<!-- Datalkemi SEO -->\n";
	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $ctx['desc'] ) );

	// Core prints canonical links for single posts and pages only.
	if ( $ctx['url'] && ! is_singular() ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $ctx['url'] ) );
	}

	$path      = datalkemi_seo_current_path();
	$hreflangs = datalkemi_seo_hreflang_set();
	if ( in_array( $path, $hreflangs, true ) ) {
		foreach ( $hreflangs as $code => $href ) {
			printf( '<link rel="alternate" hreflang="%s" href="%s">' . "\n", esc_attr( $code ), esc_url( home_url( $href ) ) );
		}
	}

	$og = [
		'og:locale'      => $ctx['locale'],
		'og:type'        => $ctx['type'],
		'og:site_name'   => DATALKEMI_SEO_BRAND,
		'og:title'       => $ctx['title'],
		'og:description' => $ctx['desc'],
		'og:url'         => $ctx['url'] ?: home_url( '/' ),
		'og:image'       => $ctx['image'],
	];
	if ( $ctx['image_w'] && $ctx['image_h'] ) {
		$og['og:image:width']  = (string) $ctx['image_w'];
		$og['og:image:height'] = (string) $ctx['image_h'];
	}
	foreach ( $og as $prop => $value ) {
		printf( '<meta property="%s" content="%s">' . "\n", esc_attr( $prop ), esc_attr( $value ) );
	}
	if ( 'article' === $ctx['type'] && is_singular() ) {
		printf( '<meta property="article:modified_time" content="%s">' . "\n", esc_attr( get_the_modified_date( DATE_W3C ) ) );
	}

	$twitter = [
		'twitter:card'        => 'summary_large_image',
		'twitter:title'       => $ctx['title'],
		'twitter:description' => $ctx['desc'],
		'twitter:image'       => $ctx['image'],
	];
	foreach ( $twitter as $name => $value ) {
		printf( '<meta name="%s" content="%s">' . "\n", esc_attr( $name ), esc_attr( $value ) );
	}

	echo '<script type="application/ld+json">' . wp_json_encode( datalkemi_seo_schema( $ctx ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
	echo "<!-- /Datalkemi SEO -->\n";
}

/**
 * Builds the structured data graph for the current page.
 */
function datalkemi_seo_schema( array $ctx ): array {
	$home    = home_url( '/' );
	$url     = $ctx['url'] ?: $home;
	$org_id  = $home . '#organization';
	$biz_id  = $home . '#business';
	$site_id = $home . '#website';
	$page_id = $url . '#webpage';
	$lang    = 'en_IN' === $ctx['locale'] ? 'en-IN' : 'en-AU';

	$countries = [
		'AU' => [ '@type' => 'Country', 'name' => 'Australia' ],
		'IN' => [ '@type' => 'Country', 'name' => 'India' ],
	];

	$graph = [
		[
			'@type'        => 'Organization',
			'@id'          => $org_id,
			'name'         => DATALKEMI_SEO_BRAND,
			'url'          => $home,
			'email'        => 'info@datalkemi.com',
			'logo'         => [
				'@type'  => 'ImageObject',
				'url'    => DATALKEMI_URI . '/assets/brand/app/icon-512.png',
				'width'  => 512,
				'height' => 512,
			],
			'sameAs'       => [
				'https://www.linkedin.com/company/datalkemi',
				'https://instagram.com/datalkemi',
			],
			'contactPoint' => [
				'@type'             => 'ContactPoint',
				'email'             => 'info@datalkemi.com',
				'contactType'       => 'sales',
				'areaServed'        => [ 'AU', 'IN' ],
				'availableLanguage' => [ 'English' ],
			],
		],
		[
			'@type'              => 'ProfessionalService',
			'@id'                => $biz_id,
			'name'               => DATALKEMI_SEO_BRAND,
			'url'                => $home,
			'email'              => 'info@datalkemi.com',
			'image'              => DATALKEMI_URI . '/assets/img/og-home.jpg',
			'logo'               => DATALKEMI_URI . '/assets/brand/app/icon-512.png',
			'description'        => 'Website development, custom software, SEO and data systems for businesses in Perth, across Australia and in India.',
			'parentOrganization' => [ '@id' => $org_id ],
			'priceRange'         => 'From A$500',
			'currenciesAccepted' => 'AUD, USD',
			'address'            => [
				'@type'           => 'PostalAddress',
				'addressLocality' => 'Perth',
				'addressRegion'   => 'WA',
				'addressCountry'  => 'AU',
			],
			'areaServed'         => array_values( $countries ),
			'knowsAbout'         => [
				'Website development',
				'Web application development',
				'WordPress development',
				'E-commerce websites',
				'Search engine optimisation',
				'Data engineering',
				'Business intelligence',
			],
		],
		[
			'@type'      => 'WebSite',
			'@id'        => $site_id,
			'url'        => $home,
			'name'       => DATALKEMI_SEO_BRAND,
			'publisher'  => [ '@id' => $org_id ],
			'inLanguage' => 'en-AU',
		],
	];

	$webpage = [
		'@type'       => 'WebPage',
		'@id'         => $page_id,
		'url'         => $url,
		'name'        => $ctx['title'],
		'description' => $ctx['desc'],
		'isPartOf'    => [ '@id' => $site_id ],
		'about'       => [ '@id' => $biz_id ],
		'inLanguage'  => $lang,
		'primaryImageOfPage' => [ '@type' => 'ImageObject', 'url' => $ctx['image'] ],
	];

	if ( count( $ctx['crumbs'] ) > 1 ) {
		$items = [];
		foreach ( $ctx['crumbs'] as $i => $crumb ) {
			$items[] = [
				'@type'    => 'ListItem',
				'position' => $i + 1,
				'name'     => wp_strip_all_tags( $crumb['name'] ),
				'item'     => $crumb['url'],
			];
		}
		$webpage['breadcrumb'] = [ '@id' => $url . '#breadcrumb' ];
		$graph[]               = [
			'@type'           => 'BreadcrumbList',
			'@id'             => $url . '#breadcrumb',
			'itemListElement' => $items,
		];
	}
	$graph[] = $webpage;

	if ( $ctx['service'] ) {
		$service = [
			'@type'       => 'Service',
			'@id'         => $url . '#service',
			'name'        => wp_strip_all_tags( $ctx['service']['name'] ),
			'serviceType' => wp_strip_all_tags( $ctx['service']['type'] ),
			'description' => $ctx['desc'],
			'url'         => $url,
			'provider'    => [ '@id' => $biz_id ],
			'areaServed'  => array_values( array_intersect_key( $countries, array_flip( $ctx['service']['areaServed'] ) ) ),
		];
		if ( ! empty( $ctx['service']['from_aud'] ) ) {
			$service['offers'] = [
				'@type'         => 'AggregateOffer',
				'lowPrice'      => (string) $ctx['service']['from_aud'],
				'priceCurrency' => 'AUD',
				'url'           => home_url( '/build-your-project/' ),
			];
		}
		$graph[] = $service;
	}

	if ( $ctx['faqs'] ) {
		$questions = [];
		foreach ( $ctx['faqs'] as $faq ) {
			$questions[] = [
				'@type'          => 'Question',
				'name'           => $faq['q'],
				'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $faq['a'] ],
			];
		}
		$graph[] = [
			'@type'      => 'FAQPage',
			'@id'        => $url . '#faq',
			'url'        => $url,
			'isPartOf'   => [ '@id' => $site_id ],
			'mainEntity' => $questions,
		];
	}

	return [ '@context' => 'https://schema.org', '@graph' => $graph ];
}

// ── Sitemap ─────────────────────────────────────────────────────────────────
// Author archives expose login names and duplicate the Insights page.
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}, 10, 2 );

add_filter( 'wp_sitemaps_posts_query_args', function ( $args, $post_type ) {
	if ( 'page' !== $post_type ) {
		return $args;
	}
	$exclude = [];
	foreach ( datalkemi_seo_hidden_slugs() as $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			$exclude[] = $page->ID;
		}
	}
	$args['post__not_in'] = array_merge( $args['post__not_in'] ?? [], $exclude );
	return $args;
}, 10, 2 );

// Formats and empty taxonomies add nothing to search.
add_filter( 'wp_sitemaps_taxonomies', function ( $taxonomies ) {
	unset( $taxonomies['post_format'], $taxonomies['post_tag'] );
	return $taxonomies;
} );

// ── Performance: emoji detection script and styles are not used ─────────────
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'emoji_svg_url', '__return_false' );

// Shortlink and the Windows Live Writer manifest are legacy head clutter.
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wlwmanifest_link' );

<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package architect
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function architect_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'architect_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function architect_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'architect_pingback_header' );

/**
 * Real path for an upload, ignoring optimizer suffixes like `-optimized.png`.
 *
 * @param string $file Absolute path.
 * @return string
 */
function architect_resolve_readable_file( $file ) {
	$file = (string) $file;
	if ( $file === '' ) {
		return '';
	}

	if ( is_readable( $file ) ) {
		return $file;
	}

	$plain = preg_replace( '/-optimized(\.(?:png|jpe?g|webp|gif))$/i', '$1', $file );
	if ( $plain && $plain !== $file && is_readable( $plain ) ) {
		return $plain;
	}

	return '';
}

/**
 * Absolute path to the Customizer site icon file, if it exists on disk.
 *
 * @return string
 */
function architect_get_custom_site_icon_file() {
	$id = (int) get_option( 'site_icon' );
	if ( $id <= 0 ) {
		return '';
	}

	$candidates = array(
		get_attached_file( $id, true ),
		get_attached_file( $id ),
	);

	foreach ( $candidates as $file ) {
		$resolved = architect_resolve_readable_file( (string) $file );
		if ( $resolved !== '' ) {
			return $resolved;
		}
	}

	return '';
}

/**
 * Whether Customizer «Иконка сайта» is set and the file is available.
 *
 * @return bool
 */
function architect_has_custom_site_icon() {
	return architect_get_custom_site_icon_file() !== '';
}

/**
 * Theme favicon pack directory URI (no trailing slash).
 *
 * @return string
 */
function architect_get_theme_favicon_dir_uri() {
	$host = (string) wp_parse_url( home_url( '/' ), PHP_URL_HOST );
	$name = function_exists( 'mb_strtolower' ) ? mb_strtolower( get_bloginfo( 'name' ) ) : strtolower( get_bloginfo( 'name' ) );
	$dir  = '/favicons';

	if ( false !== strpos( $host, 'talantec' ) || false !== strpos( $name, 'talantec' ) ) {
		$dir = '/favicons/talantec';
	} elseif ( ( false !== strpos( $host, 'sv.digital' ) || false !== strpos( $name, 'sv.digital' ) )
		&& is_readable( get_template_directory() . '/favicons/sv/apple-touch-icon.png' ) ) {
		$dir = '/favicons/sv';
	}

	return get_template_directory_uri() . $dir;
}

/**
 * Do not emit Customizer site-icon URLs when the attachment file is gone.
 *
 * @param string $url Icon URL.
 * @return string
 */
function architect_filter_site_icon_url( $url ) {
	if ( $url && ! architect_has_custom_site_icon() ) {
		return '';
	}

	return $url;
}
add_filter( 'get_site_icon_url', 'architect_filter_site_icon_url', 99 );

/**
 * Theme favicon tags for screens without header.php (wp-login).
 *
 * @return void
 */
function architect_login_favicon_tags() {
	if ( architect_has_custom_site_icon() ) {
		return;
	}

	$favicon_dir = architect_get_theme_favicon_dir_uri();
	printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( $favicon_dir . '/favicon.svg' ) );
	printf( '<link rel="apple-touch-icon" sizes="180x180" href="%s">' . "\n", esc_url( $favicon_dir . '/apple-touch-icon.png' ) );
	printf( '<link rel="icon" type="image/png" sizes="32x32" href="%s">' . "\n", esc_url( $favicon_dir . '/favicon-32x32.png' ) );
	printf( '<link rel="icon" type="image/png" sizes="16x16" href="%s">' . "\n", esc_url( $favicon_dir . '/favicon-16x16.png' ) );
}
add_action( 'login_head', 'architect_login_favicon_tags', 2 );

/**
 * Получить шаблон шапки в зависимости от настроек кастомайзера
 */
function architect_get_header() {
    $header_style = get_theme_mod( 'header_style', 'compact' );
    
    // Если two-level, передаем пустую строку (стандартная шапка)
    // Иначе передаем значение $header_style
    get_header( $header_style === 'default' ? '' : $header_style );
}
/**
 * Получить шаблон футера в зависимости от настроек кастомайзера
 */
function architect_get_footer() {
    $footer_style = get_theme_mod( 'footer_style', 'compact' );
    
    // Если two-level, передаем пустую строку (стандартная шапка)
    // Иначе передаем значение $footer_style
    get_footer( $footer_style === 'default' ? '' : $footer_style );
}

/**
 * Preload only the font files needed above the fold on every page.
 */
function architect_font_preloads() {
	$uri = get_template_directory_uri();
	$fonts = array(
		'InterTight-Regular.woff2',
		'InterTight-Medium.woff2',
	);

	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n  ",
			esc_url( $uri . '/fonts/' . $font )
		);
	}
}

/**
 * Render ACF flexible layouts from template-parts/sections/.
 *
 * @param int   $page_id Page ID.
 * @param array $layouts Flexible content rows.
 * @return void
 */
function architect_render_flexible_layouts( $page_id, $layouts ) {
	if ( empty( $layouts ) || ! is_array( $layouts ) ) {
		return;
	}

	$base = get_template_directory() . '/template-parts/sections/';

	foreach ( $layouts as $ids => $layout ) {
		if ( empty( $layout['acf_fc_layout'] ) ) {
			continue;
		}

		$layout_name = sanitize_file_name( $layout['acf_fc_layout'] );
		if ( $layout_name === '' || strpos( $layout_name, '.' ) !== false ) {
			continue;
		}

		$file      = $base . $layout_name . '.php';
		$real_base = realpath( $base );
		$real_file = is_file( $file ) ? realpath( $file ) : false;

		if ( ! $real_base || ! $real_file || strpos( $real_file, $real_base ) !== 0 ) {
			continue;
		}

		get_template_part(
			'template-parts/sections/' . $layout_name,
			'',
			array(
				'id'          => $page_id,
				'layout-data' => $layout,
				'layout-name' => $layout_name,
				'layout-ids'  => $ids,
			)
		);
	}
}

/**
 * Whether a theme location has a menu with at least one item.
 *
 * @param string $location Theme location slug.
 * @return bool
 */
function architect_nav_menu_has_items( $location ) {
	$locations = get_nav_menu_locations();
	if ( empty( $locations[ $location ] ) ) {
		return false;
	}

	$items = wp_get_nav_menu_items( (int) $locations[ $location ] );

	return ! empty( $items );
}

/**
 * Double table-wrapper + pill labels in thead for .textredactor tables.
 *
 * @param string $html Content HTML.
 * @return string
 */
function architect_format_textredactor_tables( $html ) {
	if ( $html === '' || false === stripos( $html, '<table' ) ) {
		return $html;
	}

	return preg_replace_callback(
		'/(?:<div\s+class="table-wrapper">\s*)*<table(\b[^>]*)>(.*?)<\/table>(?:\s*<\/div>)*/is',
		static function ( $matches ) {
			$inner   = $matches[2];
			$headers = array();

			if ( preg_match( '/<thead\b[^>]*>(.*?)<\/thead>/is', $inner, $thead ) ) {
				preg_match_all( '/<th\b[^>]*>(.*?)<\/th>/is', $thead[1], $ths );
			} else {
				preg_match_all( '/<th\b[^>]*>(.*?)<\/th>/is', $inner, $ths );
			}

			if ( ! empty( $ths[1] ) ) {
				foreach ( $ths[1] as $header_html ) {
					$headers[] = trim( wp_strip_all_tags( $header_html ) );
				}
			}

			$inner = preg_replace_callback(
				'/<th(\b[^>]*)>(.*?)<\/th>/is',
				static function ( $th ) {
					$body = trim( $th[2] );
					if ( ! preg_match( '/^<span(?:\s|>)/i', $body ) ) {
						$body = '<span>' . $body . '</span>';
					}

					return '<th' . $th[1] . '>' . $body . '</th>';
				},
				$inner
			);

			if ( $headers ) {
				$inner = preg_replace_callback(
					'/<tr(\b[^>]*)>(.*?)<\/tr>/is',
					static function ( $tr ) use ( $headers ) {
						$index = 0;
						$cells = preg_replace_callback(
							'/<td(\b[^>]*)>/i',
							static function ( $td ) use ( $headers, &$index ) {
								$label = isset( $headers[ $index ] ) ? $headers[ $index ] : '';
								$index++;

								if ( $label === '' || preg_match( '/\bdata-label=/i', $td[1] ) ) {
									return $td[0];
								}

								return '<td' . $td[1] . ' data-label="' . esc_attr( $label ) . '">';
							},
							$tr[2]
						);

						return '<tr' . $tr[1] . '>' . $cells . '</tr>';
					},
					$inner
				);
			}

			return '<div class="table-wrapper"><div class="table-wrapper"><table' . $matches[1] . '>' . $inner . '</table></div></div>';
		},
		$html
	);
}

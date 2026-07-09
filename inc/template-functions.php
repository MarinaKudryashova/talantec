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

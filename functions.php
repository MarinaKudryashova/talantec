<?php
/**
 * architect functions and definitions
 * @package architect
 * Author: Cosmo Design
 * Telegram: @cosmo_dsgn
 * Email: info@cosmo-design.com
 * Site: http://cosmo-design.com
 */

if ( ! defined( '_S_VERSION' ) ) {
	$theme = wp_get_theme();
	define( '_S_VERSION', $theme->get( 'Version' ) );
}


/**
 * Функцию для загрузки темы
 */
function architect_setup() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_post_type_support( 'post', 'page-attributes' );
	add_post_type_support( 'page', array('excerpt') );

	register_nav_menus(
		array(
			'header' => esc_html__("Главное меню", 'architect'),
			'header_mobile' => esc_html__("Главное меню (мобильное)", 'architect'),
			'header_compact' => esc_html__("Главное меню (компактный)", 'architect'),
			'header_top' => esc_html__("Верхнее меню", 'architect'),
			'footer_primary' => esc_html__("Основное нижнее", 'architect'),
			'footer_nav' => esc_html__("Навигация", 'architect'),
			'footer_info' => esc_html__("Информация", 'architect'),
			'footer_policies' => esc_html__("Дополнительная информация", 'architect'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	// add_theme_support( 'customize-selective-refresh-widgets' );

}

add_action( 'after_setup_theme', 'architect_setup' );


/**
 * Функцию для загрузки переводов
 */
function architect_load_textdomain() {
	load_theme_textdomain( 'architect', get_template_directory() . '/languages' );
}

add_action( 'init', 'architect_load_textdomain' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function architect_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'architect_content_width', 640 );
}

add_action( 'after_setup_theme', 'architect_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
// function architect_widgets_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => esc_html__( 'Sidebar', 'architect' ),
// 			'id'            => 'sidebar-1',
// 			'description'   => esc_html__( 'Add widgets here.', 'architect' ),
// 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 			'after_widget'  => '</section>',
// 			'before_title'  => '<h2 class="widget-title">',
// 			'after_title'   => '</h2>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'architect_widgets_init' );

/**
 * ОТКЛЮЧЕНИЕ КОММЕНТАРИЕВ ПОЛНОСТЬЮ
 */
function healthypaw_disable_comments() {
    // 1. Отключаем поддержку комментариев
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
    
    // 2. Закрываем все комментарии
    add_filter('comments_open', '__return_false', 20, 2);
    add_filter('pings_open', '__return_false', 20, 2);
    
    // 3. Скрываем существующие
    add_filter('comments_array', '__return_empty_array', 10, 2);
    
    // 4. Удаляем из админки
    add_action('admin_menu', function() {
        remove_menu_page('edit-comments.php');
    });
    
    // 5. Удаляем из админ-бара
    add_action('wp_before_admin_bar_render', function() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    });
}

add_action('after_setup_theme', 'healthypaw_disable_comments');


/**
 * THEME STYLES & SCRIPTS
 */
function theme_styles_and_scripts() {
	$css_path = get_template_directory_uri() . '/css/';
	$js_path = get_template_directory_uri() . '/js/';
	$ver = defined('_S_VERSION') ? _S_VERSION : wp_get_theme()->get('Version');
	if ( defined('WP_DEBUG') && WP_DEBUG ) {
			$ver = $ver . '.' . time();
	}

	// ПОЛНОЕ УДАЛЕНИЕ jQuery (осторожно!)
	if (!is_admin() && !is_customize_preview() && !current_user_can('manage_options')) {
		wp_deregister_script('jquery');
		wp_deregister_script('jquery-migrate');		
	}

  // основные стили темы
	wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), $ver );
	wp_style_add_data( 'theme-style', 'rtl', 'replace' );

	// дополнительные стили
	// wp_enqueue_style( 'css-vendor', $css_path . 'vendor.min.css', array(), $ver); // стили (библиотеки)
	wp_enqueue_style( 'css-vendor', $css_path . 'vendor.css', array(), $ver); // стили (библиотеки)
	// wp_enqueue_style( 'css-main', $css_path . 'main.min.css', array('css-vendor'), $ver); // основные стили темы
	wp_enqueue_style( 'css-main', $css_path . 'main.css', array('css-vendor'), $ver); // основные стили темы

	// скрипт навигации	
	wp_enqueue_script( 'architect-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $ver, true );


	// основные скрипты темы	
	// wp_enqueue_script( 'js-main', $js_path . 'main.min.js', array(), $ver, array( 'in_footer' => true, 'strategy' => 'defer'));
	wp_enqueue_script( 'js-main', $js_path . 'main.js', array(), $ver, array( 'in_footer' => true, 'strategy' => 'defer'));
}

add_action( 'wp_enqueue_scripts', 'theme_styles_and_scripts' );


/**
 * THEME EXTRAS
 */
require_once get_template_directory() . '/inc/thumbnail.php'; // Подключаем функционал управления миниатюрами записей из общего списка записей в админ-панели WordPress
require_once get_template_directory() . '/inc/theme-svg.php'; // Добавляет поддержку SVG изображений в медиабиблиотеку
require_once get_template_directory() . '/inc/disable_default_image_sizes.php'; // Отключаем только конкретные стандартные размеры изображений
require_once get_template_directory() . '/inc/the_picture_element.php'; // Отключаем только конкретные стандартные размеры изображений
require_once get_template_directory() . '/inc/post-options.php';
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/Header_Menu_Walker.php';
require_once get_template_directory() . '/inc/Top_Menu_Walker.php';
require_once get_template_directory() . '/inc/Footer_Menu_Walker.php';
require_once get_template_directory() . '/inc/Mobile_Menu_Walker.php';
require_once get_template_directory() . '/inc/theme-form-cf7.php';

// 1. Фильтр для пути к PHP шаблонам
add_filter('acfe/flexible/path', 'theme_acfe_flexible_render_path', 10, 3);
function theme_acfe_flexible_render_path($path, $layout, $field){
    return get_template_directory() . '/template-parts/sections/' . $layout['name'] . '.php';
}

// 2. Фильтр — стили и скрипты уже подключены
add_filter('acfe/flexible/render/data', 'theme_acfe_flexible_render_assets', 10, 4);
function theme_acfe_flexible_render_assets($data, $layout, $field, $post_id) {
    return $data;
}


/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
  require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Добавляем класс admin-bar на body если панель отображается
// add_filter('body_class', 'add_admin_bar_class');

// function add_admin_bar_class($classes) {
//     if (is_admin_bar_showing()) {
//         $classes[] = 'admin-bar';
//     }
//     return $classes;
// }
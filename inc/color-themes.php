<?php
/**
 * Цветовые темы для сайта
 */

function architect_get_color_themes() {
  return array(
    // ===== КРАСНАЯ СЕРИЯ =====
    'default' => array(
        'label' => __('Тема по умолчанию', 'architect'),
        'colors' => array(
            '--black'          => '#000404',
            '--black-400'      => 'rgba(0, 4, 4, 0.4)',
            '--black-560'      => 'rgba(0, 4, 4, 0.56)',
            '--grey'           => '#585858',
            '--border'         => '#c3c4c8',
            '--bg'             => '#f7f7f7',
            '--white'          => '#fff',
            '--white-160'      => 'rgba(255, 255, 255, 0.16)',
            '--white-560'      => 'rgba(255, 255, 255, 0.56)',
            '--accent'         => '#ce1f00',
            '--accent-dark'    => '#a31a02',
            '--green'          => '#2eaf00',
        )
    ),
    'flame' => array(
        'label' => __('Пламенный красный', 'architect'),
        'colors' => array(
            '--black'          => '#000404',
            '--black-400'      => 'rgba(0, 4, 4, 0.4)',
            '--black-560'      => 'rgba(0, 4, 4, 0.56)',
            '--grey'           => '#585858',
            '--border'         => '#c3c4c8',
            '--bg'             => '#f7f7f7',
            '--white'          => '#fff',
            '--white-160'      => 'rgba(255, 255, 255, 0.16)',
            '--white-560'      => 'rgba(255, 255, 255, 0.56)',
            '--accent'         => '#e73f24',
            '--accent-dark'    => '#ab2f1c',
            '--green'          => '#2eaf00',
        )
    ),

    // ===== ЗЕЛЕНАЯ СЕРИЯ =====
    'sage' => array(
        'label' => __('Сливочный шалфей', 'architect'),
        'colors' => array(
            '--black'          => '#1c1f1a',
            '--black-400'      => 'rgba(28, 31, 26, 0.4)',
            '--black-560'      => 'rgba(28, 31, 26, 0.56)',
            '--grey'           => '#8b9082',
            '--border'         => '#dddfd4',
            '--bg'             => '#fefcf5',
            '--white'          => '#ffffff',
            '--white-160'      => 'rgba(255, 255, 255, 0.16)',
            '--white-560'      => 'rgba(255, 255, 255, 0.56)',
            '--accent'         => '#00863e',
            '--accent-dark'    => '#006b30',
            '--green'          => '#00863e',
        )
    ),
    'milk_eucalyptus' => array(
        'label' => __('Молочный эвкалипт', 'architect'),
        'colors' => array(
            '--black'          => '#1a1d18',
            '--black-400'      => 'rgba(26, 29, 24, 0.4)',
            '--black-560'      => 'rgba(26, 29, 24, 0.56)',
            '--grey'           => '#8c9184',
            '--border'         => '#daded2',
            '--bg'             => '#fefcf8',
            '--white'          => '#ffffff',
            '--white-160'      => 'rgba(255, 255, 255, 0.16)',
            '--white-560'      => 'rgba(255, 255, 255, 0.56)',
            '--accent'         => '#00863e',
            '--accent-dark'    => '#006b30',
            '--green'          => '#00863e',
        )
    ),
    'emerald_dew' => array(
        'label' => __('Изумрудная роса', 'architect'),
        'colors' => array(
            '--black'          => '#1d201c',
            '--black-400'      => 'rgba(29, 32, 28, 0.4)',
            '--black-560'      => 'rgba(29, 32, 28, 0.56)',
            '--grey'           => '#91978b',
            '--border'         => '#dee2d7',
            '--bg'             => '#fefef9',
            '--white'          => '#ffffff',
            '--white-160'      => 'rgba(255, 255, 255, 0.16)',
            '--white-560'      => 'rgba(255, 255, 255, 0.56)',
            '--accent'         => '#1f7a5a',
            '--accent-dark'    => '#165e45',
            '--green'          => '#1f7a5a',
        )
    ),

    // ===== СИНЯЯ СЕРИЯ =====
    'digital_ocean' => array(
        'label' => __('Цифровой океан', 'architect'),
        'colors' => array(
            '--black'          => '#000404',
            '--black-400'      => 'rgba(0, 4, 4, 0.4)',
            '--black-560'      => 'rgba(0, 4, 4, 0.56)',
            '--grey'           => '#585858',
            '--border'         => '#c3c4c8',
            '--bg'             => '#f7f7f7',
            '--white'          => '#fff',
            '--white-160'      => 'rgba(255, 255, 255, 0.16)',
            '--white-560'      => 'rgba(255, 255, 255, 0.56)',
            '--accent'         => '#008acf',
            '--accent-dark'    => '#026090',
            '--green'          => '#2eaf00',
        )
    ),
        

    // Добавьте новые темы здесь
    /*
    'dark' => array(
        'label' => __('Темная тема', 'architect'),
        'colors' => array(
            '--black'          => '#1a1a1a',
            '--black-400'      => 'rgba(26, 26, 26, 0.4)',
            '--black-560'      => 'rgba(26, 26, 26, 0.56)',
            '--grey'           => '#888888',
            '--border'         => '#444444',
            '--bg'             => '#2d2d2d',
            '--white'          => '#f0f0f0',
            '--white-160'      => 'rgba(240, 240, 240, 0.16)',
            '--white-560'      => 'rgba(240, 240, 240, 0.56)',
            '--accent'         => '#ff6b35',
            '--accent-dark'    => '#cc552a',
            '--green'          => '#4caf50',
        )
    ),
    */
  );
}

/**
 * Получить активную цветовую тему
 */
function architect_get_active_theme_colors() {
    $current_theme = get_theme_mod('color_theme', 'default');
    $themes = architect_get_color_themes();
    
    // Если тема не найдена, возвращаем тему по умолчанию
    if (!isset($themes[$current_theme])) {
        $current_theme = 'default';
    }
    
    return $themes[$current_theme]['colors'];
}

/**
 * Получить CSS переменные для активной темы
 */
function architect_get_theme_css_variables() {
    $colors = architect_get_active_theme_colors();
    $css = ':root {';
    
    foreach ($colors as $variable => $value) {
        $css .= $variable . ': ' . $value . ';';
    }
    
    $css .= '}';
    
    return $css;
}


/**
 * Вывод CSS переменных в head
 */
function architect_custom_colors() {
    // Получаем CSS переменные
    $css = architect_get_theme_css_variables();
    
    // Добавляем CSS в head
    echo '<style id="architect-color-theme">' . $css . '</style>';
}
add_action('wp_head', 'architect_custom_colors', 10);


/**
 * Добавляем CSS переменные в админку для превью
 */
function architect_admin_custom_colors() {
    $css = architect_get_theme_css_variables();
    echo '<style id="architect-color-theme-admin">' . $css . '</style>';
}
add_action('admin_head', 'architect_admin_custom_colors');
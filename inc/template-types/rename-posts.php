<?php 

//события(блог, новости)
## заменим слово «записи» на «события»
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
	// заменять автоматически не пойдет например заменили: Запись = Статья, а в тесте получится так "Просмотреть статья"
	$new = array(
		'name'                  => _x( 'Блог', 'architect' ),
		'singular_name'         => _x( 'Статья', 'architect' ),
		'add_new'               => __( 'Добавить статья', 'architect' ),
		'add_new_item'          => __( 'Добавить новое статья', 'architect' ),
		'edit_item'             => __( 'Редактировать статья', 'architect' ),
		'new_item'              => __( 'Новое статья', 'architect' ),
		'view_item'             => __( 'Посмотреть статья', 'architect' ),
		'search_items'          => __( 'Поиск статей', 'architect' ),
		'not_found'             => __( 'Статей не найдено.', 'architect' ),
		'parent_item_colon'     => '',
		'all_items'             => __( 'Все статьи', 'architect' ),
		'archives'              => __( 'Архив статей', 'architect' ),
		'menu_name'             => __( 'Блог', 'architect' ),
		'name_admin_bar'        => __( 'Статья', 'architect' ), // пункте "добавить"
	);

	return (object) array_merge( (array) $labels, $new );
}

// Добавляем метабокс на страницу блога (в сайдбар)
add_action('add_meta_boxes', 'add_blog_settings_meta_box');
function add_blog_settings_meta_box() {
    $page_for_posts = get_option('page_for_posts');
    
    if ($page_for_posts) {
        add_meta_box(
            'blog_settings_meta_box',              // ID
            __('Настройки блога', 'architect'),    // Заголовок
            'render_blog_settings_meta_box',       // Callback
            'page',                                // Тип поста
            'side',                                // Контекст - СБОКУ
            'default'                              // Приоритет (после изображения)
        );
    }
}

// Рендерим метабокс
function render_blog_settings_meta_box($post) {
    $page_for_posts = get_option('page_for_posts');
    if ($post->ID != $page_for_posts) {
        echo '<p><em>' . __('Настройки доступны только для страницы блога.', 'architect') . '</em></p>';
        return;
    }
    
    wp_nonce_field('blog_settings_nonce', 'blog_settings_nonce');
    
    $posts_per_row = get_post_meta($post->ID, '_blog_posts_per_row', true);
    $posts_per_row = $posts_per_row ?: 3;
    
    $posts_per_page = get_post_meta($post->ID, '_blog_posts_per_page', true);
    $posts_per_page = $posts_per_page ?: 9;
    ?>
    
    <div class="blog-settings-side">
        <p>
            <label for="blog_posts_per_row">
                <strong><?php _e('Записей в строке:', 'architect'); ?></strong>
            </label>
            <br>
            <select name="blog_posts_per_row" id="blog_posts_per_row" style="width: 100%; margin-top: 4px;">
                <?php for ($i = 1; $i <= 6; $i++) : ?>
                    <option value="<?php echo $i; ?>" <?php selected($posts_per_row, $i); ?>>
                        <?php echo $i; ?>
                    </option>
                <?php endfor; ?>
            </select>
            <span class="description" style="display: block; margin-top: 2px; color: #666; font-size: 11px;">
                <?php _e('Кол-во в ряду сетки', 'architect'); ?>
            </span>
        </p>
        
        <p>
            <label for="blog_posts_per_page">
                <strong><?php _e('Записей на странице:', 'architect'); ?></strong>
            </label>
            <br>
            <input type="number" 
                   name="blog_posts_per_page" 
                   id="blog_posts_per_page" 
                   value="<?php echo esc_attr($posts_per_page); ?>" 
                   min="1" 
                   max="50"
                   style="width: 100%; margin-top: 4px;" />
            <span class="description" style="display: block; margin-top: 2px; color: #666; font-size: 11px;">
                <?php _e('Кол-во на странице архива', 'architect'); ?>
            </span>
        </p>
        
        <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #ddd; color: #888; font-size: 11px;">
            <span class="dashicons dashicons-info" style="font-size: 14px; width: 14px; height: 14px;"></span>
            <?php _e('Настройки применяются на странице блога', 'architect'); ?>
        </p>
    </div>
    
    <style>
        .blog-settings-side p {
            margin: 12px 0;
        }
        .blog-settings-side label {
            font-weight: 600;
        }
        .blog-settings-side select,
        .blog-settings-side input[type="number"] {
            font-size: 13px;
            padding: 4px 8px;
        }
    </style>
    <?php
}

// Сохраняем данные метабокса
add_action('save_post', 'save_blog_settings_meta_box');
function save_blog_settings_meta_box($post_id) {
    if (!isset($_POST['blog_settings_nonce']) || 
        !wp_verify_nonce($_POST['blog_settings_nonce'], 'blog_settings_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }
    
    if (isset($_POST['blog_posts_per_row'])) {
        $value = intval($_POST['blog_posts_per_row']);
        if ($value >= 1 && $value <= 6) {
            update_post_meta($post_id, '_blog_posts_per_row', $value);
        }
    }
    
    if (isset($_POST['blog_posts_per_page'])) {
        $value = intval($_POST['blog_posts_per_page']);
        if ($value >= 1 && $value <= 50) {
            update_post_meta($post_id, '_blog_posts_per_page', $value);
        }
    }
}

// ============= ФУНКЦИИ ДЛЯ ПОЛУЧЕНИЯ НАСТРОЕК =============

/**
 * Универсальная функция получения настройки блога
 * 
 * @param string $key Ключ настройки
 * @param mixed $default Значение по умолчанию
 * @return mixed Значение настройки
 */
function get_blog_setting($key, $default = null) {
    $page_for_posts = get_option('page_for_posts');
    
    if (!$page_for_posts) {
        return $default;
    }
    
    $meta_key = '_blog_' . $key;
    $value = get_post_meta($page_for_posts, $meta_key, true);
    
    if ($value === '' || $value === null) {
        return $default;
    }
    
    return $value;
}

/**
 * Получить количество записей в строке
 * 
 * @return int Количество записей в строке
 */
function get_blog_posts_per_row() {
    return (int) get_blog_setting('posts_per_row', 3);
}

/**
 * Получить количество записей на странице
 * 
 * @return int Количество записей на странице
 */
function get_blog_posts_per_page() {
    return (int) get_blog_setting('posts_per_page', 9);
}

/**
 * Добавляем правила перезаписи для категорий на странице блога
 */
add_action('init', 'add_category_rewrite_rules_for_blog');
function add_category_rewrite_rules_for_blog() {
    $blog_page_id = get_option('page_for_posts');
    
    if (!$blog_page_id) {
        return;
    }
    
    $page_slug = get_post_field('post_name', $blog_page_id);
    
    // Добавляем правило для /blog/category-slug/
    add_rewrite_rule(
        '^' . $page_slug . '/([^/]+)/?$',
        'index.php?pagename=' . $page_slug . '&category_name=$matches[1]',
        'top'
    );
    
    // Добавляем правило для /blog/category-slug/page/2/
    add_rewrite_rule(
        '^' . $page_slug . '/([^/]+)/page/([0-9]+)/?$',
        'index.php?pagename=' . $page_slug . '&category_name=$matches[1]&paged=$matches[2]',
        'top'
    );
}

// Перенаправляем стандартные категории на страницу блога
add_action('template_redirect', 'redirect_standard_category_to_blog');
function redirect_standard_category_to_blog() {
    // Проверяем, что это стандартная категория
    if (!is_category()) {
        return;
    }
    
    $blog_page_id = get_option('page_for_posts');
    
    if (!$blog_page_id) {
        return;
    }
    
    $category = get_queried_object();
    
    if (!$category || is_wp_error($category)) {
        return;
    }
    
    $page_slug = get_post_field('post_name', $blog_page_id);
    $redirect_url = home_url('/' . $page_slug . '/' . $category->slug . '/');
    
    // Проверяем, чтобы не было бесконечного цикла
    $current_url = home_url(add_query_arg(null, null));
    if ($current_url !== $redirect_url) {
        wp_redirect($redirect_url, 301);
        exit;
    }
}
<?php 

// проектови projects
add_action( 'init', 'projects_register_post_types' );
add_action( 'init', 'theme_register_projects_category');

// Register new Taxonomy Категории проектов
function theme_register_projects_category(){
	
	$labels = array(
		'name'              => _x( 'Категории проектов', 'taxonomy general name', 'architect' ),
		'singular_name'     => _x( 'Категория проекта', 'taxonomy singular name', 'architect' ),
		'search_items'      => 'Поиск категории',
		'all_items'         => 'Все категории',
		'view_item '        => 'Посмотреть категорию',
		'edit_item'         => 'Редактировать категорию',
		'update_item'       => 'Обновить категорию',
		'add_new_item'      => 'Добавить новую категорию',
		'new_item_name'     => 'Новая категория',
		'menu_name'         => 'Категории проектов',
	);
	
	$args = array (
		'label'                 => 'Категории проектов', 
		'labels'                => $labels,
		'description'           => '', 
		'public'                => true,
		'hierarchical'			=> true,
		'show_in'     		    => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'show_admin_column'     => true,
		'show_in_quick_edit'	=> true,
		'rewrite'               => array(
				'slug' => 'projects-category',
				'with_front' => false,
				'hierarchical' => true
		),
	);
	
	register_taxonomy( 'projects_category', [ 'projects' ], $args );
}

// Create new Custom Post Type
function projects_register_post_types(){

	$labels = array(
		'name'                  => _x( 'Проекты', 'Post Type General Name', 'architect' ),
		'singular_name'         => _x( 'Проект', 'Post Type Singular Name', 'architect' ),
		'menu_name'             => __( 'Проекты', 'architect' ),
		'name_admin_bar'        => __( 'Проект', 'architect' ),
		'add_new_item'          => __( 'Добавить новую проект', 'architect' ),
		'add_new'               => __( 'Добавить проект', 'architect' ),
		'new_item'              => __( 'Новая проект', 'architect' ),
		'edit_item'             => __( 'Редактировать проект', 'architect' ),
		'view_item'             => __( 'Посмотреть проект', 'architect' ),
		'view_items'            => __( 'Посмотреть все проекты', 'architect' ),
		'search_items'          => __( 'Поиск проекта', 'architect' ),
		'not_found'             => __( 'Не найдено', 'architect' ),
		'not_found_in_trash'    => __( 'В корзине не найдено', 'architect' ),
		'uploaded_to_this_item' => __( 'Загружено изображение проекта', 'architect' ),
		'featured_image'        => __( 'Изображение проекта', 'architect' ),
		'set_featured_image'    => __( 'Установить изображение проекта', 'architect' ),
		'remove_featured_image' => __( 'Удалить изображение проекта', 'architect' ),
		'use_featured_image'    => __( 'Использовать как изображение проекта', 'architect' ),
	);
  
	$args = array(
		'label'                 => __( 'Проекты', 'architect' ),
		'labels'                => $labels,
		'description'           => __( 'Все проекты', 'architect' ),
		'public'                => true,
		'publicly_queryable'    => true,
		'rewrite' 				=> array(
			'slug' => 'projects',
			'with_front' => false,
			'pages' => true,
		),
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'menu_position'         => 4,
		'menu_icon'             => 'dashicons-portfolio',
		'supports'              => array('title', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes', 'editor'),
		'taxonomies'            => array('projects_category'),
		'has_archive'           => false,
	);
	
	register_post_type( 'projects', $args );
}

// Добавление фильтра по категориям в админке
function projects_true_taxonomy_filter() {
	global $typenow;
	
	if( $typenow == 'projects' ) {
		$taxes = array('projects_category');
		
		foreach ($taxes as $tax) {
			$current_tax = isset( $_GET[$tax] ) ? $_GET[$tax] : '';
			$tax_obj = get_taxonomy($tax);
			$tax_name = mb_strtolower($tax_obj->labels->name);
			$terms = get_terms(array(
				'taxonomy' => $tax,
				'hide_empty' => false,
			));
			
			if(count($terms) > 0) {
				echo "<select name='$tax' id='$tax' class='postform'>";
				echo "<option value=''>Все $tax_name</option>";
				
				foreach ($terms as $term) {
					echo '<option value='. $term->slug . (($current_tax == $term->slug) ? ' selected="selected"' : '') . '>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
 
add_action( 'restrict_manage_posts', 'projects_true_taxonomy_filter' );

/**
 * ==========================================
 * НАСТРОЙКИ СТРАНИЦЫ ЗАПИСЕЙ ПРОЕКТОВ
 * ==========================================
 */

/**
 * 1. Добавляем подменю "Настройки" в CPT ПРОЕКТОВ
 */
add_action('admin_menu', 'add_projects_settings_submenu');
function add_projects_settings_submenu() {
    add_submenu_page(
        'edit.php?post_type=projects',
        'Настройки проектов',
        'Настройки',
        'manage_options',
        'projects-settings',
        'projects_settings_page_callback'
    );
}

/**
 * 2. Страница настроек проектов
 */
function projects_settings_page_callback() {
    if(isset($_POST['submit']) && check_admin_referer('projects_settings')) {
        update_option('page_for_projects', absint($_POST['page_for_projects']));
        update_option('projects_per_page', absint($_POST['projects_per_page']));
        update_option('projects_per_row', absint($_POST['projects_per_row']));
        echo '<div class="notice notice-success"><p>Настройки сохранены!</p></div>';
    }
    
    $page_for_projects = get_option('page_for_projects', 0);
    $projects_per_page = get_option('projects_per_page', 12);
    $projects_per_row = get_option('projects_per_row', 3);
    ?>
    <div class="wrap">
        <h1>Настройки проектов</h1>
        
        <div class="notice notice-info">
            <p><strong>Как настроить:</strong> Создайте страницу &rarr; назначьте ей шаблон "Каталог проектов" &rarr; выберите её выше &rarr; сохраните настройки &rarr; обновите постоянные ссылки.</p>
        </div>
        
        <form method="post" action="">
            <?php wp_nonce_field('projects_settings'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="page_for_projects">Страница записей проектов</label>
                    </th>
                    <tr>
                        <?php
                        wp_dropdown_pages(array(
                            'name' => 'page_for_projects',
                            'id' => 'page_for_projects',
                            'selected' => $page_for_projects,
                            'show_option_none' => '— Выберите страницу —',
                            'option_none_value' => '0',
                            'post_type' => 'page',
                            'sort_column' => 'post_title'
                        ));
                        ?>
                        <p class="description">Страница, на которой будут отображаться все проекты</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="projects_per_page">Проектов на странице</label>
                    </th>
                    <td>
                        <input type="number" 
                               name="projects_per_page" 
                               id="projects_per_page" 
                               value="<?php echo $projects_per_page; ?>" 
                               min="1"
                               max="50"
                               class="small-text">
                        <p class="description">Количество проектов, отображаемых на одной странице</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="projects_per_row">Проектов в строке</label>
                    </th>
                    <td>
                        <select name="projects_per_row" id="projects_per_row">
                            <?php for($i = 1; $i <= 6; $i++) : ?>
                                <option value="<?php echo $i; ?>" <?php selected($projects_per_row, $i); ?>>
                                    <?php echo $i; ?> <?php echo _n('колонка', 'колонки', $i, 'architect'); ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                        <p class="description">Количество проектов в одном ряду (для адаптивных сеток)</p>
                        
                        <?php if($projects_per_row > 0) : ?>
                        <div style="margin-top: 10px;">
                            <strong>Пример сетки:</strong>
                            <div style="display: grid; grid-template-columns: repeat(<?php echo $projects_per_row; ?>, 1fr); gap: 10px; max-width: 400px; margin-top: 5px;">
                                <?php for($i = 1; $i <= $projects_per_row; $i++) : ?>
                                    <div style="background: #f0f0f0; padding: 15px; text-align: center; border: 1px solid #ddd; border-radius: 4px;">
                                        <?php echo $i; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
             </table>
            
            <p class="submit">
                <input type="submit" name="submit" class="button button-primary" value="Сохранить настройки">
            </p>
        </form>
    </div>
    <?php
}

/**
 * 3. Добавляем настройки в кастомайзер
 */
add_action('customize_register', 'customizer_projects_settings');
function customizer_projects_settings($wp_customize) {
    $wp_customize->add_section('projects_archive_section', array(
        'title'    => 'Страница записей проектов',
        'priority' => 100,
    ));
    
    $wp_customize->add_setting('page_for_projects', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'type'              => 'option',
    ));
    
    $wp_customize->add_control('page_for_projects', array(
        'label'       => 'Страница записей проектов',
        'section'     => 'projects_archive_section',
        'type'        => 'dropdown-pages',
    ));
    
    $wp_customize->add_setting('projects_per_page', array(
        'default'           => 12,
        'sanitize_callback' => 'absint',
        'type'              => 'option',
    ));
    
    $wp_customize->add_control('projects_per_page', array(
        'label'       => 'Проектов на странице',
        'section'     => 'projects_archive_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 1, 'max' => 50),
    ));

    $wp_customize->add_setting('projects_per_row', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
        'type'              => 'option',
    ));
    
    $wp_customize->add_control('projects_per_row', array(
        'label'       => 'Проектов в строке',
        'section'     => 'projects_archive_section',
        'type'        => 'select',
        'choices'     => array(
            1 => '1 колонка',
            2 => '2 колонки',
            3 => '3 колонки',
            4 => '4 колонки',
            5 => '5 колонок',
            6 => '6 колонок',
        ),
    ));
}

/**
 * 4. Вспомогательные функции
 */
function get_projects_page_id() {
    return absint(get_option('page_for_projects', 0));
}

function get_projects_per_page() {
    return absint(get_option('projects_per_page', 12));
}

function get_projects_per_row() {
    return absint(get_option('projects_per_row', 3));
}

/**
 * 5. Форсируем использование archive-projects.php для страницы проектов
 */
add_filter('template_include', 'force_archive_template_for_projects');
function force_archive_template_for_projects($template) {
    $projects_page_id = get_projects_page_id();
    
    if($projects_page_id && is_page($projects_page_id)) {
        $archive_template = locate_template('archive-projects.php');
        if($archive_template) {
            return $archive_template;
        }
    }
    
    return $template;
}

/**
 * 6. Перенаправляем /projects на выбранную страницу
 */
add_action('template_redirect', 'redirect_projects_archive_to_page');
function redirect_projects_archive_to_page() {
    if(is_post_type_archive('projects')) {
        $projects_page_id = get_projects_page_id();
        if($projects_page_id) {
            wp_redirect(get_permalink($projects_page_id), 301);
            exit;
        }
    }
}

/**
 * 7. Добавляем подпись "— Страница записей проектов" в списке страниц
 */
add_filter('display_post_states', 'add_projects_page_state', 10, 2);
function add_projects_page_state($post_states, $post) {
    $projects_page_id = get_projects_page_id();
    
    if($projects_page_id && $post->ID == $projects_page_id) {
        $post_states['page_for_projects'] = 'Страница записей проектов';
    }
    
    return $post_states;
}

/**
 * 8. Показываем уведомление при редактировании архивной страницы
 */
add_action('admin_notices', 'projects_page_edit_notice');
function projects_page_edit_notice() {
    global $post;
    
    if(!$post) return;
    
    $projects_page_id = get_projects_page_id();
    
    if($projects_page_id && $post->ID == $projects_page_id) {
        ?>
        <div class="notice notice-warning">
            <p>
                <strong>⚠️ Внимание!</strong> 
                Вы редактируете страницу, которая выбрана как <strong>«Страница записей проектов»</strong>.
                На этой странице будут автоматически отображаться все добавленные проекта.
            </p>
            <p>
                🔧 Управлять выводом проектов можно в 
                <a href="<?php echo admin_url('edit.php?post_type=projects&page=projects-settings'); ?>">настройках проектов</a>.
            </p>
        </div>
        <?php
    }
}

/**
 * 9. Скрываем секцию "Атрибуты страницы" для страницы проектов
 */

add_action('admin_head-post.php', 'hide_page_attributes_for_projects');
add_action('admin_head-post-new.php', 'hide_page_attributes_for_projects');
function hide_page_attributes_for_projects() {
    global $post;
    
    if(!$post) return;
    
    $projects_page_id = get_projects_page_id();
    
    if($projects_page_id && $post->ID == $projects_page_id) {
        ?>
        <style>
            /* Скрываем всю секцию "Атрибуты страницы" */
            .postbox-container .postbox:has(.post-attributes-label-wrapper),
            #pageparentdiv,
            .editor-post-status .components-panel__row:has(.editor-post-parent) {
                display: none !important;
            }
        </style>
        <?php
    }
}

/**
 * 10. Принудительно устанавливаем шаблон для страницы проектов
 */
add_action('save_post', 'force_template_for_projects_page', 10, 2);
function force_template_for_projects_page($post_id, $post) {
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(!current_user_can('edit_post', $post_id)) return;
    if($post->post_type !== 'page') return;
    
    $projects_page_id = get_projects_page_id();
    
    if($projects_page_id && $post_id == $projects_page_id) {
        update_post_meta($post_id, '_wp_page_template', 'default');
    }
}

/**
 * 11. Добавляем ЧПУ для категорий на странице каталога
 */
add_action('init', 'add_pretty_projects_category_rewrite_rules');
function add_pretty_projects_category_rewrite_rules() {
    $projects_page_id = get_projects_page_id();
    
    if($projects_page_id) {
        $page_slug = get_post_field('post_name', $projects_page_id);
        
        if($page_slug) {
            add_rewrite_tag('%projects_category%', '([^&]+)');
            
            // /katalog/etiketki/
            add_rewrite_rule(
                '^' . $page_slug . '/([^/]+)/?$',
                'index.php?page_id=' . $projects_page_id . '&projects_category=$matches[1]',
                'top'
            );
            
            // /katalog/etiketki/page/2/
            add_rewrite_rule(
                '^' . $page_slug . '/([^/]+)/page/([0-9]+)/?$',
                'index.php?page_id=' . $projects_page_id . '&projects_category=$matches[1]&paged=$matches[2]',
                'top'
            );
            
            // /katalog/page/2/
            add_rewrite_rule(
                '^' . $page_slug . '/page/([0-9]+)/?$',
                'index.php?page_id=' . $projects_page_id . '&paged=$matches[1]',
                'top'
            );
        }
    }
}

/**
 * 12. Добавляем projects_category в query vars
 */
add_filter('query_vars', 'add_projects_category_query_var');
function add_projects_category_query_var($vars) {
    $vars[] = 'projects_category';
    return $vars;
}

/**
 * 13. Перенаправляем стандартные страницы категорий на ЧПУ
 */
add_action('template_redirect', 'redirect_projects_category_to_pretty_url');
function redirect_projects_category_to_pretty_url() {
    if(is_tax('projects_category')) {
        $projects_page_id = get_projects_page_id();
        $category = get_queried_object();
        
        if($projects_page_id && $category) {
            $page_slug = get_post_field('post_name', $projects_page_id);
            $pretty_url = home_url('/' . $page_slug . '/' . $category->slug . '/');
            wp_redirect($pretty_url, 301);
            exit;
        }
    }
}

/**
 * 14. Заменяем ссылки категорий в меню на ЧПУ
 */
add_filter('nav_menu_link_attributes', 'change_category_links_to_pretty_url', 10, 3);
function change_category_links_to_pretty_url($atts, $item, $args) {
    if(isset($item->object) && $item->object == 'projects_category') {
        $term = get_term($item->object_id, 'projects_category');
        if($term && !is_wp_error($term)) {
            $projects_page_id = get_projects_page_id();
            if($projects_page_id) {
                $page_slug = get_post_field('post_name', $projects_page_id);
                $atts['href'] = home_url('/' . $page_slug . '/' . $term->slug . '/');
            }
        }
    }
    return $atts;
}
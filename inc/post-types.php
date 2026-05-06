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

/* Создание кастомного типа записи Лицензии */
// add_action( 'init', 'licenses_register_post_types' );

// function licenses_register_post_types(){

// 	$labels = array(
// 		'name'                  => _x( 'Лицензии', 'Post Type General Name', 'architect' ),
// 		'singular_name'         => _x( 'Лицензия', 'Post Type Singular Name', 'architect' ),
// 		'menu_name'             => __( 'Лицензии', 'architect' ),
// 		'name_admin_bar'        => __( 'Лицензии', 'architect' ),
// 		'add_new_item'          => __( 'Добавить новую лицензию', 'architect' ),
// 		'add_new'               => __( 'Добавить новую', 'architect' ),
// 		'new_item'              => __( 'Новая лицензия', 'architect' ),
// 		'edit_item'             => __( 'Изменить лицензию', 'architect' ),
// 		'view_item'             => __( 'Посмотреть лицензию', 'architect' ),
// 		'view_items'            => __( 'Посмотреть все лицензии', 'architect' ),
// 		'search_items'          => __( 'Поиск лицензии', 'architect' ),
// 		'not_found'             => __( 'Не найдено', 'architect' ),
// 		'not_found_in_trash'    => __( 'Не найдено в удаленных', 'architect' ),
// );
	
// 	$args = array(
// 		'label'                 => __( 'Лицензии', 'architect' ),
// 		'labels'                => $labels,
// 		'description'           => __( 'Список лицензий', 'architect' ),
// 		'public'                => true,
// 		'publicly_queryable'    => false,
// 		'show_ui'               => true,
// 		'show_in_menu'          => true,
// 		'show_in_admin_bar'     => true,
// 		'show_in_nav_menus'     => false,
// 		'show_in_rest'          => true,
// 		'menu_position'         => 4,
// 		'menu_icon'             => 'dashicons-editor-help',
// 		'capability_type'       => 'post',
// 		'supports'              => array('title', 'thumbnail', 'post-formats'), //'page-attributes', 'custom-fields'
// 		'taxonomies'            => array(),
// 		'has_archive'           => false,
// 		'can_export'            => true,
// );
	
// register_post_type( 'licenses', $args );

// }

/* Добавляем колонку "Порядок" в админке */
// add_filter( 'manage_licenses_posts_columns', 'licenses_add_order_column' );
// function licenses_add_order_column( $columns ) {
//     $new_columns = array();
//     foreach ( $columns as $key => $value ) {
//         $new_columns[$key] = $value;
//         if ( $key === 'title' ) {
//             $new_columns['menu_order'] = __( 'Order', 'architect' );
//         }
//     }
//     return $new_columns;
// }

// add_action( 'manage_licenses_posts_custom_column', 'licenses_show_order_column', 10, 2 );
// function licenses_show_order_column( $column_name, $post_id ) {
//     if ( $column_name === 'menu_order' ) {
//         echo get_post_field( 'menu_order', $post_id );
//     }
// }

// /* Делаем колонку "Порядок" сортируемой */
// add_filter( 'manage_edit-licenses_sortable_columns', 'licenses_make_order_column_sortable' );
// function licenses_make_order_column_sortable( $columns ) {
//     $columns['menu_order'] = 'menu_order';
//     return $columns;
// }
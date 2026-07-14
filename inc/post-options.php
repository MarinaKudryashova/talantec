<?php 
/**
 * Регистрация опцийных страниц ACF
 */


function custom_acf_options() {
	if (function_exists("acf_add_options_page")) {
		acf_add_options_page(array(
			"page_title" => __("Настройки сайта", 'architect'),
			"menu_title" => __("Настройки сайта", 'architect'),
			"menu_slug"  => "site_settings",
			"redirect"    => true,
			'position'      => 2,
		));

		// acf_add_options_sub_page(array(
		// 	"page_title"  => __("Контактная информация", 'architect'),
		// 	"menu_title"  => __("Контактная информация", 'architect'),
		// 	"parent_slug" => "site_settings",
		// 	"menu_slug"   => "site_settings_contacts",
		// ));
		
		// acf_add_options_sub_page(array(
		// 	"page_title"  => __("Социальные сети", 'architect'),
		// 	"menu_title"  => __("Социальные сети", 'architect'),
		// 	"parent_slug" => "site_settings",
		// 	"menu_slug"   => "site_settings_social",
		// ));

		// acf_add_options_sub_page(array(
		// 	"page_title"  => __("Бренды", 'architect'),
		// 	"menu_title"  => __("Бренды", 'architect'),
		// 	"parent_slug" => "site_settings",
		// 	"menu_slug"   => "site_settings_brands",
		// ));

		acf_add_options_sub_page(array(
			"page_title"  => __("Футер", 'architect'),
			"menu_title"  => __("Футер", 'architect'),
			"parent_slug" => "site_settings",
			"menu_slug"   => "site_settings_footer",
		));

		acf_add_options_sub_page(array(
			"page_title"  => "Cookie",
			"menu_title"  => "Cookie",
			"parent_slug" => "site_settings",
			"menu_slug"   => "site_settings_cookie",
		));

		acf_add_options_page(array(
			"page_title" => __("Формы", 'architect'),
			"menu_title" => __("Формы", 'architect'),
			"menu_slug"  => "site_forms",
			"icon_url"   => "dashicons-email-alt", // Иконка для форм
			'position'   => 3,
		));
		acf_add_options_page(array(
			"page_title"  => __("Партнеры", 'architect'),
			"menu_title"  => __("Партнеры", 'architect'),
			"menu_slug"   => "site_partners",
			'position'   => 4,
		));

	}
}

add_action('init', 'custom_acf_options', 5);
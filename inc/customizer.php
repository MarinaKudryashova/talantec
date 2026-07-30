<?php
/**
 * architect Theme Customizer
 *
 * @package architect
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function architect_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'architect_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'architect_customize_partial_blogdescription',
			)
		);
	}


	/**
	 * Секция "Внешний вид" в кастомайзер
	 */
		$wp_customize->add_section( 'theme_settings', array(
				'title'    => __( 'Внешний вид', 'architect' ),
				'priority' => 1,
		) );

		// Добавляем настройку Варианта шапки
		$wp_customize->add_setting( 'header_style', array(
				'default'           => 'compact',
				'sanitize_callback' => 'sanitize_key',
		));

		$wp_customize->add_control('header_style', array(
				'label'    => __( 'Вариант шапки', 'architect' ),
				'section'  => 'theme_settings',
				'type'     => 'radio',
				'choices'  => array(
						'compact'  => __( 'Компактная', 'architect' ),
						'default' => __( 'Стандартная', 'architect' ),
				),
		));

		//Добавляем настройку Варианта футера
		$wp_customize->add_setting( 'footer_style', array(
				'default'           => 'compact',
				'sanitize_callback' => 'sanitize_key',
		));

		$wp_customize->add_control( 'footer_style', array(
				'label'    => __( 'Вариант футера', 'architect' ),
				'section'  => 'theme_settings',
				'type'     => 'radio',
				'choices'  => array(
						'compact'  => __( 'Компактный', 'architect' ),
						'default'     => __( 'Стандартный', 'architect' ),
				),
		));

		// Цветовая тема
		$wp_customize->add_setting('color_theme', array(
				'default'           => 'default',
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'refresh',
		));

		$wp_customize->add_control('color_theme', array(
				'label'       => __('Цветовая тема', 'architect'),
				'description' => __('Выберите цветовую схему сайта', 'architect'),
				'section'     => 'theme_settings',
				'type'        => 'radio',
				'choices'     => array(
						'default'    => __('По умолчанию', 'architect'),
						'flame'   => __('Пламенный красный', 'architect'),

						'sage'   => __('Сливочный шалфей', 'architect'),
						'milk_eucalyptus'   => __('Молочный эвкалипт', 'architect'),
						'emerald_dew'   => __('Изумрудная роса', 'architect'),

						'digital_ocean'   => __('Цифровой океан', 'architect'),

				),
				'priority' => 20,
		));


	/**
	 * Секция "Свойства сайта" в кастомайзер (title_tagline)
	 */
		//Добавляем логотип
	  $wp_customize->add_setting('site_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo', array(
        'label'       => __('Логотип сайта', 'architect'),
        'description' => __('Загрузите логотип в формате PNG или SVG', 'architect'),
        'section'     => 'title_tagline',
        'priority'    => 5, 
    )));

		//Добавляем логотип (темный)
    $wp_customize->add_setting('site_logo_dark', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo_dark', array(
        'label'       => __('Логотип сайта (темный)', 'architect'),
        'description' => __('Загрузите логотип в формате PNG или SVG', 'architect'),
        'section'     => 'title_tagline',
        'priority'    => 6,  
    )));

		// Добавляем текст копирайта
    $wp_customize->add_setting('footer_copyright', array(
        'default'           => '© 2025 architect',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('footer_copyright', array(
        'label'       => __('Текст копирайта в подвале', 'architect'),
        'description' => __('Измените текст копирайта. Можно использовать HTML-теги', 'architect'),
        'section'     => 'title_tagline',
        'type'        => 'textarea',
        'priority'    => 100, 
    ));


	/**
	 * Секция "Контакты" в кастомайзер
	 */
    $wp_customize->add_section('contacts_settings', array(
        'title'       => __('Контакты', 'architect'),
        'description' => __('Настройки контактной информации сайта', 'architect'),
        'priority'    => 25, // Позиция в меню кастомайзера
    ));

		// Наименование компании
		$wp_customize->add_setting( 'company_name', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage', // опционально для live preview
		) );
		$wp_customize->add_control( 'company_name', array(
			'label'       => __( 'Наименование компании', 'architect' ),
			'section'     => 'contacts_settings',
			'type'        => 'text',
		) );

		// ИНН
		$wp_customize->add_setting( 'company_inn', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'company_inn', array(
			'label'       => __( 'ИНН', 'architect' ),
			'section'     => 'contacts_settings',
			'type'        => 'text',
		) );

		// ОГРН
		$wp_customize->add_setting( 'company_ogrn', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'company_ogrn', array(
			'label'       => __( 'ОГРН', 'architect' ),
			'section'     => 'contacts_settings',
			'type'        => 'text',
		) );
    
    // Телефон
    $wp_customize->add_setting('company_phone', array(
        'default'           => '+7 (999) 123-45-67',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('company_phone', array(
        'label'       => __('Телефон', 'architect'),
        'description' => __('Основной номер телефона', 'architect'),
        'section'     => 'contacts_settings',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '+7 (999) 123-45-67',
        ),
    ));
    
    // Почта
    $wp_customize->add_setting('company_email', array(
        'default'           => 'info@architect.ru',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('company_email', array(
        'label'       => __('Email', 'architect'),
        'description' => __('Электронная почта', 'architect'),
        'section'     => 'contacts_settings',
        'type'        => 'email',
        'input_attrs' => array(
            'placeholder' => 'info@architect.ru',
        ),
    ));
    
    // Адрес
    $wp_customize->add_setting('company_address', array(
        'default'           => 'г. Москва, ул. Примерная, д. 123',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('company_address', array(
        'label'       => __('Адрес', 'architect'),
        'description' => __('Физический адрес компании', 'architect'),
        'section'     => 'contacts_settings',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => 'г. Москва, ул. Примерная, д. 123',
        ),
    ));

	/**
	 * Секция "404 страница" в кастомайзер
	 */
		$wp_customize->add_section( 'error_404_section', array(
		'title'       => __( '404 страница', 'architect' ),
		'description' => __( 'Настройки страницы "Не найдено"', 'architect' ),
		'priority'    => 31,
	) );

	// Заголовок 404
	$wp_customize->add_setting( 'error_404_title', array(
		'default'           => '404',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'error_404_title', array(
		'label'       => __( 'Заголовок', 'architect' ),
		'description' => __( 'Основной заголовок страницы 404', 'architect' ),
		'section'     => 'error_404_section',
		'type'        => 'text',
	) );

	// Текст 404
	$wp_customize->add_setting( 'error_404_text', array(
		'default'           => __( 'Страница не найдена', 'architect' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'error_404_text', array(
		'label'       => __( 'Текст', 'architect' ),
		'description' => __( 'Краткое описание ошибки', 'architect' ),
		'section'     => 'error_404_section',
		'type'        => 'text',
	) );

	// Изображение для 404
	$wp_customize->add_setting( 'error_404_background', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'error_404_background', array(
		'label'       => __( 'Фоновое изображение', 'architect' ),
		'description' => __( 'Загрузите фоновое изображение для страницы 404', 'architect' ),
		'section'     => 'error_404_section',
	) ) );

	// Кнопка "На главную" - текст
	$wp_customize->add_setting( 'error_404_button_text', array(
		'default'           => __( 'На главную', 'architect' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'error_404_button_text', array(
		'label'       => __( 'Текст кнопки', 'architect' ),
		'description' => __( 'Текст на кнопке возврата на страницу', 'architect' ),
		'section'     => 'error_404_section',
		'type'        => 'text',
	) );

	// Кнопка "На главную" - ссылка
	$wp_customize->add_setting( 'error_404_button_url', array(
		'default'           => home_url( '/' ),
		'sanitize_callback' => 'esc_url_raw',
	) );

	// Кнопка "На главную" - выбор страницы из списка
	$wp_customize->add_setting( 'error_404_button_page', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'error_404_button_page', array(
		'label'       => __( 'Страница для кнопки', 'architect' ),
		'description' => __( 'Выберите страницу, на которую будет вести кнопка', 'architect' ),
		'section'     => 'error_404_section',
		'type'        => 'dropdown-pages',
	) );



}
add_action( 'customize_register', 'architect_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function architect_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function architect_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function architect_customize_preview_js() {
	wp_enqueue_script( 'architect-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'architect_customize_preview_js' );

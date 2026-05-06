<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package architect
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="page">

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo('description'); ?>">


  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?>/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri();?>/site.webmanifest">

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
  <meta property="og:title" content="<?php echo esc_attr(wp_title('|', false, 'right') . get_bloginfo('name')); ?>">
  <meta property="og:description" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo('description'); ?>">
  <meta property="og:image" content="<?php echo get_template_directory_uri();?>/img/site-preview.jpg">
  <meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="<?php echo esc_url( home_url( '/' ) ); ?>">
  <meta name="twitter:title" content="<?php bloginfo( 'name' ); ?>">
  <meta name="twitter:description"
    content="<?php bloginfo( 'name' ); ?> - <?php bloginfo('description'); ?>">
  <meta name="twitter:image" content="<?php echo get_template_directory_uri();?>/img/site-preview.jpg">

  <link rel="preload" href="<?php echo get_template_directory_uri();?>/fonts/InterTight-Regular.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo get_template_directory_uri();?>/fonts/InterTight-Medium.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?php echo get_template_directory_uri();?>/fonts/InterTight-SemiBold.woff2" as="font" type="font/woff2" crossorigin>

  <?php wp_head(); ?>
</head>

<body class="page__body">
  <div class="site-container">
    <header class="header" id="header">
      <div class="container">
        <div class="header__top">
					<?php
						wp_nav_menu( [
							'theme_location'  => 'header_top',
							'menu'            => 'header_top',
							'container'       => false,
							'menu_class'      => false,
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '  ',
							'link_after'      => '',
							'items_wrap'      => '<ul class="header__topmenu topmenu">%3$s</ul>',
							'depth'           => 1,
							'walker'          => new Top_Menu_Walker(),
						] );
					?>
          <!-- <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" aria-label="Перейти на главную страницу" rel="home">
            <img src="<?php echo get_field('site_logo', 'option') ?>" alt="Логотип <?php printf( esc_html__( '%1$s', 'architect' ), 'architect'); ?>" width="135" height="32">
          </a> -->

          <?php 
            $header_logo = get_theme_mod('header_logo');
            if ( $header_logo ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" aria-label="Перейти на главную страницу" rel="home">
                    <img src="<?php echo esc_url( $header_logo ); ?>" alt="Логотип <?php bloginfo('name'); ?>" width="135" height="32">
                </a>
          <?php endif; ?>

          <div class="header__action">
						<!-- <?php
							$phone = get_field('company_tel', 'options');
							$phone = explode(PHP_EOL, $phone);
							$phone_href = preg_replace('![^0-9]+!', '', $phone);
						?>
            <a href="tel:<?php echo $phone_href[0]; ?>" class="header__link header__link--phone" aria-label="позвонить нам">
              <span data-text="<?php echo $phone[0]; ?>"><?php echo $phone[0]; ?></span>
              <svg>
                <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-phone"></use>
              </svg>
            </a> -->

              <?php 
                  $phone = get_theme_mod('company_phone', '+7 (999) 123-45-67');
                  if ( $phone ) : 
                      $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
                  ?>
                      <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="header__link header__link--phone" aria-label="позвонить нам">
                          <span data-text="<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></span>
                          <svg>
                              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-phone"></use>
                          </svg>
                      </a>
              <?php endif; ?>

            <a href="#" class="header__link header__link--cost">
              <span data-text="Рассчитать стоимость">Рассчитать стоимость</span>
              <svg>
                <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-pencil"></use>
              </svg>
            </a>
            <div class="header__burger">
              <button type="button" class="burger" aria-label="Открыть меню" aria-expanded="false" data-burger>
                <!-- <span class="burger__content"> -->
                  <span class="burger__line"></span>
                <!-- <svg>
                  <use xlink:href="img/sprite.svg#icon-burger"></use>
                </svg> -->
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="header__nav">
        <div class="header__navcontainer container">
          <nav class="nav" title="main navigation" data-menu>
						<?php
							wp_nav_menu( [
								'theme_location'  => 'header',
								'menu'            => 'header',
								'container'       => false,
								'menu_class'      => false,
								'menu_id'         => '',
								'echo'            => true,
								'fallback_cb'     => 'wp_page_menu',
								'before'          => '',
								'after'           => '',
								'link_before'     => '  ',
								'link_after'      => '',
								'items_wrap'      => '<ul>%3$s</ul>',
								'depth'           => 1,
								'walker'          => new Header_Menu_Walker(),
							] );
						?>
          </nav>
        </div>
      </div>
        <div class="header__overlay"></div>
  <div class="mobile-menu" data-menu>
    <ul class="mobile-menu__list">
      <li class="mobile-menu__item accordion">
        <!-- Вкладка аккордеона -->
        <div class="accordion__item mobile-menu__accordion">
          <button class="accordion__control">
            <span class="accordion__title">Каталог</span>
            <span class="accordion__icon">
              <svg aria-hidden="true" width="24" height="24">
                <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-up"></use>
              </svg>
            </span>
          </button>
          <!-- Содержимое аккордеона -->
          <div class="accordion__content" aria-hidden="true">
            <ul class="mobile-menu__nav nav">
              <li><a href="/production.html" data-menu-item data-text="Для потребителей">Для потребителей</a></li>
              <li><a href="#" data-menu-item data-text="Услуги">Услуги</a></li>
              <li><a href="#" data-menu-item data-text="Виды изделий">Виды изделий</a></li>
              <li><a href="#" data-menu-item data-text="Бренды">Бренды</a></li>
              <li><a href="#" data-menu-item data-text="Виды изделий">Виды изделий</a></li>
              <li><a href="#" data-menu-item data-text="Стили фасадов">Стили фасадов</a></li>
              <li><a href="#" data-menu-item data-text="Технология остекления">Технология остекления</a></li>
              <li><a href="#" data-menu-item data-text="Реализованные объекты">Реализованные объекты</a></li>
            </ul>
          </div>
        </div>

      </li>
      <li class="mobile-menu__item">
        <a class="mobile-menu__link" href="#">О компании</a>
      </li>
      <li class="mobile-menu__item">
        <a class="mobile-menu__link" href="#">Блог</a>
      </li>
      <li class="mobile-menu__item">
        <a class="mobile-menu__link" href="#">Экспертность</a>
      </li>
      <li class="mobile-menu__item">
        <a class="mobile-menu__link" href="#">Контакты</a>
      </li>
    </ul>
    <div class="mobile-menu__action">
      <!-- <a href="tel:+74996886263" class="mobile-menu__link mobile-menu__link--phone" aria-label="позвонить нам">+7 (499)688-62-63</a> -->
          
          <?php 
              $phone = get_theme_mod('company_phone', '+7 (999) 123-45-67');
              if ( $phone ) : 
                  $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
              ?>
                  <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="mobile-menu__link mobile-menu__link--phone" aria-label="Позвонить нам">
                      <?php echo esc_html( $phone ); ?>
                  </a>
              <?php endif; ?>
      
      <button class="mobile-menu__btn ui-btn-arrow" type="submit">
        <span class="ui-btn-arrow__text">Рассчитать стоимость</span>
        <span class="ui-btn-arrow__arrow">
          <span class="ui-arrow">
            <svg class="ui-arrow__svg" aria-hidden>
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy" aria-hidden>
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
          </span>
        </span>
      </button>
    </div>
  </div>
    </header>
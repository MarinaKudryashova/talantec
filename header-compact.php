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
    <header class="header header--compact" id="header">
      <div class="container">
        <div class="header__top">
          <?php 
            $header_logo = get_theme_mod('site_logo');
            $header_logo_dark = get_theme_mod('site_logo_dark');
            if ( $header_logo && $header_logo_dark ) : ?>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" aria-label="Перейти на главную страницу" rel="home">
                <img src="<?php echo esc_url( $header_logo ); ?>" class="header__imglogo" alt="Логотип <?php bloginfo('name'); ?>" width="135" height="32">
                <img src="<?php echo esc_url( $header_logo_dark ); ?>" class="header__imglogo  header__imglogo--dark" alt="Логотип <?php bloginfo('name'); ?>" width="135" height="32">
              </a>
          <?php endif; ?>

          <?php
            wp_nav_menu( [
              'theme_location'  => 'header_compact',
              'menu'            => 'header_compact',
              'container'       => false,
              'menu_class'      => false,
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => 'wp_page_menu',
              'before'          => '',
              'after'           => '',
              'link_before'     => '  ',
              'link_after'      => '',
              'items_wrap'      => '<ul class="header-compact__menu topmenu">%3$s</ul>',
              'depth'           => 1,
              'walker'          => new Header_Menu_Walker(),
            ] );
          ?>
              
          <div class="header-compact__action">
            <!-- Телефон -->
            <?php 
              $phone = get_theme_mod('company_phone', '+7 (999) 123-45-67');
              if ( $phone ) : 
                  $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
              ?>
                <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="header-compact__link header-compact__link--phone" aria-label="позвонить нам">
                  <span data-text="<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></span>
                  <svg>
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-phone"></use>
                  </svg>
                </a>
            <?php endif; ?>

                
            <!-- Кнопка "Рассчитать стоимость" -->
            <a href="#" class="header-compact__link header-compact__link--cost">
              <span data-text="Рассчитать стоимость">Рассчитать стоимость</span>
              <svg>
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-pencil"></use>
              </svg>
            </a>
                
            <!-- Бургер -->
            <div class="header-compact__burger">
              <button type="button" class="burger" aria-label="Открыть меню" aria-expanded="false" data-burger>
                <span class="burger__line"></span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="header__overlay"></div>
      <div class="mobile-menu" data-menu>
        <?php
            wp_nav_menu( [
              'theme_location'  => 'header_compact',
              'menu'            => 'header_compact',
              'container'       => false,
              'menu_class'      => false,
              'menu_id'         => '',
              'echo'            => true,
              'fallback_cb'     => 'wp_page_menu',
              'before'          => '',
              'after'           => '',
              'link_before'     => '  ',
              'link_after'      => '',
              'items_wrap'      => '<ul class="mobile-menu__list">%3$s</ul>',
              'depth'           => 2,
              'walker'          => new Mobile_Menu_Walker(),
            ] );
          ?>
        <div class="mobile-menu__action">
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
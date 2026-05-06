<?php

/**
 * Шаблон "Первый блок - фиксированный (главная)"
*/

  $page_id = isset($args['id']) ? $args['id'] : get_the_ID();

  $promo_bgimg_desktop = get_field('mainpromo_bgimg', $page_id);
  $promo_image_versions = (!empty($promo_bgimg_desktop) && function_exists('get_image_versions')) 
    ? get_image_versions($promo_bgimg_desktop)
    : array('full' => get_template_directory_uri() . '/img/hero/hero.jpg');

  $promo_bgimg_mobile = get_field('mainpromo_bgimg_tablet', $page_id);
  $promo_image_mobile_versions = (!empty($promo_bgimg_mobile) && function_exists('get_image_versions')) 
    ? get_image_versions($promo_bgimg_mobile)
    : array('full' => get_template_directory_uri() . '/img/hero/hero-mobile.jpg');

  $mainpromo_link = get_field('mainpromo_link');
  $promo_link_href = (!empty($mainpromo_link) && $mainpromo_link !== '#') ? $mainpromo_link : '#';

  $mainpromo_link_name = get_field('mainpromo_link_name');
  $promo_link_text = !empty($mainpromo_link_name) ? esc_html($mainpromo_link_name) : 'Связаться с&#160;нами';
?>

<section class="hero" aria-label="Главный баннер">
  <div class="hero__container container">
    <div class="hero__content">
      <div class="hero__textcontent">
        <?php if (!empty(get_field('mainpromo_title'))) : ?>
        <h1 class="hero__title"><?php echo get_field('mainpromo_title'); ?></h1>
        <?php endif; ?>

        <?php if (!empty(get_field('mainpromo_descr'))) : ?>
        <p class="hero__description">
          <?php echo esc_html(get_field('mainpromo_descr')); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="hero__link">
        <a href="<?php echo esc_url($promo_link_href); ?>" class="hero-link-arrow">
          <span class="hero-link-arrow__text"><?php echo $promo_link_text; ?></span>
          <span class="ui-arrow">
            <svg class="ui-arrow__svg">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
          </span>
        </a>
      </div>
    </div>
  </div>

  <?php /*-- фон --*/ ?>
  <div class="hero__bg hero-bg">
    <?php /*-- фото --*/ ?>
    <picture class="hero-bg__img">
      <source media="(max-width: 576px)" srcset="<?php echo esc_url($promo_image_mobile_versions['webp_1x']); ?>" type="image/webp">
      <source media="(max-width: 576px)" srcset="<?php echo esc_url($promo_image_mobile_versions['original_1x']); ?>" type="image/jpg">
      <source srcset="<?php echo esc_url($promo_image_versions['webp_1x']); ?>" type="image/webp">
      <img src="<?php echo esc_url($promo_image_versions['original_1x']); ?>" width="1440" height="800" aria-hidden="true" alt="">
    </picture>
     
    <?php /*-- SVG маска --*/ ?>
    <div class="hero-bg__mask">
      <div class="hero-bg__mask-inner" style="background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)),
      url('<?php echo esc_url($promo_image_versions['original_1x']); ?>'); background-size: cover; background-position: center bottom;background-repeat: no-repeat;"></div>
    </div>

    <?php /*-- затемнее --*/ ?>
    <div class="hero-bg__filter"></div>

    <?php /*-- Декоративный фон svg --*/ ?>
    <div class="hero-bg__line">
      <img src="<?php echo get_template_directory_uri();?>/img/hero/bgline.svg" width="1440" height="698" aria-hidden="true" alt="">
    </div>

  </div>
</section>
<?php
/**
 * Шаблон "Первый блок - фиксированный (продуктовая)"
*/

$page_id = get_the_ID();
  $production_promo_bgimg_desktop = get_field('production-promo_bgimg', $page_id);
  $production_promo_image_versions = (!empty($production_promo_bgimg_desktop) && function_exists('get_image_versions')) 
    ? get_image_versions($production_promo_bgimg_desktop)
    : array('full' => get_template_directory_uri() . '/img/hero/hero.jpg');

  $production_promo_bgimg_mobile = get_field('production-promo_bgimg_tablet', $page_id);
  $production_promo_image_mobile_versions = (!empty($production_promo_bgimg_mobile) && function_exists('get_image_versions')) 
    ? get_image_versions($production_promo_bgimg_mobile)
    : array('full' => get_template_directory_uri() . '/img/hero/hero-mobile.jpg');

  $production_promo_link = get_field('production-promo_link');
  $promo_link_href = (!empty($production_promo_link) && $production_promo_link !== '#') ? $production_promo_link : '#';
?>

<section class="hero hero--production" aria-label="Продуктовый баннер">
  <div class="hero__container container">
    <div class="hero__content">
      <?php get_template_part( "template-parts/components/breadcrumbs", "", $page_id); ?>

      <div class="hero__textcontent">
        <h1 class="hero__title"><?php echo get_the_title($page_id); ?></h1>

        <?php if (!empty(get_field('production-promo_descr'))) : ?>
        <p class="hero__description">
          <?php echo wp_kses_post(get_field('production-promo_descr')); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="hero__link">
        <a href="<?php echo esc_url($promo_link_href); ?>" class="ui-btn-arrow">
          <span class="ui-btn-arrow__text"><?php _e('Заказать услугу', 'veterinary'); ?></span>
          <span class="ui-btn-arrow__arrow">
            <span class="ui-arrow">
              <svg class="ui-arrow__svg">
                <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
              </svg>
              <svg class="ui-arrow__svg ui-arrow__svg--copy">
                <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
              </svg>
            </span>
          </span>
        </a>
      </div>
    </div>
  </div>
  <!-- фон -->
  <div class="hero__bg hero-bg">
    <!-- фото -->
    <picture class="hero-bg__img">
      <source media="(max-width: 576px)" srcset="<?php echo esc_url($production_promo_image_mobile_versions['webp_1x']); ?>"
        type="image/webp">
      <source media="(max-width: 576px)" srcset="i<?php echo esc_url($production_promo_image_mobile_versions['original_1x']); ?>"
        type="image/jpg">
        <source srcset="<?php echo esc_url($production_promo_image_versions['webp_1x']); ?>" type="image/webp">
      <img loading="lazy" src="<?php echo esc_url($production_promo_image_versions['original_1x']); ?>" width="1440" height="800"
        aria-hidden="true" alt="">
    </picture>
    <!-- затемнее -->
    <div class="hero-bg__filter"></div>
    <!-- Декоративный фон svg -->
    <div class="hero-bg__line hero-bg__line--production">
      <img src="<?php echo get_template_directory_uri();?>/img/hero/bgline.svg" width="1440" height="698" aria-hidden="true" alt="">
    </div>

  </div>
</section>
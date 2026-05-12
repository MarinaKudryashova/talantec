<?php

/**
 * Шаблон "Первый блок - (главная страница)"
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

  $mainpromo_mask_bg = get_field('mainpromo_mask_bg');
  $mainpromo_mask_bg_text = $mainpromo_mask_bg["text"];
  $mainpromo_mask_bg_fs = $mainpromo_mask_bg["font_size"];
  $mainpromo_mask_bgk_fw = $mainpromo_mask_bg["font_weight"];
  $mainpromo_mask_bgk_lh = $mainpromo_mask_bg["letter_spacing"];
  $mainpromo_mask_bg_brightness = $mainpromo_mask_bg["brightness"];
  $mainpromo_mask_bg_contrast = $mainpromo_mask_bg["contrast"];
  $svg_content = '<svg width="1312" height="273" viewBox="0 0 1312 273" xmlns="http://www.w3.org/2000/svg">
    <g fill="white">
      <text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" font-family="Impact, Arial Black, sans-serif" font-size="'.$mainpromo_mask_bg_fs.'" font-weight="'.$mainpromo_mask_bgk_fw.'" letter-spacing="'.$mainpromo_mask_bgk_lh.'">'.$mainpromo_mask_bg_text.'</text>
    </g>
  </svg>';
  $svg_encoded = rawurlencode($svg_content);
  $mask_url = "data:image/svg+xml;utf8,{$svg_encoded}";
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
      <div class="hero-bg__mask-inner"
      style="background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)), url('<?php echo esc_url($promo_image_versions['original_1x']); ?>');
      background-size: cover;
      background-position: center bottom;
      background-repeat: no-repeat;
      filter: brightness(<?php echo $mainpromo_mask_bg_brightness ?>) contrast(<?php echo $mainpromo_mask_bg_contrast ?>);
      -webkit-mask-image: url('<?php echo $mask_url; ?>');
      mask-image: url('<?php echo $mask_url; ?>');
      -webkit-mask-size: 100% 100%;
      mask-size: 100% 100%;
      -webkit-mask-repeat: no-repeat;
      mask-repeat: no-repeat;
      -webkit-mask-position: center;
      mask-position: center;"></div>
    </div>

    <?php /*-- затемнее --*/ ?>
    <div class="hero-bg__filter"></div>

    <?php /*-- Декоративный фон svg --*/ ?>
    <div class="hero-bg__line">
      <img src="<?php echo get_template_directory_uri();?>/img/hero/bgline.svg" width="1440" height="698" aria-hidden="true" alt="">
    </div>

  </div>
</section>
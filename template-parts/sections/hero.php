<?php

/**
 * Шаблон "Первый блок - (главная страница)"
*/

  $page_id = isset($args['id']) ? $args['id'] : get_the_ID();
  $placeholder = get_template_directory_uri() . '/img/hero/hero.jpg';

  $promo_bgimg_desktop = get_field('mainpromo_bgimg', $page_id);
  $promo_image_versions = (!empty($promo_bgimg_desktop) && function_exists('get_image_versions'))
    ? get_image_versions($promo_bgimg_desktop, 'full', false)
    : array(
        'original_1x' => $placeholder,
        'webp_1x'     => '',
        'format'      => 'jpg',
      );

  $promo_bgimg_mobile = get_field('mainpromo_bgimg_tablet', $page_id);
  $promo_image_mobile_versions = architect_get_mobile_image_versions($promo_bgimg_mobile, $promo_bgimg_desktop, 'large');
  if (empty($promo_image_mobile_versions['original_1x'])) {
    $promo_image_mobile_versions = $promo_image_versions;
  }

  $mainpromo_link = get_field('mainpromo_link');
  $promo_link_href = (!empty($mainpromo_link) && $mainpromo_link !== '#') ? $mainpromo_link : '#';

  $mainpromo_link_name = get_field('mainpromo_link_name');
  $promo_link_text = !empty($mainpromo_link_name) ? $mainpromo_link_name : 'Связаться с нами';

  $mainpromo_mask_bg = get_field('mainpromo_mask_bg');
  $mainpromo_mask_bg = is_array($mainpromo_mask_bg) ? $mainpromo_mask_bg : array();
  $mainpromo_mask_bg_text = isset($mainpromo_mask_bg['text']) ? (string) $mainpromo_mask_bg['text'] : '';
  $mainpromo_mask_bg_fs = isset($mainpromo_mask_bg['font_size']) ? preg_replace('/[^0-9.]/', '', (string) $mainpromo_mask_bg['font_size']) : '290';
  $mainpromo_mask_bgk_fw = isset($mainpromo_mask_bg['font_weight']) ? preg_replace('/[^a-zA-Z0-9\-]/', '', (string) $mainpromo_mask_bg['font_weight']) : 'normal';
  $mainpromo_mask_bgk_lh = isset($mainpromo_mask_bg['letter_spacing']) ? preg_replace('/[^0-9.\-]/', '', (string) $mainpromo_mask_bg['letter_spacing']) : '10';
  $mainpromo_mask_bg_brightness = isset($mainpromo_mask_bg['brightness']) ? preg_replace('/[^0-9.]/', '', (string) $mainpromo_mask_bg['brightness']) : '1.2';
  $mainpromo_mask_bg_contrast = isset($mainpromo_mask_bg['contrast']) ? preg_replace('/[^0-9.]/', '', (string) $mainpromo_mask_bg['contrast']) : '1.2';
  $svg_text = htmlspecialchars($mainpromo_mask_bg_text, ENT_QUOTES | ENT_XML1, 'UTF-8');
  $svg_content = '<svg width="1312" height="273" viewBox="0 0 1312 273" xmlns="http://www.w3.org/2000/svg">
    <g fill="white">
      <text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" font-family="Impact, Arial Black, sans-serif" font-size="'.$mainpromo_mask_bg_fs.'" font-weight="'.$mainpromo_mask_bgk_fw.'" letter-spacing="'.$mainpromo_mask_bgk_lh.'">'.$svg_text.'</text>
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
        <h1 class="hero__title"><?php echo wp_kses_post(get_field('mainpromo_title')); ?></h1>
        <?php endif; ?>

        <?php if (!empty(get_field('mainpromo_descr'))) : ?>
        <p class="hero__description">
          <?php echo esc_html(get_field('mainpromo_descr')); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="hero__link">
        <a href="<?php echo esc_url($promo_link_href); ?>" class="hero-link-arrow">
          <span class="hero-link-arrow__text"><?php echo esc_html($promo_link_text); ?></span>
          <span class="ui-arrow">
            <svg class="ui-arrow__svg">
              <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy">
              <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/sprite.svg#icon-arrow-diagonal"></use>
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
      <?php architect_picture_mobile_sources($promo_image_mobile_versions); ?>
      <?php if (!empty($promo_image_versions['webp_1x'])) : ?>
      <source srcset="<?php echo esc_url($promo_image_versions['webp_1x']); ?>" type="image/webp">
      <?php endif; ?>
      <img src="<?php echo esc_url($promo_image_versions['original_1x']); ?>" width="1440" height="800" aria-hidden="true" alt="" loading="eager" decoding="async" fetchpriority="high">
    </picture>
     
    <?php /*-- SVG маска --*/ ?>
    <div class="hero-bg__mask">
      <div class="hero-bg__mask-inner"
      style="--hero-mask-img: url('<?php echo esc_url($promo_image_versions['original_1x']); ?>');
      --hero-mask-img-mobile: url('<?php echo esc_url($promo_image_mobile_versions['original_1x']); ?>');
      --hero-mask-brightness: <?php echo esc_attr($mainpromo_mask_bg_brightness); ?>;
      --hero-mask-contrast: <?php echo esc_attr($mainpromo_mask_bg_contrast); ?>;
      -webkit-mask-image: url('<?php echo esc_attr($mask_url); ?>');
      mask-image: url('<?php echo esc_attr($mask_url); ?>');"></div>
    </div>

    <?php /*-- затемнее --*/ ?>
    <div class="hero-bg__filter"></div>

    <?php /*-- Декоративный фон svg --*/ ?>
    <div class="hero-bg__line">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/hero/bgline.svg" width="1440" height="698" aria-hidden="true" alt="" loading="lazy" decoding="async">
    </div>

  </div>
</section>

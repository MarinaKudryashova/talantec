<?php
/**
 * Шаблон "Первый блок - фиксированный"
*/

$page_id = isset($args['id']) ? $args['id'] : get_the_ID();
  $page_promo_bgimg_desktop = get_field('page-promo_bgimg', $page_id);
  $page_promo_image_versions = (!empty($page_promo_bgimg_desktop) && function_exists('get_image_versions')) 
    ? get_image_versions($page_promo_bgimg_desktop)
    : array(
      'full' => get_template_directory_uri() . '/img/hero/hero.jpg',
      'original_1x' => get_template_directory_uri() . '/img/hero/hero.jpg',
      'webp_1x' => get_template_directory_uri() . '/img/hero/hero.webp'
      );

  $page_promo_bgimg_mobile = get_field('page-promo_bgimg_tablet', $page_id);
  $page_promo_image_mobile_versions = ($page_promo_bgimg_mobile && !empty($page_promo_bgimg_mobile) && function_exists('get_image_versions')) 
    ? get_image_versions($page_promo_bgimg_mobile)
    : $page_promo_image_versions;

  $page_promo_link = get_field('page-promo_link');
  $promo_link_href = (!empty($page_promo_link) && $page_promo_link !== '#') ? $page_promo_link : '#';

  // Определяем заголовок страницы
  if (is_home() && !is_front_page()) {
      // Страница блога
      $page_promo_title = single_post_title('', false);
  } elseif (is_archive() || is_search()) {
      // Архивы и поиск
      $pagpage_promo_titlee_title = get_the_archive_title();
  } else {
      // Все остальные страницы (посты, страницы, главная)
      $page_promo_title = get_the_title($page_id);
  }
?>

<section class="hero hero--page" aria-label="Баннер">
  <div class="hero__container container">
    <div class="hero__content">
      <?php get_template_part( "template-parts/components/breadcrumbs", "", $page_id); ?>

      <div class="hero__textcontent">
        <h1 class="hero__title"><?php echo $page_promo_title; ?></h1>

        <?php if (!empty(get_field('page-promo_descr'))) : ?>
        <p class="hero__description">
          <?php echo wp_kses_post(get_field('page-promo_descr')); ?>
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
      <?php if ($page_promo_image_mobile_versions['webp_1x']) : ?>
      <source media="(max-width: 576px)" srcset="<?php echo esc_url($page_promo_image_mobile_versions['webp_1x']); ?>"
        type="image/webp">
      <?php endif; ?>
      <?php if ($page_promo_image_mobile_versions['original_1x']) : ?>
      <source media="(max-width: 576px)" srcset="i<?php echo esc_url($page_promo_image_mobile_versions['original_1x']); ?>"
        type="image/jpg">
      <?php endif; ?>
      <source srcset="<?php echo esc_url($page_promo_image_versions['webp_1x']); ?>" type="image/webp">
      <img loading="lazy" src="<?php echo esc_url($page_promo_image_versions['original_1x']); ?>" width="1440" height="800"
        aria-hidden="true" alt="">
    </picture>
    <!-- затемнее -->
    <div class="hero-bg__filter"></div>
    <!-- Декоративный фон svg -->
    <div class="hero-bg__line hero-bg__line--page">
      <img src="<?php echo get_template_directory_uri();?>/img/hero/bgline.svg" width="1440" height="698" aria-hidden="true" alt="">
    </div>

  </div>
</section>
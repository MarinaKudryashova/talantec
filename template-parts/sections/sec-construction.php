 <?php
/*
* Section: Сооружения 
*/

$sec_construction_title = get_field('sec-construction_title');
$sec_construction_subtitle = get_field('sec-construction_subtitle');
$sec_construction_list = get_field('sec-construction_list');
?>
<section class="sec-construction">
  <div class="sec-construction__container container">
    <div class="sec-construction__heading">
      <div class="sec-construction__inner">
        <?php if (!empty($sec_construction_title)) : ?>
        <h2 class="sec-construction__title sec-title"><?php esc_html_e($sec_construction_title); ?></h2>
        <?php endif; ?>
        
        <?php if (!empty($sec_construction_subtitle)) : ?>
        <p class="sec-construction__subtitle"><?php echo wp_kses_post($sec_construction_subtitle); ?></p>
        <?php endif; ?>
      </div>
      <div class="sec-construction__nav slider-nav">
        <button class="sec-construction__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="sec-construction__btn-next slider-nav__btn slider-nav__btn--next">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
      </div>
    </div>

    <?php if($sec_construction_list) : ?>
    <div class="swiper sec-construction__slider">
      <div class="swiper-wrapper">
        <?php while(has_sub_field('sec-construction_list')) : 
          $item_name = get_sub_field('title');
          $item_link = get_sub_field('link');
          $item_link_href = (!empty($item_link) && $item_link !== '#') ? $item_link : '#';
          $item_img = get_sub_field('img');
          $template_dir = get_template_directory_uri();
          $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
              ? get_image_versions($item_img)
              : array(
                  'webp_1x' => $template_dir . '/img/site-preview.webp',
                  'original_1x' => $template_dir . '/img/site-preview.jpg',
                  'full' => $template_dir . '/img/site-preview.jpg'
              );
        ?>
        <div class="swiper-slide">
          <a href="<?php echo esc_url($item_link_href); ?>" class="construction-card">
            <picture class="construction-card__img">
              <source srcset="<?php echo esc_url($item_img_versions['webp_1x']); ?>" type="image/webp">
              <img loading="lazy" src="<?php echo esc_url($item_img_versions['original_1x']); ?>" width="416" height="400" alt="">
            </picture>
            <div class="construction-card__content">
              <span class="construction-card__link">
                <?php if (!empty($item_name)) : ?>
                <span class="construction-card__name"><?php esc_html_e($item_name); ?></span>
                <?php endif; ?>
                <span class="construction-card__arrow">
                  <span class="construction-card__icons ui-arrow">
                    <svg class="ui-arrow__svg">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                    <svg class="ui-arrow__svg ui-arrow__svg--copy">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                  </span>
                </span>
              </span>
            </div>
          </a>
        </div>
        <?php endwhile; ?>

      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
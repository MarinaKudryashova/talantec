<?php
/*
* Section: Стиль
*/

$sec_style_title = get_field('sec-style_title');
$sec_style_subtitle = get_field('sec-style_subtitle');
$sec_style_list = get_field('sec-style_list');
?>
<section class="sec-style">
  <div class="sec-style__container container">
    <div class="sec-style__heading">
      <div class="sec-style__inner">
        <?php if (!empty($sec_style_title)) : ?>
        <h2 class="sec-style__title sec-title"><?php esc_html_e($sec_style_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($sec_style_subtitle)) : ?>
        <p class="sec-style__subtitle"><?php echo wp_kses_post($sec_style_subtitle); ?></p>
        <?php endif; ?>
      </div>
      <div class="sec-style__nav slider-nav">
        <button class="sec-style__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="sec-style__btn-next slider-nav__btn slider-nav__btn--next">
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

    <!-- Слайдер -->
    <?php if($sec_style_list) : 
      $template_dir = get_template_directory_uri();
  
      // Собираем все данные в массив
      $style_data = array();
      
      while(has_sub_field('sec-style_list')) {
        $item_name = get_sub_field('title');
        $item_link = get_sub_field('link');
        $item_img = get_sub_field('img');
        
        $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
            ? get_image_versions($item_img)
            : array(
                'webp_1x' => $template_dir . '/img/site-preview.webp',
                'original_1x' => $template_dir . '/img/site-preview.jpg',
                'full' => $template_dir . '/img/site-preview.jpg'
            );
        
        $style_data[] = array(
          'name' => $item_name,
          'link' => (!empty($item_link) && $item_link !== '#') ? $item_link : '#',
          'img_versions' => $item_img_versions
        );
        
      }
      
      if(!empty($style_data)) :
    ?>
    <div class="style-slider">
      <div class="swiper style-slider__large">
        <div class="swiper-wrapper">
          <?php foreach($style_data as $style) : ?>
          <div class="swiper-slide">
            <a href="<?php echo esc_url($style['link']); ?>" class="ui-card">
              <picture class="ui-card__img">
                <source srcset="<?php echo esc_url($style['img_versions']['webp_1x']); ?>" type="image/webp">
                <img loading="lazy" src="<?php echo esc_url($style['img_versions']['original_1x']); ?>" width="640" height="425" aria-hidden="true"
                  alt="">
              </picture>
              <div class="ui-card__link">
                <?php if (!empty($style['name'])) : ?>
                <span class="ui-card__name"><?php echo esc_html($style['name']); ?></span>
                <?php endif; ?>
                <span class="ui-card__arrow">
                  <span class="ui-arrow">
                    <svg class="ui-arrow__svg">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                    <svg class="ui-arrow__svg ui-arrow__svg--copy">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                  </span>
                </span>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="swiper style-slider__thumbs">
        <div class="swiper-wrapper">
          <?php foreach($style_data as $style) : ?>
          <div class="swiper-slide">
            <a href="<?php echo esc_url($style['link']); ?>" class="ui-card">
              <picture class="ui-card__img">
                <source srcset="<?php echo esc_url($style['img_versions']['webp_1x']); ?>" type="image/webp">
                <img loading="lazy" src="<?php echo esc_url($style['img_versions']['original_1x']); ?>" width="304" height="203" aria-hidden="true"
                  alt="">
              </picture>
              <div class="ui-card__link">
                <?php if (!empty($style['name'])) : ?>
                <span class="ui-card__name"><?php echo esc_html($style['name']); ?></span>
                <?php endif; ?>
                <span class="ui-card__arrow">
                  <span class="ui-arrow">
                    <svg class="ui-arrow__svg">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                    <svg class="ui-arrow__svg ui-arrow__svg--copy">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                  </span>
                </span>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
        </div>

      </div>

    </div>

    <!-- Мобильный слайдер -->
    <div class="style-slider-mobile">
      <div class="swiper style-slider-mobile__slider slider">
        <div class="swiper-wrapper">
          <?php foreach($style_data as $style) : ?>
          <div class="swiper-slide">
            <a href="<?php echo esc_url($style['link']); ?>" class="ui-card">
              <picture class="ui-card__img">
                <source srcset="<?php echo esc_url($style['img_versions']['webp_1x']); ?>" type="image/webp">
                <img loading="lazy" src="<?php echo esc_url($style['img_versions']['original_1x']); ?>" width="304" height="203" aria-hidden="true"
                  alt="">
              </picture>
              <div class="ui-card__link">
                <?php if (!empty($style['name'])) : ?>
                <span class="ui-card__name"><?php echo esc_html($style['name']); ?></span>
                <?php endif; ?>
                <span class="ui-card__arrow">
                  <span class="ui-arrow">
                    <svg class="ui-arrow__svg">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                    <svg class="ui-arrow__svg ui-arrow__svg--copy">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                    </svg>
                  </span>
                </span>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
</section>
 <?php
/*
* Section: Компоненты
*/

$sec_components_title = get_field('sec-components_title');
$sec_components_subtitle = get_field('sec-galleryworks_subtitle');
$sec_components_list = get_field('sec-components_show_blocks');

?>

<section class="sec-components">
  <div class="sec-components__container container">
    <div class="sec-components__heading">
      <?php if (!empty($sec_components_title)) : ?> 
      <h2 class="sec-title"><?php esc_html_e($sec_components_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_components_subtitle)) : ?> 
      <p class="sec-components__subtitle"><?php esc_html_e($sec_components_subtitle); ?></p>
      <?php endif; ?>
    </div>
    <!-- Табы   -->
     <?php if (!empty($sec_components_list && is_array($sec_components_list))) : ?> 
    <div class="tabs sec-components__content components-content" data-tabs="tabs-components">
      <ul class="tabs__nav components-content__nav">
        <!-- кнопки -->
        <?php foreach ($sec_components_list as $block) : ?>
        <li class="tabs__nav-item components-content__nav-item"><button
            class="components-content__btn tabs__nav-btn" type="button"><?php echo $block["label"]; ?></button>
        </li>
        <?php endforeach; ?>
      </ul>
      <!-- Полоса-индикатор -->
      <div class="components-content__nav-line">
        <div class="components-content__nav-indicator"></div>
      </div>
      <div class="tabs__content">
        <!-- блоки: Материалы, Компоненты, Технологии, Архитектурные системы -->
        <?php 
          foreach ($sec_components_list as $block) :

          $field_title = 'block-' . $block["value"] . '_title'; 
          $field_descr = 'block-' . $block["value"] . '_descr'; 
          $field_list = 'block-' . $block["value"] . '_list';

          $block_title = get_field($field_title);
          $block_subtitle = get_field($field_descr);
          $block_list = get_field($field_list); 
        ?>
        <div class="tabs__panel components-content__content">
          <div class="components-info">
            <div class="components-info__heading">
              <div class="components-info__inner">
                <?php if (!empty($block_title)) : ?>
                <h2 class="components-info__title"><?php esc_html_e($block_title); ?></h2>
                <?php endif; ?>

                <?php if (!empty($block_subtitle)) : ?>
                <p class="components-info__text"><?php esc_html_e($block_subtitle); ?></p>
                <?php endif; ?>
              </div>
              <div class="components-info__nav slider-nav">
                <button class="components-info__btn-prev slider-nav__btn slider-nav__btn--prev">
                  <span class="slider-nav__icons">
                    <svg class="slider-nav__icon slider-nav__icon--original">
                      <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
                    </svg>
                    <svg class="slider-nav__icon slider-nav__icon--copy">
                      <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
                    </svg>
                  </span>
                </button>
                <button class="components-info__btn-next slider-nav__btn slider-nav__btn--next">
                  <span class="slider-nav__icons">
                    <svg class="slider-nav__icon slider-nav__icon--original">
                      <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
                    </svg>
                    <svg class="slider-nav__icon slider-nav__icon--copy">
                      <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
                    </svg>
                  </span>
                </button>
              </div>
            </div>

            <?php if (!empty($block_list) && is_array($block_list)) : ?> 
            <div class="swiper components-info__slider">
              <div class="swiper-wrapper">
                <?php 
                  foreach ($block_list as $item) : 

                  $item_name = $item["name"];

                  $item_link = $item["link"];
                  $item_link_href = (!empty($item_link) && $item_link !== '#') ? $item_link : '#';
                  
                  $item_img = $item["img"];
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
                  <a href="<?php echo esc_url($item_link_href); ?>" class="components-card">
                    <picture class="components-card__view">
                      <source srcset="<?php echo esc_url($item_img_versions['webp_1x']); ?>" type="image/webp">
                      <img loading="lazy" src="<?php echo esc_url($item_img_versions['original_1x']); ?>" class="components-card__img"
                        width="304" height="312" aria-hidden="true" alt="">
                    </picture>
                    <span class="components-card__link">
                      <?php if (!empty($item_name)) : ?>
                      <span class="components-card__name"><?php esc_html_e($item_name); ?></span>
                      <?php endif; ?>
                      <span class="components-card__arrow">
                        <span class="components-card__icons ui-arrow">
                          <svg class="ui-arrow__svg">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow-diagonal"></use>
                          </svg>
                          <svg class="ui-arrow__svg ui-arrow__svg--copy">
                            <use xlink:href="<?php echo get_template_directory_uri() ?>/img/sprite.svg#icon-arrow-diagonal"></use>
                          </svg>
                        </span>
                      </span>
                    </span>
                  </a>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
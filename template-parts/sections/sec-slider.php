 <?php
/*
* Section: Слайдер
*/
$page_id = $args['id'] ?? 0;
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';
$layout_ids = $args['layout-ids'] ?? '';

$field_title = $layout_name . '_title';
$field_subtitle = $layout_name . '_subtitle';
$field_type = $layout_name . '_type';
$field_list = $layout_name . '_list';

$sec_slider_title = $layout_data[$field_title];
$sec_slider_subtitle = $layout_data[$field_subtitle];
$sec_slider_type = $layout_data[$field_type];
$sec_slider_list = $layout_data[$field_list];
if($sec_slider_list) {
  $template_dir = get_template_directory_uri();

  // Собираем все данные в массив
  $slider_data = array();
  
  foreach ($sec_slider_list as $key => $slide) {

    $item_name = $slide["title"];
    $item_link = $slide["link"];
    $item_img = $slide["img"];
    
    $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
        ? get_image_versions($item_img)
        : array(
            'webp_1x' => $template_dir . '/img/site-preview.webp',
            'original_1x' => $template_dir . '/img/site-preview.jpg',
            'full' => $template_dir . '/img/site-preview.jpg'
        );
    
    $slider_data[] = array(
      'name' => $item_name,
      'link' => (!empty($item_link) && $item_link !== '#') ? $item_link : '#',
      'img_versions' => $item_img_versions
    );
    
  }
  
}
// var_dump($sec_slider_type);
?>

<section class="<?php echo esc_attr($sec_slider_type); ?>" id="<?php echo esc_attr($sec_slider_type) .'-'. $layout_ids; ?>">
  <div class="<?php echo esc_attr($sec_slider_type); ?>__container container">
  <?php if ($sec_slider_type !== 'sec-materials') : ?>
    <div class="<?php echo esc_attr($sec_slider_type); ?>__heading">
      <div class="<?php echo esc_attr($sec_slider_type); ?>__inner">
        <?php if (!empty($sec_slider_title)) : ?>
        <h2 class="<?php echo esc_attr($sec_slider_type); ?>__title sec-title"><?php esc_html_e($sec_slider_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($sec_slider_subtitle)) : ?>
        <p class="<?php echo esc_attr($sec_slider_type); ?>__subtitle">
          <?php echo wp_kses_post($sec_slider_subtitle); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="<?php echo esc_attr($sec_slider_type); ?>__nav slider-nav">
        <button class="<?php echo esc_attr($sec_slider_type); ?>__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="<?php echo esc_attr($sec_slider_type); ?>__btn-next slider-nav__btn slider-nav__btn--next">
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
    <?php if ($sec_slider_type !== 'sec-style') : ?>      
      <?php if($sec_slider_list && !empty($slider_data)) : ?>
      <div class="swiper <?php echo esc_attr($sec_slider_type); ?>__slider">
        <div class="swiper-wrapper">
          <?php switch ($sec_slider_type) { 
            case 'sec-projects':
              foreach ($slider_data as $item) :
          ?>
            <div class="swiper-slide">
              <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
            </div>
          <?php 
              endforeach;
              break;
            case 'sec-construction':
              foreach ($slider_data as $item) :
          ?>
            <div class="swiper-slide">
              <a href="<?php echo esc_url($item['link']); ?>" class="construction-card">
                <picture class="construction-card__img">
                  <?php if (!empty($item['img_versions']['webp_1x'])) : ?>
                  <source srcset="<?php echo esc_url($item['img_versions']['webp_1x']); ?>" type="image/webp">
                  <?php endif; ?>
                  <img loading="lazy" src="<?php echo esc_url($item['img_versions']['original_1x']); ?>" width="416" height="400" alt="">
                </picture>
                <div class="construction-card__content">
                  <span class="construction-card__link">
                    <?php if (!empty($item['name'])) : ?>
                    <span class="construction-card__name"><?php echo esc_html($item['name']); ?></span>
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
          <?php 
              endforeach;
              break;
          ?>
          <!-- break;
          case 'sec-construction':
            break; -->
            <?php } ?>
        </div>
      </div>
      <?php endif; ?>
    <?php else : 
        get_template_part( "template-parts/sections/content", 'sec-style', array('id' => $page_id, 'layout-data' => $layout_data, 'layout-name' => $layout_name));
      endif; 
    ?>
  <?php else : 
      get_template_part( "template-parts/sections/content", 'sec-materials', array('id' => $page_id, 'layout-data' => $layout_data, 'layout-name' => $layout_name));
    endif;
  ?>
  </div>
</section>

 <?php
$page_id = $args['id'] ?? 0;
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';


$field_title = $layout_name . '_title';
$field_type = $layout_name . '_type';
$field_list = $layout_name . '_list';
$field_slogan = $layout_name . '_slogan';
$field_descr = $layout_name . '_descr';


$sec_slider_title = $layout_data[$field_title];
$sec_slider_type = $layout_data[$field_type];
$sec_slider_list = $layout_data[$field_list];
$sec_slider_slogan = $layout_data[$field_slogan];
$sec_slider_descr = $layout_data[$field_descr];

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
?>

<div class="<?php echo esc_attr($sec_slider_type); ?>__heading">
  <?php if (!empty($sec_slider_title)) : ?>
    <h2 class="<?php echo esc_attr($sec_slider_type); ?>__title sec-title"><?php esc_html_e($sec_slider_title); ?></h2>
  <?php endif; ?>

  <?php if (!empty($sec_slider_text) || !empty($sec_slider_slogan)) : ?>
  <div class="<?php echo esc_attr($sec_slider_type); ?>__descr">
    <?php if (!empty($sec_slider_slogan)) : ?>
    <p class="<?php echo esc_attr($sec_slider_type); ?>__slogan"><?php echo wp_kses_post($sec_slider_slogan); ?></p>
    <?php endif; ?>
    <?php if (!empty($sec_slider_descr)) : ?>
    <p class="<?php echo esc_attr($sec_slider_type); ?>__text"><?php echo wp_kses_post($sec_slider_descr); ?></p>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</div>
<div class="<?php echo esc_attr($sec_slider_type); ?>__list">
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

  <?php if($sec_slider_list && !empty($slider_data)) : ?>
  <div class="<?php echo esc_attr($sec_slider_type); ?>__slider">
    <div class="swiper materials-slider">
      <div class="swiper-wrapper">
      <?php foreach ($slider_data as $item) : ?>
        <div class="swiper-slide">
          <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>
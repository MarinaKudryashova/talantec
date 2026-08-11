<?php
/*
* Section: Сотрудники (слайдер)
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

?>

<section class="sec-employees sec-offset" id="sec-employees-<?php echo $layout_ids; ?>">
  <div class="sec-employees__container container">
    <div class="sec-employees__heading">
      <div class="sec-employees__inner">
        <?php if (!empty($sec_slider_title)) : ?>
        <h2 class="sec-employees__title sec-title"><?php esc_html_e($sec_slider_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($sec_slider_subtitle)) : ?>
        <p class="sec-employees__subtitle">
          <?php echo wp_kses_post($sec_slider_subtitle); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="sec-employees__nav slider-nav">
        <button class="sec-employees__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="sec-employees__btn-next slider-nav__btn slider-nav__btn--next">
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
    <?php if($sec_slider_list && !empty($slider_data)) : ?>
    <div class="swiper sec-employees__slider">
      <div class="swiper-wrapper">
        <?php foreach ($slider_data as $item) : ?>
          <div class="swiper-slide">
            <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
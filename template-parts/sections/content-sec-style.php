 <?php
$page_id = $args['id'] ?? 0;
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';


$field_type = $layout_name . '_type';
$field_list = $layout_name . '_list';

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

<!-- Слайдер -->
<?php if($sec_slider_list && !empty($slider_data)) : ?>
  <div class="style-slider">
    <div class="swiper style-slider__large">
      <div class="swiper-wrapper">
        <?php foreach($slider_data as $item) : ?>
        <div class="swiper-slide">
          <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="swiper style-slider__thumbs">
      <div class="swiper-wrapper">
        <?php foreach($slider_data as $item) : ?>
        <div class="swiper-slide">
          <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
        </div>
        <?php endforeach; ?>
      </div>

    </div>

  </div>

  <!-- Мобильный слайдер -->
  <div class="style-slider-mobile">
    <div class="swiper style-slider-mobile__slider slider">
      <div class="swiper-wrapper">
        <?php foreach($slider_data as $item) : ?>
        <div class="swiper-slide">
          <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
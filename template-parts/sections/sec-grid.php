 <?php
/*
* Section: Сетка
*/
$page_id = $args["id"];
$layout_data = $args["layout-data"];
$layout_name = $args["layout-name"];
$layout_ids = $args['layout-ids'] ?? '';

$field_title = $layout_name . '_title';
$field_subtitle = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_grid_title = $layout_data[$field_title];
$sec_grid_subtitle = $layout_data[$field_subtitle];
$sec_grid_list = $layout_data[$field_list];

if($sec_grid_list) {
  $template_dir = get_template_directory_uri();

  // Собираем все данные в массив
  $grid_data = array();
  
  foreach ($sec_grid_list as $key => $slide) {

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
    
    $grid_data[] = array(
      'name' => $item_name,
      'link' => (!empty($item_link) && $item_link !== '#') ? $item_link : '#',
      'img_versions' => $item_img_versions
    );
    
  }
  
}
?>
<section class="sec-grid sec-offset">
  <div class="sec-grid__container container">
    <div class="sec-grid__heading">
      <?php if (!empty($sec_grid_title)) : ?>
      <h2 class="sec-title"><?php esc_html_e($sec_grid_title); ?></h2>
      <?php endif; ?>
      <?php if (!empty($sec_grid_subtitle)) : ?>
      <p class="sec-grid__subtitle"><?php echo wp_kses_post($sec_grid_subtitle); ?></p>
      <?php endif; ?>
    </div>
    <?php if($sec_grid_list && !empty($grid_data)) : ?>
    <ul class="sec-grid__list">
      <?php foreach ($grid_data as $item) : ?>
      <li class="sec-grid__item">
        <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>

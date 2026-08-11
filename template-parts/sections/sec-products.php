<?php
/*
* Section: Продукция 
*/

  $page_id = $args["id"];
  $layout_data = $args["layout-data"];
  $layout_name = $args["layout-name"];

  $field_list = $layout_name . '_list';
  $sec_products_list = $layout_data[$field_list];
?>


<?php 
if($sec_products_list && is_array($sec_products_list)) : 
  $template_dir = get_template_directory_uri();
  
  // Собираем все данные в массив
  $products_data = array();
  $counter = 1;

  foreach ($sec_products_list as $key => $item) {
    $item_name = $item["title"];
    $item_link = $item["link"];
    $item_img = $item["img"];
    
    $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
        ? get_image_versions($item_img)
        : array(
            'webp_1x' => $template_dir . '/img/site-preview.webp',
            'original_1x' => $template_dir . '/img/site-preview.jpg',
            'full' => $template_dir . '/img/site-preview.jpg'
        );
    
    $products_data[] = array(
      'index' => $counter,
      'name' => $item_name,
      'link' => (!empty($item_link) && $item_link !== '#') ? $item_link : '#',
      'img_versions' => $item_img_versions
    );
    
    $counter++;
  }
  
  if(!empty($products_data)) :
?>
<div class="products">
  <ul class="products-bgs">
    <?php foreach($products_data as $product) : ?>
    <li class="products-bgs__item <?php echo $product['index'] === 1 ? 'is-active' : ''; ?>" data-bg-index="<?php echo $product['index']; ?>">
      <picture class="products-bgs__img">
        <source srcset="<?php echo esc_url($product['img_versions']['webp_1x']); ?>" type="image/webp">
        <img loading="lazy" src="<?php echo esc_url($product['img_versions']['original_1x']); ?>" width="1440" height="800" aria-hidden="true" alt="">
      </picture>
    </li>
    <?php endforeach; ?>
  </ul>
  
  <ul class="products__list">
    <?php foreach($products_data as $product) : ?>
    <li class="products__item">
      <a href="<?php echo esc_url($product['link']); ?>" class="products-link" data-bg-target="<?php echo $product['index']; ?>">
        <picture class="products-link__img">
          <source srcset="<?php echo esc_url($product['img_versions']['webp_1x']); ?>" type="image/webp">
          <img loading="lazy" src="<?php echo esc_url($product['img_versions']['original_1x']); ?>" width="1440" height="800" aria-hidden="true" alt="">
        </picture>
        <span class="products-link__number"></span>
        <?php if (!empty($product['name'])) : ?>
        <span class="products-link__name"><?php echo esc_html($product['name']); ?></span>
        <?php endif; ?>
        <span class="products-link__arrow">
          <span class="ui-arrow">
            <svg class="ui-arrow__svg">
              <use xlink:href="<?php echo $template_dir; ?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy">
              <use xlink:href="<?php echo $template_dir; ?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
          </span>
        </span>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php 
    endif;
endif;
?>
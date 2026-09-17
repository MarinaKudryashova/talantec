<?php
/*
* Section: Виды услуг
*/

$page_id = $args['id'] ?? 0;
$layout_data = is_array($args['layout-data'] ?? null) ? $args['layout-data'] : array();
$layout_name = $args['layout-name'] ?? '';

$field_list = $layout_name . '_list';

$sec_type_services_list  = $layout_data[ $field_list ] ?? array();
$sec_type_services_count = is_array( $sec_type_services_list ) ? count( $sec_type_services_list ) : 0;
?>

<?php if ( is_array( $sec_type_services_list ) && $sec_type_services_list ) : ?>
<ul class="type-services">
  <?php foreach ($sec_type_services_list as $item) :
    $item_name = $item['title'];
    $item_text = $item['text'];
    $item_img = $item['img'];
    $item_link = (!empty($item['link']) && $item['link'] !== '#') ? $item['link'] : '#';
    $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
        ? get_image_versions($item_img)
        : array(
            'webp_1x' => get_template_directory_uri() . '/img/site-preview.webp',
            'original_1x' => get_template_directory_uri() . '/img/site-preview.jpg',
            'full' => get_template_directory_uri() . '/img/site-preview.jpg'
        );
  ?>
  <li class="type-services__item" style="width: calc(100% / <?php echo $sec_type_services_count; ?>);">
    <a href="<?php echo esc_url($item_link); ?>" class="type-services-card">
      <div class="type-services-card__content">
        <?php if (!empty($item_name)) : ?>
        <h3 class="type-services-card__title"><?php esc_html_e($item_name); ?></h3>
        <?php endif; ?>

        <?php if (!empty($item_text)) : ?>
        <p class="type-services-card__descr"><?php esc_html_e($item_text); ?></p>
        <?php endif; ?>

        <span class="type-services-card__link type-services-card-link">
          <span class="type-services-card-link__text">Узнать больше</span>
          <span class="type-services-card-link__icons ui-arrow">
            <svg class="ui-arrow__svg">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
          </span>
        </span>
      </div>
      <div class="type-services-card__img">
        <picture class="type-services-card__pic">
          <?php architect_picture_mobile_sources($item_img_versions); ?>
          <?php if (!empty($item_img_versions['webp_1x'])) : ?>
          <source srcset="<?php echo esc_url($item_img_versions['webp_1x']); ?>" type="image/webp">
          <?php endif; ?>
          <img loading="lazy" src="<?php echo esc_url($item_img_versions['original_1x']); ?>" width="480" height="300" aria-hidden="true" alt="" decoding="async">
        </picture>
      </div>
    </a>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>

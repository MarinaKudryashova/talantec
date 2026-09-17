 <?php
/*
* Section: Галерея работ
*/

$page_id = $args['id'] ?? 0;
$layout_data = is_array($args['layout-data'] ?? null) ? $args['layout-data'] : array();
$layout_name = $args['layout-name'] ?? '';
$layout_ids = $args['layout-ids'] ?? '';

$field_title = $layout_name . '_title';
$field_subtitle = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_galleryworks_title = $layout_data[$field_title] ?? '';
$sec_galleryworks_subtitle = $layout_data[$field_subtitle] ?? '';
$sec_galleryworks_list = $layout_data[$field_list] ?? array();

?>

<section class="sec-galleryworks  sec-offset" id="<?php echo $layout_name . '-'. $layout_ids; ?>">
  <div class="sec-galleryworks__container container">
    <div class="sec-galleryworks__heading">
      <?php if (!empty($sec_galleryworks_title)) : ?> 
      <h2 class="sec-title"><?php esc_html_e($sec_galleryworks_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_galleryworks_subtitle)) : ?> 
      <p class="sec-galleryworks__subtitle"><?php esc_html_e($sec_galleryworks_subtitle); ?></p>
      <?php endif; ?>
    </div>

    <?php if (!empty($sec_galleryworks_list) && is_array($sec_galleryworks_list)) : ?> 
    <ul class="sec-galleryworks__list" id="galleryworksList">
      
      <?php 
        foreach ($sec_galleryworks_list as $img) : 
        
        $img_id = is_array($img) ? ($img['ID'] ?? 0) : 0;
        $img_versions = (!empty($img_id) && function_exists('get_image_versions')) 
          ? get_image_versions($img_id)
          : array(
              'webp_1x' => get_template_directory_uri() . '/img/site-preview.webp',
              'original_1x' => get_template_directory_uri() . '/img/site-preview.jpg',
              'full' => get_template_directory_uri() . '/img/site-preview.jpg'
        );
        ?>
        <li class="sec-galleryworks__item">
          <a data-fslightbox="galleryworks" data-caption="" href="<?php echo esc_url($img['url'] ?? ''); ?>"
            class="sec-galleryworks__link gallery-zoom">
            <picture class="sec-galleryworks__img">
              <?php architect_picture_mobile_sources($img_versions); ?>
              <?php if (!empty($img_versions['webp_1x'])) : ?>
              <source srcset="<?php echo esc_url($img_versions['webp_1x']); ?>" type="image/webp">
              <?php endif; ?>
              <img loading="lazy" src="<?php echo esc_url($img_versions['original_1x']); ?>" width="512" height="216" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>"
                decoding="async">
            </picture>
            <?php echo architect_gallery_zoom_icon(); ?>
          </a>
        </li>
      <?php endforeach; ?>

    </ul>
    <?php endif; ?>
    <button class="sec-galleryworks__more-btn btn" data-is-loading="false" type="button"><?php _e('Показать больше', 'veterinary'); ?></button>
  </div>
</section>

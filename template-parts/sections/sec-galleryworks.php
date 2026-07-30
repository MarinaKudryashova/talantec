 <?php
/*
* Section: Галерея работ
*/

$page_id = $args['id'] ?? 0;
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';
$layout_ids = $args['layout-ids'] ?? '';

$field_title = $layout_name . '_title';
$field_subtitle = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_galleryworks_title = $layout_data[$field_title];
$sec_galleryworks_subtitle = $layout_data[$field_subtitle];
$sec_galleryworks_list = $layout_data[$field_list];

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
        
        $img_id = $img["ID"];
        $img_versions = (!empty($img_id) && function_exists('get_image_versions')) 
          ? get_image_versions($img_id)
          : array(
              'webp_1x' => $template_dir . '/img/site-preview.webp',
              'original_1x' => $template_dir . '/img/site-preview.jpg',
              'full' => $template_dir . '/img/site-preview.jpg'
        );
        ?>
        <li class="sec-galleryworks__item">
          <a data-fslightbox="galleryworks" data-caption="" href="<?php echo $img['url'] ?>"
            class="sec-galleryworks__link">
            <picture class="sec-galleryworks__img">
              <source srcset="<?php echo esc_url($img_versions['webp_1x']); ?>" type="image/webp">
              <img loading="lazy" src="<?php echo esc_url($img_versions['original_1x']); ?>" width="512" height="216" alt="<?php echo $img['alt'] ?>"
                decoding="async">
            </picture>
          </a>
        </li>
      <?php endforeach; ?>

    </ul>
    <?php endif; ?>
    <button class="sec-galleryworks__more-btn btn" data-is-loading="false" type="button"><?php _e('Показать больше', 'veterinary'); ?></button>
  </div>
</section>

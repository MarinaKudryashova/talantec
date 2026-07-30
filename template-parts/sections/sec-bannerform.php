 <?php
/*
* Section: Баннер-форма 
*/

$page_id = $args["id"];
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';
$layout_ids = $args['layout-ids'] ?? '';

$sec_bannerform_title = get_field('sec-bannerform_title', 'options');
$sec_bannerform_descr = get_field('sec-bannerform_descr', 'options');
$sec_bannerform_img = get_field('sec-bannerform_img', 'options');
$sec_bannerform_img_versions = (!empty($sec_bannerform_img) && function_exists('get_image_versions')) 
  ? get_image_versions($sec_bannerform_img)
  : array(
      'webp_1x' => $template_dir . '/img/site-preview.webp',
      'original_1x' => $template_dir . '/img/site-preview.jpg',
      'full' => $template_dir . '/img/site-preview.jpg'
);
$sec_bannerform_img_mobile = get_field('sec-bannerform_img_mobile', 'options');
$sec_bannerform_img__mobile_versions = (!empty($sec_bannerform_img_mobile) && function_exists('get_image_versions')) 
  ? get_image_versions($sec_bannerform_img_mobile)
  : array(
      'webp_1x' => $template_dir . '/img/site-preview.webp',
      'original_1x' => $template_dir . '/img/site-preview.jpg',
      'full' => $template_dir . '/img/site-preview.jpg'
);
$sec_bannerform_shortcode = get_field('sec-bannerform_shortcode', 'options');
  
?>

<section class="bannerform" id="bannerform-<?php echo $layout_ids; ?>">
  <div class="bannerform__bg">
    <picture class="bannerform__picture">
      <?php if (!empty($sec_bannerform_img__mobile_versions['webp_1x'])) : ?>
      <source media="(max-width: 576px)" srcset="<?php echo esc_url($sec_bannerform_img__mobile_versions['webp_1x']); ?>" type="image/jpg">
      <?php endif; ?>
      <?php if (!empty($sec_bannerform_img_mobile['original_1x'])) : ?>
      <source media="(max-width: 576px)" srcset="<?php echo esc_url($sec_bannerform_img_mobile['original_1x']); ?>" type="image/jpg">
      <?php endif; ?>

      <?php if (!empty($sec_bannerform_img_versions['webp_1x'])) : ?>
      <source srcset="<?php echo esc_url($sec_bannerform_img_versions['webp_1x']); ?>" type="image/webp">
      <?php endif; ?>
      <img class="bannerform__img" src="<?php echo esc_url($sec_bannerform_img_versions['original_1x']); ?>" width="1443" height="534" alt="Фото" aria-hidden="true" loading="lazy">
    </picture>
  </div>
  <div class="bannerform__container container">
    

    <div class="bannerform__content">
      <div class="bannerform__left">
        <?php if (!empty($sec_bannerform_title)) : ?>
        <h2 class="bannerform__title"><?php echo esc_html($sec_bannerform_title); ?></h2>
        <?php endif; ?>
        <?php if (!empty($sec_bannerform_descr)) : ?>
        <p class="bannerform__descr"><?php echo esc_html($sec_bannerform_descr); ?></p>
        <?php endif; ?>
      </div>
      
      <?php if (!empty($sec_bannerform_shortcode)) : ?>
      <div class="bannerform__form form">
        <?php echo do_shortcode( $sec_bannerform_shortcode ); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

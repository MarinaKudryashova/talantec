<?php
/*
* Section: Текст с изображениями
*/

$page_id = $args["id"];
$layout_data = $args["layout-data"];
$layout_name = $args["layout-name"];

$field_position = $layout_name . '_position';
$field_title = $layout_name . '_title';
$field_subtitler = $layout_name . '_subtitle';
$field_text = $layout_name . '_text';
$field_imgs = $layout_name . '_imgs';

$sec_media_position = $layout_data[$field_position];
$sec_media_title = $layout_data[$field_title];
$sec_media_subtitler = $layout_data[$field_subtitler];
$sec_media_text = $layout_data[$field_text];
$sec_media_imgs = $layout_data[$field_imgs];

$images_count = is_array($sec_media_imgs) ? count($sec_media_imgs) : 0;
$grid_class = 'sec-media__images';

if ($images_count === 1) {
    $grid_class .= ' sec-media__images--single';
} elseif ($images_count === 2) {
    $grid_class .= ' sec-media__images--double';
} elseif ($images_count === 3) {
    $grid_class .= '';
}
?>

<section class="sec-media sec-offset">
  <div class="sec-media__container container <?php if($sec_media_position !== 'default') : ?>sec-media__container--reverse<?php endif; ?>">
    <div class="sec-media__heading">
      <?php if (!empty($sec_media_title)) : ?>
        <h2 class="sec-media__title sec-title"><?php esc_html_e($sec_media_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_media_subtitler)) : ?>
        <p class="sec-media__subtitle"><?php echo wp_kses_post($sec_media_subtitler); ?></p>
      <?php endif; ?>

      <?php if (!empty($sec_media_text)) : ?>
      <p class="sec-media__text"><?php echo wp_kses_post($sec_media_text); ?></p>
      <?php endif; ?>
    </div>

    <?php if (!empty($sec_media_imgs) && is_array($sec_media_imgs)) : ?>
    <ul class="<?php echo esc_attr($grid_class); ?>">

      <?php foreach ($sec_media_imgs as $index => $img_url) : 
        $img = get_image_versions($img_url);

        if ($images_count === 1) {
          $width = 640;
          $height = 400;
        } elseif ($images_count === 2) {
          $width = 317;
          $height = 400;
        } else { // 3 изображения
          $width = 318;
          $height = ($index === 1) ? 400 : 198; // Второй элемент выше
        }
      ?>
      <li class="sec-media__item">
        <picture class="sec-media__img">
          <?php if (!empty($img['webp_1x'])) : ?>
          <source srcset="<?php echo esc_url($img['webp_1x']); ?>" type="image/webp">
          <?php endif; ?>
          <img loading="lazy" src="<?php echo esc_url($img['original_1x']); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" alt="" aria-hidden="true"
            decoding="async">
        </picture>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>
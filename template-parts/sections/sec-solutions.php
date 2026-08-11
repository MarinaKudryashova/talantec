<?php
/*
* Section: Решения 
*/

$page_id = $args["id"];
$layout_data = $args["layout-data"];
$layout_name = $args["layout-name"];

$field_list = $layout_name . '_list';

$sec_solutions_list = $layout_data[$field_list];
$sec_solutions_count = count($sec_solutions_list);
?>

<?php if($sec_solutions_list) : ?>
<ul class="solutions">
  <?php foreach ($sec_solutions_list as $item) :
    $item_name = $item['title'];
    $item_text = $item['text'];
    $item_img = $item['img'];
    $item_link = (!empty($item['link']) && $item['link'] !== '#') ? $item['link'] : '#';
    $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
        ? get_image_versions($item_img)
        : array(
            'webp_1x' => $template_dir . '/img/site-preview.webp',
            'original_1x' => $template_dir . '/img/site-preview.jpg',
            'full' => $template_dir . '/img/site-preview.jpg'
        );
  ?>
  <li class="solutions__item" style="width: calc(100% / <?php echo $sec_solutions_count; ?>);">
    <a href="<?php echo esc_url($item_link); ?>" class="solutions-card">
      <div class="solutions-card__content">
        <?php if (!empty($item_name)) : ?>
        <h3 class="solutions-card__title"><?php esc_html_e($item_name); ?></h3>
        <?php endif; ?>

        <?php if (!empty($item_text)) : ?>
        <p class="solutions-card__descr"><?php esc_html_e($item_text); ?></p>
        <?php endif; ?>

        <span class="solutions-card__link solutions-card-link">
          <span class="solutions-card-link__text">Узнать больше</span>
          <span class="solutions-card-link__icons ui-arrow">
            <svg class="ui-arrow__svg">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
          </span>
        </span>
      </div>
      <div class="solutions-card__img">
        <picture class="solutions-card__pic">
          <source srcset="<?php echo esc_url($item_img_versions['webp_1x']); ?>" type="image/webp">
          <img loading="lazy" src="<?php echo esc_url($item_img_versions['original_1x']); ?>" width="480" height="300" aria-hidden="true" alt="">
        </picture>
      </div>
    </a>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
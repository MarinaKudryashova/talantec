<?php
/**
 * Шаблон "Карточка"
*/
$page_id = $args['id'] ?? 0;
$item = $args['item-data'] ?? [];

?>
<a href="<?php echo esc_url($item['link']); ?>" class="ui-card">
  <picture class="ui-card__img">
    <?php if (!empty($item['img_versions']['webp_1x'])) : ?>
    <source srcset="<?php echo esc_url($item['img_versions']['webp_1x']); ?>" type="image/webp">
    <?php endif; ?>
    <img loading="lazy" src="<?php echo esc_url($item['img_versions']['original_1x']); ?>" width="640" height="425"
      aria-hidden="true" alt="">
  </picture>
  <div class="ui-card__link">
    <?php if (!empty($item['name'])) : ?>
    <span class="ui-card__name"><?php echo esc_html($item['name']); ?></span>
    <?php endif; ?>
    <span class="ui-card__arrow">
      <span class="ui-arrow">
        <svg class="ui-arrow__svg">
          <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
        </svg>
        <svg class="ui-arrow__svg ui-arrow__svg--copy">
          <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
        </svg>
      </span>
    </span>
  </div>
</a>
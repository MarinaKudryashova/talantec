<?php
/**
 * Шаблон "Карточка новости/статьи"
*/

$page_id = $args['id'] ?? 0;
$item = $args['item-data'] ?? [];
?>

<div class="news-card">
  <a href="<?php echo esc_url($item['link']); ?>" class="news-card__link"></a>
  <div class="news-card__info">
    <?php if (!empty($item['category'])) : ?>
    <span class="news-card__category"><?php echo esc_html($item['category']); ?></span>
    <?php endif; ?>
    <?php if (!empty($item['name'])) : ?>
      <p class="news-card__text is-clamp" style="--lines: 2;"><?php echo esc_html($item['name']); ?></p>
    <?php endif; ?>
    <div class="news-card__contact">
      <!-- <span class="news-card__name">Читать</span> -->
      <span class="news-card__name">Читать&#160;далее</span>
      <span class="news-card__arrow">
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
  </div>
  <div class="news-card__view">
    <picture class="news-card__picture">
      <?php if (!empty($item['img_versions']['webp_1x'])) : ?>
      <source srcset="<?php echo esc_url($item['img_versions']['webp_1x']); ?>" type="image/webp">
      <?php endif; ?>
      <img src="<?php echo esc_url($item['img_versions']['original_1x']); ?>" alt="Иллюстрация к новости" loading="lazy" width="416"
        height="300">
    </picture>
  </div>
</div>
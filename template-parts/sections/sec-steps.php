<?php
/*
* Section: Этапы
*/

$page_id = $args['id'] ?? 0;
$layout_data = is_array($args['layout-data'] ?? null) ? $args['layout-data'] : array();
$layout_name = $args['layout-name'] ?? '';

$field_title = $layout_name . '_title';
$field_subtitler = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_steps_title = $layout_data[$field_title] ?? '';
$sec_steps_subtitler = $layout_data[$field_subtitler] ?? '';
$sec_steps_list = $layout_data[$field_list] ?? array();
?>

<section class="sec-steps sec-bg sec-offset">
  <div class="sec-steps__container container">
    <div class="sec-steps__heading">
      <?php if (!empty($sec_steps_title)) : ?>
      <h2 class="sec-title"><?php esc_html_e($sec_steps_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_steps_subtitler)) : ?>
      <p class="sec-steps__subtitle"><?php esc_html_e($sec_steps_subtitler); ?></p>
      <?php endif; ?>
    </div>

    <?php if ( is_array( $sec_steps_list ) && $sec_steps_list ) : ?>
    <ul class="sec-steps__list">
      <?php foreach ($sec_steps_list as $item) :
        $item_name = $item['title'];
        $item_text = $item['text'];
        $item_link = $item['link'];

        $has_link = !empty($item_link) && $item_link !== '#';
        $item_link_href = $has_link ? esc_url($item_link) : '';
      ?>
      <li class="sec-steps__item">

        <?php if ($has_link) : ?>
          <a href="<?php echo $item_link_href; ?>" class="step-card">
        <?php else : ?>
          <span class="step-card">
        <?php endif; ?>

          <div class="step-card__number"></div>
          <?php if (!empty($item_name)) : ?>
          <h2 class="step-card__title"><?php esc_html_e($item_name); ?></h2>
          <?php endif; ?>

          <?php if (!empty($item_text)) : ?>
          <p class="step-card__text"><?php esc_html_e($item_text); ?></p>
          <?php endif; ?>

          <?php if ($has_link) : ?>
             <!-- Стрелка (есть ссылка) -->
            <span class="step-card__link">
              <span class="step-card__icons">
                <svg class="step-card__svg">
                  <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
                </svg>
                <svg class="step-card__svg step-card__svg--copy">
                  <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
                </svg>
              </span>
            </span>
            <?php else : ?>
              <!-- Галочка (нет ссылки)-->
              <span class="step-card__check">
                <span class="step-card__check-icon">
                  <svg class="step-card__check-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                  </svg>
                </span>
              </span>
          <?php endif; ?>

         <?php if ($has_link) : ?>
          </a>
        <?php else : ?>
          </span>
        <?php endif; ?>

      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>

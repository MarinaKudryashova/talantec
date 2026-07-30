<?php
/*
* Section: Услуги 
*/

$page_id = $args["id"];
$layout_data = $args["layout-data"];
$layout_name = $args["layout-name"];

$field_title = $layout_name . '_title';
$field_subtitler = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_services_title = $layout_data[$field_title];
$sec_services_subtitler = $layout_data[$field_subtitler];
$sec_services_list = $layout_data[$field_list];
?>

<section class="sec-services sec-offset">
  <div class="sec-services__container container">
    <div class="sec-services__heading">
      <?php if (!empty($sec_services_title)) : ?>
      <h2 class="sec-title"><?php esc_html_e($sec_services_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_services_subtitler)) : ?>
      <p class="sec-services__subtitle"><?php esc_html_e($sec_services_subtitler); ?></p>
      <?php endif; ?>
    </div>

    <?php if($sec_services_list) : ?>
    <ul class="sec-services__list">
      <?php foreach ($sec_services_list as $item) :
        $item_name = $item['title'];
        $item_text = $item['text'];
        $item_link = $item['link'];

        $has_link = !empty($item_link) && $item_link !== '#';
        $item_link_href = $has_link ? esc_url($item_link) : '';
      ?>
      <li class="sec-services__item">

        <?php if ($has_link) : ?>
          <a href="<?php echo $item_link_href; ?>" class="service-card">
        <?php else : ?>
          <span class="service-card">
        <?php endif; ?>

          <div class="service-card__number"></div>
          <?php if (!empty($item_name)) : ?>
          <h2 class="service-card__title"><?php esc_html_e($item_name); ?></h2>
          <?php endif; ?>

          <?php if (!empty($item_text)) : ?>
          <p class="service-card__text"><?php esc_html_e($item_text); ?></p>
          <?php endif; ?>

          <?php if ($has_link) : ?>
             <!-- Стрелка (есть ссылка) -->
            <span class="service-card__link">
              <span class="service-card__icons">
                <svg class="service-card__svg">
                  <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
                </svg>
                <svg class="service-card__svg service-card__svg--copy">
                  <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
                </svg>
              </span>
            </span>
            <?php else : ?>
              <!-- Галочка (нет ссылки)-->
              <span class="service-card__check">
                <span class="service-card__check-icon">
                  <svg class="service-card__check-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
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
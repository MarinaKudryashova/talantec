 <?php
/*
* Section: Парнеры слайдер
*/

$page_id = $args['id'] ?? 0;
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';
$layout_ids = $args['layout-ids'] ?? '';

$field_title = $layout_name . '_title';
$field_slogan = $layout_name . '_slogan';
$field_text = $layout_name . '_text';

$sec_partners_title = $layout_data[$field_title];
$sec_partners_slogan = $layout_data[$field_slogan];
$sec_partners_text = $layout_data[$field_text];
$sec_partners_list = get_field('sec-partners_list', 'option');
?>

<section class="sec-partners sec-offset" id="<?php echo $layout_name . '-'. $layout_ids; ?>">
  <div class="sec-partners__container container">
    <div class="sec-partners__heading">
      <?php if (!empty($sec_partners_title)) : ?>
      <h2 class="sec-partners__title sec-title"><?php esc_html_e($sec_partners_title); ?></h2>
      <?php endif; ?>
      <div class="sec-partners__descr">
        <?php if (!empty($sec_partners_slogan)) : ?>
        <p class="sec-partners__slogan"><?php esc_html_e($sec_partners_slogan); ?></p>
        <?php endif; ?>

        <?php if (!empty($sec_partners_text)) : ?>
        <p class="sec-partners__text"><?php esc_html_e($sec_partners_text); ?></p>
        <?php endif; ?>
      </div>
    </div>
     <?php if($sec_partners_list) : ?>
    <div class="swiper sec-partners__slider">
      <div class="swiper-wrapper">
        <?php while(has_sub_field('sec-partners_list', 'option')) : 
          $item_name = get_sub_field('name', 'option');
          $item_logo = get_sub_field('logo', 'option');
          $item_link = get_sub_field('link', 'option');
          $item_link_href = (!empty($item_link) && $item_link !== '#') ? $item_link : '#';
        ?>
        <div class="swiper-slide">
          <a href="<?php echo esc_url($item_link_href); ?>" class="partners-card">
            <div class="partners-card__view">
              <img src="<?php echo esc_url($item_logo); ?>" class="partners-card__logo" width="220" height="31"
                alt="Логотип <?php esc_html_e($item_name); ?>">
            </div>
            <span class="partners-card__link">
              <span class="partners-card__name"><?php esc_html_e($item_name); ?></span>
              <span class="partners-card__arrow">
                <span class="partners-card__icons ui-arrow">
                  <svg class="ui-arrow__svg">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                  </svg>
                  <svg class="ui-arrow__svg ui-arrow__svg--copy">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                  </svg>
                </span>
              </span>
            </span>
          </a>
        </div>
        <?php endwhile; ?>

      </div>
    </div>
    <?php endif; ?>

  </div>
</section>
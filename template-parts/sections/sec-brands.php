 <?php
/*
* Section: Бренды
*/

$sec_brands_title = get_field('sec-brands_title', 'option');
$sec_brands_slogan = get_field('sec-brands_slogan', 'option');
$sec_brands_text = get_field('sec-brands_text', 'option');
$sec_brands_list = get_field('sec-brands_list', 'option');
?>

<section class="sec-brands">
  <div class="sec-brands__container container">
    <div class="sec-brands__heading">
      <?php if (!empty($sec_brands_title)) : ?>
      <h2 class="sec-brands__title sec-title"><?php esc_html_e($sec_brands_title); ?></h2>
      <?php endif; ?>
      <div class="sec-brands__descr">
        <?php if (!empty($sec_brands_slogan)) : ?>
        <p class="sec-brands__slogan"><?php esc_html_e($sec_brands_slogan); ?></p>
        <?php endif; ?>

        <?php if (!empty($sec_brands_text)) : ?>
        <p class="sec-brands__text"><?php esc_html_e($sec_brands_text); ?></p>
        <?php endif; ?>
      </div>
    </div>
     <?php if($sec_brands_list) : ?>
    <div class="swiper sec-brands__slider">
      <div class="swiper-wrapper">
        <?php while(has_sub_field('sec-brands_list', 'option')) : 
          $item_name = get_sub_field('name', 'option');
          $item_logo = get_sub_field('logo', 'option');
          $item_link = get_sub_field('link', 'option');
          $item_link_href = (!empty($item_link) && $item_link !== '#') ? $item_link : '#';
        ?>
        <div class="swiper-slide">
          <a href="<?php echo esc_url($item_link_href); ?>" class="brands-card">
            <div class="brands-card__view">
              <img src="<?php echo esc_url($item_logo); ?>" class="brands-card__logo" width="220" height="31"
                alt="Логотип <?php esc_html_e($item_name); ?>">
            </div>
            <span class="brands-card__link">
              <span class="brands-card__name"><?php esc_html_e($item_name); ?></span>
              <span class="brands-card__arrow">
                <span class="brands-card__icons ui-arrow">
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
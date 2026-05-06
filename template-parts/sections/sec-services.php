<?php
/*
* Section: Услуги 
*/

$sec_services_title = get_field('sec-services_title');
$sec_services_subtitler = get_field('sec-services_subtitle');
$sec_services_list = get_field('sec-services_list');
?>

<section class="sec-services">
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
      <?php while(has_sub_field('sec-services_list')) : 
        $item_name = get_sub_field('title');
        $item_text = get_sub_field('text');
        $item_link = get_sub_field('link');
        $item_link_href = (!empty($item_link) && $item_link !== '#') ? $item_link : '#';
      ?>
      <li class="sec-services__item">
        <a href="<?php echo esc_url($item_link_href); ?>" class="service-card">
          <div class="service-card__number"></div>
          <?php if (!empty($item_name)) : ?>
          <h2 class="service-card__title"><?php esc_html_e($item_name); ?></h2>
          <?php endif; ?>

          <?php if (!empty($item_text)) : ?>
          <p class="service-card__text"><?php esc_html_e($item_text); ?></p>
          <?php endif; ?>
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
        </a>
      </li>
      <?php endwhile; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>
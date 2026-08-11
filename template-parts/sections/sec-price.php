 <?php
/*
* Section: Цены
*/
$page_id = $args["id"];
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';
$layout_ids = $args['layout-ids'] ?? '';

$field_title = $layout_name . '_title';
$field_subtitler = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_price_title = $layout_data[$field_title];
$sec_price_subtitler = $layout_data[$field_subtitler];
$sec_price_list = $layout_data[$field_list];

?>
<section class="sec-price sec-offset" id="sec-price">
  <div class="sec-price__container container">
    <div class="sec-price__heading">
      <?php if (!empty($sec_price_title)) : ?>
      <h2 class="sec-title" data-aos="fade-up"><?php esc_html_e($sec_price_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_price_subtitler)) : ?>
      <p class="sec-price__subtitle" data-aos="fade-up"><?php esc_html_e($sec_price_subtitler); ?></p>
      <?php endif; ?>
    </div>
    <?php if($sec_price_list && is_array($sec_price_list)) : ?>
      <ul class="sec-price__list">
         <?php foreach($sec_price_list as $item) : 
          $item_name = $item["name"];
          $item_descr = $item["descr"];
          $item_price = $item["price"];
          $item_features = $item["features"];
          $item_popular = $item["is_popular"];
          ?>
        <li class="sec-price__item">
          <div class="tariff-card <?php if ($item_popular) : ?>is-popular<?php endif; ?>">
            <?php if (!empty($item_name)) : ?>
            <h3 class="tariff-card__title"><?php esc_html_e($item_name); ?></h3>
            <?php endif; ?>
            <div class="tariff-card__descr">
              <?php if (!empty($item_descr)) : ?>
              <p class="tariff-card__text"><?php esc_html_e($item_descr); ?></p>
              <?php endif; ?>
              <?php if (!empty($item_price) && is_array($item_price)) : ?>
              <div class="tariff-card__price">
                  <span class="tariff-card__amount"><?php echo esc_html($item_price['amount']); ?></span>
                  <span class="tariff-card__period"><?php echo esc_html($item_price['period']); ?></span>
              </div>
              <?php endif; ?>
              <?php if (!empty($item_features) && is_array($item_features)) : ?>
              <ul class="tariff-card__list">
                 <?php foreach($item_features as $feature) : ?>
                <li class="tariff-card__item">
                  <svg class="tariff-card__marker" aria-hidden>
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                  </svg>
                  <span class="tariff-card__span"><?php echo esc_html($feature['item']); ?></span>
                </li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <button type="button" class="tariff-card__btn ui-btn-arrow">
              <span class="ui-btn-arrow__text">Заказать</span>
              <span class="ui-btn-arrow__arrow">
                <span class="ui-arrow">
                  <svg class="ui-arrow__svg">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                  </svg>
                  <svg class="ui-arrow__svg ui-arrow__svg--copy">
                    <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                  </svg>
                </span>
              </span>
            </button>
         </div>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php else : ?>
      <p><?php esc_html_e( 'В этом разделе пока нет информации.', 'architect' ); ?></p>
    <?php endif; ?>


  </div>
</section>

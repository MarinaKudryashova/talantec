
<?php
/*
* Section: Новости и блог
*/

$page_id = $args["id"];
$layout_data = $args["layout-data"];
$layout_name = $args["layout-name"];
$layout_ids = $args['layout-ids'] ?? '';


$field_title = $layout_name . '_title';
$field_subtitle = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_news_title = $layout_data[$field_title];
$sec_news_subtitle = $layout_data[$field_subtitle];
$sec_news_list = $layout_data[$field_list];

if($sec_news_list) {
  $template_dir = get_template_directory_uri();

  // Собираем все данные в массив
  $news_data = array();
  
  foreach ($sec_news_list as $key => $item) {

    $item_id = $item;
    $item_name = get_the_title($item_id);
    $item_link = get_the_permalink($item_id);
    $item_cat = get_the_category($item_id)[0]->name;
    $item_img = get_the_post_thumbnail_url($item_id);
    
    $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
        ? get_image_versions($item_img)
        : array(
            'webp_1x' => $template_dir . '/img/site-preview.webp',
            'original_1x' => $template_dir . '/img/site-preview.jpg',
            'full' => $template_dir . '/img/site-preview.jpg'
        );
    
    $news_data[] = array(
      'name' => $item_name,
      'link' => (!empty($item_link) && $item_link !== '#') ? $item_link : '#',
      'category' => $item_cat,
      'img_versions' => $item_img_versions
    );
    
  }
}

// var_dump($news_data);
?>
<section class="sec-news sec-offset" id="news-blog">
  <div class="sec-news__container container">
    <div class="sec-news__heading">
      <div class="sec-news__inner">
        <?php if (!empty($sec_news_title)) : ?>
        <h2 class="sec-news__title sec-title"><?php esc_html_e($sec_news_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($sec_news_subtitle)) : ?>
        <p class="sec-news__subtitle"><?php echo wp_kses_post($sec_news_subtitle); ?></p>
        <?php endif; ?>
      </div>
      <div class="sec-news__nav slider-nav">
        <button class="sec-news__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="sec-news__btn-next slider-nav__btn slider-nav__btn--next">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
      </div>
    </div>

    <!-- Слайдер -->
    <?php if($sec_news_list && !empty($news_data)) : ?>
    <div class="swiper sec-news__slider slider">
      <div class="swiper-wrapper">
        <?php foreach($news_data as $index => $item) : ?>
        <div class="swiper-slide">
          <!-- <div class="news-card">
            <a href="#" class="news-card__link"></a>
            <div class="news-card__info">
              <span class="news-card__category">Категория 1</span>
              <p class="news-card__text is-clamp" style="--lines: 2;">Lorem isum dolor smile, dont worry
                be&#160;happy, my&#160;dear and lovely user</p>
              <div class="news-card__contact">
                <span class="news-card__name">Связаться с&#160;нами</span>
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
                <img src="<?php echo get_template_directory_uri();?>/img/news/news-thumb.jpg" alt="Иллюстрация к новости" loading="lazy" width="416"
                  height="300">
              </picture>
            </div>
          </div> -->
          <?php get_template_part( "template-parts/components/news-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
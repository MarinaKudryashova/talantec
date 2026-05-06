 <?php
/*
* Section: Реализованные объекты
*/

$sec_projects_title = get_field('sec-projects_title');
$sec_projects_subtitle = get_field('sec-projects_subtitle');
$sec_projects_list = get_field('sec-projects_list');
?>
<section class="sec-projects">
  <div class="sec-projects__container container">
    <div class="sec-projects__heading">
      <div class="sec-projects__inner">
        <?php if (!empty($sec_projects_title)) : ?>
        <h2 class="sec-projects__title sec-title"><?php esc_html_e($sec_projects_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($sec_projects_subtitle)) : ?>
        <p class="sec-projects__subtitle">
          <?php echo wp_kses_post($sec_projects_subtitle); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="sec-projects__nav slider-nav">
        <button class="sec-projects__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="sec-projects__btn-next slider-nav__btn slider-nav__btn--next">
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

    <?php if($sec_projects_list) :
      $template_dir = get_template_directory_uri();
  
      // Собираем все данные в массив
      $projects_data = array();
      
      while(has_sub_field('sec-projects_list')) {
        $item_name = get_sub_field('title');
        $item_link = get_sub_field('link');
        $item_img = get_sub_field('img');
        
        $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
            ? get_image_versions($item_img)
            : array(
                'webp_1x' => $template_dir . '/img/site-preview.webp',
                'original_1x' => $template_dir . '/img/site-preview.jpg',
                'full' => $template_dir . '/img/site-preview.jpg'
            );
        
        $projects_data[] = array(
          'name' => $item_name,
          'link' => (!empty($item_link) && $item_link !== '#') ? $item_link : '#',
          'img_versions' => $item_img_versions
        );
        
      }
      
      if(!empty($projects_data)) :
    ?>
    <div class="swiper sec-projects__slider">
      <div class="swiper-wrapper">
        <?php foreach ($projects_data as $project) : ?>
          <div class="swiper-slide">
            <a href="<?php echo esc_url($project['link']); ?>" class="ui-card">
              <picture class="ui-card__img">
                <?php if (!empty($project['img_versions']['webp_1x'])) : ?>
                <source srcset="<?php echo esc_url($project['img_versions']['webp_1x']); ?>" type="image/webp">
                <?php endif; ?>
                <img loading="lazy" src="<?php echo esc_url($project['img_versions']['original_1x']); ?>" width="640" height="425"
                  aria-hidden="true" alt="">
              </picture>
              <div class="ui-card__link">
                <?php if (!empty($project['name'])) : ?>
                <span class="ui-card__name"><?php echo esc_html($project['name']); ?></span>
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
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; endif; ?>
  </div>
</section>

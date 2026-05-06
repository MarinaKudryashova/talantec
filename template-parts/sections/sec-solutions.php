<?php
/*
* Section: Решения 
*/

  $sec_solutions_title = get_field('sec-solutions_sec_heading_title');
  $sec_solutions_descr = get_field('sec-solutions_sec_heading_descr');
  $sec_solutions_list = get_field('sec-solutions_list');
?>

<section class="sec-blockquote">
  <div class="sec-blockquote__container container">
    <div class="sec-blockquote__content">
      <?php if (!empty($sec_solutions_title)) : ?>
      <h2 class="sec-blockquote__title sec-title"><?php esc_html_e($sec_solutions_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_solutions_descr)) : ?>
      <p class="sec-blockquote__descr"><?php echo wp_kses_post($sec_solutions_descr); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php if($sec_solutions_list) : ?>
<ul class="solutions">
  <?php while(has_sub_field('sec-solutions_list')) : 
    $item_name = get_sub_field('title');
    $item_text = get_sub_field('text');
    $item_img = get_sub_field('img');
    $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
        ? get_image_versions($item_img)
        : array(
            'webp_1x' => $template_dir . '/img/site-preview.webp',
            'original_1x' => $template_dir . '/img/site-preview.jpg',
            'full' => $template_dir . '/img/site-preview.jpg'
        );
  ?>
  <li class="solutions__item">
    <a href="#" class="solutions-card">
      <div class="solutions-card__content">
        <?php if (!empty($item_name)) : ?>
        <h3 class="solutions-card__title"><?php esc_html_e($item_name); ?></h3>
        <?php endif; ?>

        <?php if (!empty($item_text)) : ?>
        <p class="solutions-card__descr"><?php esc_html_e($item_text); ?></p>
        <?php endif; ?>

        <span class="solutions-card__link solutions-card-link">
          <span class="solutions-card-link__text">Узнать больше</span>
          <span class="solutions-card-link__icons ui-arrow">
            <svg class="ui-arrow__svg">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
          </span>
        </span>
      </div>
      <div class="solutions-card__img">
        <picture class="solutions-card__pic">
          <source srcset="<?php echo esc_url($item_img_versions['webp_1x']); ?>" type="image/webp">
          <img loading="lazy" src="<?php echo esc_url($item_img_versions['original_1x']); ?>" width="480" height="300" aria-hidden="true" alt="">
        </picture>
      </div>
    </a>
  </li>
  <?php endwhile; ?>
</ul>
<?php endif; ?>
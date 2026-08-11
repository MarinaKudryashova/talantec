 <?php
/*
* Section: Часто задаваемые вопросы
*/

$page_id = $args["id"];
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';
$layout_ids = $args['layout-ids'] ?? '';

$field_title = $layout_name . '_title';
$field_subtitler = $layout_name . '_subtitle';
$field_list = $layout_name . '_list';

$sec_faq_title = $layout_data[$field_title];
$sec_faq_subtitler = $layout_data[$field_subtitler];
$sec_faq_list = $layout_data[$field_list];

?>

<section class="sec-faq sec-offset" itemscope itemtype="https://schema.org/FAQPage" id="faq-<?php echo $layout_ids; ?>">
  <div class="sec-faq__container container">
    <div class="sec-faq__heading">
      <?php if (!empty($sec_faq_title)) : ?>
      <h2 class="sec-title" data-aos="fade-up"><?php esc_html_e($sec_faq_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_faq_subtitler)) : ?>
      <p class="sec-faq__subtitle" data-aos="fade-up"><?php esc_html_e($sec_faq_subtitler); ?></p>
      <?php endif; ?>
    </div>

    <?php if($sec_faq_list && is_array($sec_faq_list)) : ?>
      <div class="sec-faq__content accordion" data-aos="fade-up">
        <?php foreach($sec_faq_list as $faq) : ?>
          <div class="accordion__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <button class="accordion__control">
              <span class="accordion__title" itemprop="name"><?php echo esc_html($faq->post_title); ?></span>
              <span class="accordion__icon">
                <svg>
                  <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#plus"></use>
                </svg>
              </span>
            </button>
            <div class="accordion__content" aria-hidden="true" itemprop="acceptedAnswer" itemscope="" itemtype="http://schema.org/Answer">
              <div class="accordion__text" itemprop="text"><?php echo wpautop( wp_kses_post($faq->post_content) ); ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else : ?>
      <p><?php esc_html_e( 'В этом разделе пока нет информации.', 'architect' ); ?></p>
    <?php endif; ?>


  </div>
</section>
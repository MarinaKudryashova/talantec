<?php
/* 
* Section: О нас 
*/

$page_id = $args["id"];
$layout_data = $args["layout-data"];
$layout_name = $args["layout-name"];

$field_title = $layout_name . '_sec_heading_title';
$field_descr = $layout_name . '_sec_heading_descr';
$field_list = $layout_name . '_about_facts';

$sec_about_title = $layout_data[$field_title];
$sec_about_descr = $layout_data[$field_descr];
$sec_about_facts = $layout_data[$field_list];
?>

<section class="sec-about sec-offset" id="about-company">
  <div class="sec-about__container container">
    <div class="sec-about__heading">
      <?php if (!empty($sec_about_title)) : ?>
      <h2 class="sec-about__title sec-title"><?php esc_html_e($sec_about_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_about_descr)) : ?>
      <p class="sec-about__descr"><?php echo wp_kses_post($sec_about_descr); ?></p>
      <?php endif; ?>
    </div>
    <?php if ($sec_about_facts) : ?>
    <ul class="about-facts">
      <?php foreach ($sec_about_facts as $fact) : ?>
      <li class="about-facts__item">
        <div class="about-facts__card">
          <?php if (!empty($fact['title'])) : ?>
          <span class="about-facts__label"><?php echo esc_html($fact['title']); ?></span>
          <?php endif; ?>

          <?php if (!empty($fact['value'])) : ?>
          <span class="about-facts__value"><?php echo esc_html($fact['value']); ?></span>
          <?php endif; ?>

          <?php if (!empty($fact['text'])) : ?>
          <p class="about-facts__text"><?php echo esc_html($fact['text']); ?></p>
          <?php endif; ?>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>
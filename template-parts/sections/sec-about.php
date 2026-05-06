<?php
/* 
* Section: О нас 
*/
$page_id = $args["id"];
$sec_about_title = get_field('sec-about_sec_heading_title', $page_id);
$sec_about_descr = get_field('sec-about_sec_heading_descr', $page_id);
$sec_about_facts = get_field('sec-about_about_facts', $page_id);
?>

<section class="sec-about" id="about-company">
  <div class="sec-about__container container">
    <div class="sec-about__heading">
      <?php if (!empty($sec_about_title)) : ?>
      <h2 class="sec-about__title sec-title"><?php esc_html_e($sec_about_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_about_descr)) : ?>
      <p class="sec-about__descr"><?php echo wp_kses_post($sec_about_descr); ?></p>
      <?php endif; ?>
    </div>
    <?php if($sec_about_facts) : ?>
    <ul class="about-facts">
      <?php while(has_sub_field('sec-about_about_facts')) : 
        $fact_name = get_sub_field('title');
        $fact_value = get_sub_field('value');
        $fact_text = get_sub_field('text');
      ?>
      <li class="about-facts__item">
        <div class="about-facts__card">
          <?php if (!empty($fact_name)) : ?>
          <span class="about-facts__label"><?php esc_html_e($fact_name); ?></span>
          <?php endif; ?>

          <?php if (!empty($fact_value)) : ?>
          <span class="about-facts__value"><?php esc_html_e($fact_value); ?></span>
          <?php endif; ?>

          <?php if (!empty($fact_text)) : ?>
          <p class="about-facts__text"><?php esc_html_e($fact_text); ?></p>
          <?php endif; ?>
        </div>
      </li>
      <?php endwhile; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>
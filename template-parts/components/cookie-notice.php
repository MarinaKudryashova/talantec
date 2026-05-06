<div id="cookie-notice" class="cookie-notice">
  <div class="cookie-notice__container">
    <?php if(!empty(get_field('cookie_text', 'option'))) : ?>
    <p class="cookie-notice__text">
      <?php echo esc_html(get_field('cookie_text', 'option')); ?>
      <a href="<?php if(!empty(get_field('cookie_link', 'option'))) : echo esc_url(get_field('cookie_link', 'option')); else : echo get_template_directory_uri();?>/cookie-policy<?php endif; ?>"
        class="cookie-notice__link link"><?php if(!empty(get_field('cookie_link', 'option'))) :  echo esc_html(get_field('cookie_link_name', 'option')); else : echo esc_html('с условиями использования файлов cookie.'); endif; ?></a>
    </p>
    <?php endif; ?>
    <button id="cookie-accept"
      class="cookie-notice__btn"><?php if(!empty(get_field('cookie_btn_text', 'option'))) : echo esc_html(get_field('cookie_btn_text', 'option')); else : echo esc_html('Согласен'); endif; ?></button>
  </div>

  <!-- Простой вариант с одним SVG фоном -->
  <img class="cookie-notice__bg" src="<?php echo get_template_directory_uri();?>/img/cookie-banner/cookie-bg.svg" alt=""
    aria-hidden="true" />
</div>
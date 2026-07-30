<?php
/*
* Section: Цитата
*/

$page_id = $args['id'] ?? 0;
$layout_data = $args['layout-data'] ?? [];
$layout_name = $args['layout-name'] ?? '';

$field_title = $layout_name . '_sec_heading_title';
$field_descr = $layout_name . '_sec_heading_descr';
$field_position = $layout_name . '_position';


$sec_blockquote_title = $layout_data[$field_title];
$sec_blockquote_descr = $layout_data[$field_descr];
$sec_blockquote_position = $layout_data[$field_position];
?>

<section class="sec-blockquote sec-offset">
  <div class="sec-blockquote__container container">
    <div class="sec-blockquote__content <?php if ($sec_blockquote_position == 'reverse') : ?>sec-blockquote__content--reverse<?php endif; ?>">
      <?php if (!empty($sec_blockquote_title)) : ?>
      <h2 class="sec-blockquote__title sec-title"><?php esc_html_e($sec_blockquote_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($sec_blockquote_descr)) : ?>
      <p class="sec-blockquote__descr"><?php echo wp_kses_post($sec_blockquote_descr); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
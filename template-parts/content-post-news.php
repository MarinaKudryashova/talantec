<?php
$page_id = $args["page_id"];
$type = $args["type"];
$content = get_the_content();
$has_content = !empty(trim($content));

// Если контента нет - ничего не выводим
if (!$has_content) {
    return;
}
?>

<div class="<?php echo esc_attr($type); ?> sec-offset" id="<?php echo esc_attr($type); ?>">
  <div class="<?php echo esc_attr($type); ?>__container container">
    <div class="textredactor">
      <?php echo apply_filters('the_content', $content); ?>
    </div>
    
    <div class="single-navigation">
      <?php custom_post_navigation(); ?>
    </div>
  </div>
</div>
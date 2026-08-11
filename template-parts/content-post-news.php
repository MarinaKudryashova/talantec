<?php
$page_id = $args["page_id"];
$type = $args["type"];
?>

<div class="<?php echo esc_attr($type); ?> sec-offset" id="<?php echo esc_attr($type); ?>">
  <div class="<?php echo esc_attr($type); ?>__container container">
    <div class="textredactor">
      <?php the_content(); ?>
    </div>
    <div class="single-navigation">
      <?php custom_post_navigation(); ?>
    </div>
  </div>
</div>
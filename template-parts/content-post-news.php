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
      <?php
        //   the_post_navigation(
        //   array(
        //     'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'architect' ) . '</span> <span class="nav-title">%title</span>',
        //     'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'architect' ) . '</span> <span class="nav-title">%title</span>',
        //   )
        // );
      ?>
      <?php custom_post_navigation(); ?>
    </div>
  </div>
</div>
<?php
/*
Template Name: Продуктовая страница
Template Post Type: page
*/

$page_id = get_the_ID();

architect_get_header();
?>
<main class="main">
  <?php 
    /*-- Первый блок - фиксированный --*/
    get_template_part( "template-parts/sections/hero", 'production', array('id' => $page_id));
  ?>
  <div class="content-overlay content-overlay--production">
    <?php 
      $arSection = get_field('page-production_show_section');
      if ($arSection) :
        foreach ($arSection as $section) {
          get_template_part( "template-parts/sections/sec", "$section", array('id' => $page_id));
        }
      endif;
    ?>
  </div>
</main>
<?php architect_get_footer(); ?>
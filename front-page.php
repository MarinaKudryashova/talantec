<?php
/*
Template Name: Главная страница
Template Post Type: page
*/

$page_id = get_the_ID();
?>

<?php architect_get_header(); ?>
  <main class="main">
    <?php 
      /*-- Первый блок - фиксированный --*/
      get_template_part( "template-parts/sections/hero", '', array('id' => $page_id));
    ?>

    <div class="content-overlay">
      <?php 
        // $arSection = get_field('show_section_page');
        // if ($arSection) :
        //   foreach ($arSection as $section) {
        //     get_template_part( "template-parts/sections/sec-$section", '', array('id' => $page_id));
        //   }
        // endif;
      ?>
      <?php
        architect_render_flexible_layouts($page_id, get_field('layouts'));
      ?>
    </div>
  </main>
<?php architect_get_footer(); ?>

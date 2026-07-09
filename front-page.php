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
        $arlayouts = get_field('layouts');
        // var_dump($arlayouts);
        if ($arlayouts) :
          foreach ($arlayouts as $ids => $layout) :
            $layout_name = $layout['acf_fc_layout'];
            $layout_ids = $ids;
            get_template_part('template-parts/sections/' . $layout_name, '', array('id' => $page_id, 'layout-data' => $layout, 'layout-name' => $layout_name, 'layout-ids' => $layout_ids));
          endforeach;
        endif;
      ?>
    </div>
  </main>
<?php architect_get_footer(); ?>

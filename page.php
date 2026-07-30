<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package architect
 */

	architect_get_header();
  $page_id = get_the_ID();
?>
  <main class="main">
    <?php 
      /*-- Первый блок - фиксированный --*/
      get_template_part( "template-parts/sections/hero", 'page', array('id' => $page_id));
    ?>

    <div class="content-overlay content-overlay--page">
      <?php 
        $arlayouts = get_field('layouts');
        // var_dump($arlayouts);
        if ($arlayouts) :
          foreach ($arlayouts as $ids => $layout) :
            $layout_name = $layout['acf_fc_layout'];
            $layout_ids = $ids;
            // var_dump($layout);
            get_template_part('template-parts/sections/' . $layout_name, '', array('id' => $page_id, 'layout-data' => $layout, 'layout-name' => $layout_name, 'layout-ids' => $layout_ids));
          endforeach;
        endif;
      ?>
    </div>
  </main>
<?php architect_get_footer();

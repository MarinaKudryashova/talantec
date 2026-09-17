<?php
/*
 * Template Name: Продуктовая страница
 * Template Post Type: page
 *
 * @package architect
*/

$page_id = get_the_ID();

architect_get_header();
?>
<main class="main">
  <?php 
    /*-- Первый блок - фиксированный --*/
    get_template_part( "template-parts/sections/hero", 'page', array('id' => $page_id));
  ?>
  <div class="content-overlay content-overlay--page">
    <?php 
      $arSection = get_field('page-production_show_section');
      if ( is_array( $arSection ) && $arSection ) :
        foreach ($arSection as $section) {
          $section = sanitize_file_name((string) $section);
          if ($section === '' || strpos($section, '.') !== false) {
            continue;
          }
          $file = get_template_directory() . '/template-parts/sections/sec-' . $section . '.php';
          if (!is_file($file)) {
            continue;
          }
          get_template_part( "template-parts/sections/sec", $section, array('id' => $page_id));
        }
      endif;
    ?>
  </div>
</main>
<?php architect_get_footer(); ?>
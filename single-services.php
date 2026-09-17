<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
				get_template_part('template-parts/content-post-news', '', array('page_id' => $page_id, 'type' => 'post-news'));
        architect_render_flexible_layouts($page_id, get_field('layouts'));
      ?>
    </div>
  </main>

<?php
architect_get_footer();

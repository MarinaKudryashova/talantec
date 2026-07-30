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

				// while ( have_posts() ) :
				// 	the_post();

				// 	// get_template_part( 'template-parts/content', get_post_type() );



				// endwhile; // End of the loop.

        $arlayouts = get_field('layouts');
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

<?php
architect_get_footer();

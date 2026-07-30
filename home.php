<?php
/**
 * Шаблон архива проектов news
 * Этот шаблон автоматически используется для страницы выбранной как "Страница записей проектов"
 */

architect_get_header();

// Получаем ID страницы проектов
$news_page_id = get_option('page_for_posts');
// var_dump($news_page_id);
?>

<main class="main">
  <?php 
    /*-- Первый блок - фиксированный --*/
    get_template_part( "template-parts/sections/hero", 'page', array('id' => $news_page_id));
  ?>
  <div class="content-overlay content-overlay--page">
  <?php 
    get_template_part('template-parts/content-news', '', array('page_id' => $news_page_id, 'type' => 'news'));
    $arlayouts = get_field('layouts');
    if ($arlayouts) :
      foreach ($arlayouts as $ids => $layout) :
        $layout_name = $layout['acf_fc_layout'];
        $layout_ids = $ids;
        get_template_part('template-parts/sections/' . $layout_name, '', array('id' => $news_page_id, 'layout-data' => $layout, 'layout-name' => $layout_name, 'layout-ids' => $layout_ids));
      endforeach;
    endif;
  ?>
  </div>
</main>

<?php architect_get_footer(); 
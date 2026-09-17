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
    architect_render_flexible_layouts($news_page_id, get_field('layouts', $news_page_id));
  ?>
  </div>
</main>

<?php architect_get_footer(); 
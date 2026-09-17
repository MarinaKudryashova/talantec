<?php
/**
 * Шаблон архива проектов projects
 * Этот шаблон автоматически используется для страницы выбранной как "Страница записей проектов"
 */

architect_get_header();

// Получаем ID страницы проектов
$projects_page_id = get_projects_page_id();
?>

<main class="main">
  <?php 
    /*-- Первый блок - фиксированный --*/
    get_template_part( "template-parts/sections/hero", 'page', array('id' => $projects_page_id));
  ?>
  <div class="content-overlay content-overlay--page">
  <?php 
    get_template_part('template-parts/content-projects', '', array('page_id' => $projects_page_id, 'type' => 'projects'));
    architect_render_flexible_layouts($projects_page_id, get_field('layouts', $projects_page_id));
  ?>
  </div>
</main>

<?php architect_get_footer(); 
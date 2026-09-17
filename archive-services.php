<?php
/**
 * Шаблон архива услуг services
 * Этот шаблон автоматически используется для страницы выбранной как "Страница записей услуг"
 */

architect_get_header();

// Получаем ID страницы услуг
$services_page_id = get_services_page_id();
?>

<main class="main">
  <?php 
    /*-- Первый блок - фиксированный --*/
    get_template_part( "template-parts/sections/hero", 'page', array('id' => $services_page_id));
  ?>
  <div class="content-overlay content-overlay--page">
  <?php 
    get_template_part('template-parts/content-services', '', array('page_id' => $services_page_id, 'type' => 'services'));
    architect_render_flexible_layouts($services_page_id, get_field('layouts', $services_page_id));
  ?>
  </div>
</main>

<?php architect_get_footer(); 
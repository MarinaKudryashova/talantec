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
    $arlayouts = get_field('layouts');
    // var_dump($arlayouts);
    if ($arlayouts) :
      foreach ($arlayouts as $ids => $layout) :
        $layout_name = $layout['acf_fc_layout'];
        $layout_ids = $ids;
        // var_dump($layout);
        get_template_part('template-parts/sections/' . $layout_name, '', array('id' => $projects_page_id, 'layout-data' => $layout, 'layout-name' => $layout_name, 'layout-ids' => $layout_ids));
      endforeach;
    endif;
  ?>
  </div>
</main>

<?php architect_get_footer(); 
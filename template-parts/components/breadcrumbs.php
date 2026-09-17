<?php
/**
 * Шаблон "хлебных крошек"
*/

if (function_exists('yoast_breadcrumb')) {
  yoast_breadcrumb();
} else {
  $page_main_id = get_option('page_on_front');
  $page_main_url = get_permalink($page_main_id);
  $page_main_title = get_the_title($page_main_id);

  // Получаем страницу записей (блога)
  $page_blog_id = get_option('page_for_posts');
  $page_blog_url = $page_blog_id ? get_permalink($page_blog_id) : '';
  $page_blog_title = $page_blog_id ? get_the_title($page_blog_id) : 'Новости';

  // Страницы архивов для кастомных типов
  $projects_page_id = get_option('page_for_projects');
  $projects_page_url = $projects_page_id ? get_permalink($projects_page_id) : '';
  $projects_page_title = $projects_page_id ? get_the_title($projects_page_id) : 'Проекты';

  $services_page_id = get_option('page_for_services');
  $services_page_url = $services_page_id ? get_permalink($services_page_id) : '';
  $services_page_title = $services_page_id ? get_the_title($services_page_id) : 'Услуги';

  $page_current_id = get_the_ID();
  $position = 1;
?>
  <ul class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a class="breadcrumbs__link" href="<?php echo esc_url($page_main_url); ?>" title="Главная" itemprop="item">
        <span itemprop="name"><?php echo esc_html($page_main_title); ?></span>
        <meta itemprop="position" content="1">
      </a>
    </li>

    <?php if (is_single() && get_post_type() === 'post') : ?>
      <!-- Страница записей (блог) -->
      <?php if ($page_blog_url) : ?>
          <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
              <a class="breadcrumbs__link" href="<?php echo esc_url($page_blog_url); ?>" title="<?php echo esc_attr($page_blog_title); ?>" itemprop="item">
                  <span itemprop="name"><?php echo esc_html($page_blog_title); ?></span>
                  <meta itemprop="position" content="<?php echo $position++; ?>">
              </a>
          </li>
      <?php endif; ?>
      
      <!-- Текущая статья -->
      <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
          itemscope itemtype="https://schema.org/ListItem">
          <span itemprop="name"><?php echo esc_html(get_the_title($page_current_id)); ?></span>
          <meta itemprop="position" content="<?php echo $position++; ?>">
      </li>

    <?php elseif (is_single() && get_post_type() === 'projects') : ?>
      <?php if ($projects_page_url) : ?>
          <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
              <a class="breadcrumbs__link" href="<?php echo esc_url($projects_page_url); ?>" title="<?php echo esc_attr($projects_page_title); ?>" itemprop="item">
                  <span itemprop="name"><?php echo esc_html($projects_page_title); ?></span>
                  <meta itemprop="position" content="<?php echo $position++; ?>">
              </a>
          </li>
      <?php endif; ?>

      <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
          itemscope itemtype="https://schema.org/ListItem">
          <span itemprop="name"><?php echo esc_html(get_the_title($page_current_id)); ?></span>
          <meta itemprop="position" content="<?php echo $position++; ?>">
      </li>

    <?php elseif (is_single() && get_post_type() === 'services') : ?>
      <?php if ($services_page_url) : ?>
          <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
              <a class="breadcrumbs__link" href="<?php echo esc_url($services_page_url); ?>" title="<?php echo esc_attr($services_page_title); ?>" itemprop="item">
                  <span itemprop="name"><?php echo esc_html($services_page_title); ?></span>
                  <meta itemprop="position" content="<?php echo $position++; ?>">
              </a>
          </li>
      <?php endif; ?>

      <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
          itemscope itemtype="https://schema.org/ListItem">
          <span itemprop="name"><?php echo esc_html(get_the_title($page_current_id)); ?></span>
          <meta itemprop="position" content="<?php echo $position++; ?>">
      </li>
      
    <?php elseif (is_page()) : ?>
        <!-- Для обычных страниц -->
        <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
            itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name"><?php echo esc_html(get_the_title($page_current_id)); ?></span>
            <meta itemprop="position" content="<?php echo $position++; ?>">
        </li>
      
    <?php elseif (is_home()) : ?>
        <!-- Страница блога (список новостей) -->
        <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
            itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name"><?php echo esc_html($page_blog_title); ?></span>
            <meta itemprop="position" content="<?php echo $position++; ?>">
        </li>

        <?php elseif (is_tax('projects_category')) : ?>
            <?php if ($projects_page_url) : ?>
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a class="breadcrumbs__link" href="<?php echo esc_url($projects_page_url); ?>" title="<?php echo esc_attr($projects_page_title); ?>" itemprop="item">
                        <span itemprop="name"><?php echo esc_html($projects_page_title); ?></span>
                        <meta itemprop="position" content="<?php echo $position++; ?>">
                    </a>
                </li>
            <?php endif; ?>
            <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
                itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?php echo esc_html(single_term_title('', false)); ?></span>
                <meta itemprop="position" content="<?php echo $position++; ?>">
            </li>

        <?php elseif (is_tax('services_category')) : ?>
            <?php if ($services_page_url) : ?>
                <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a class="breadcrumbs__link" href="<?php echo esc_url($services_page_url); ?>" title="<?php echo esc_attr($services_page_title); ?>" itemprop="item">
                        <span itemprop="name"><?php echo esc_html($services_page_title); ?></span>
                        <meta itemprop="position" content="<?php echo $position++; ?>">
                    </a>
                </li>
            <?php endif; ?>
            <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
                itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?php echo esc_html(single_term_title('', false)); ?></span>
                <meta itemprop="position" content="<?php echo $position++; ?>">
            </li>

        <?php elseif (is_search()) : ?>
          <!-- Результаты поиска -->
          <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
              itemscope itemtype="https://schema.org/ListItem">
              <span itemprop="name">Поиск: <?php echo esc_html(get_search_query()); ?></span>
              <meta itemprop="position" content="<?php echo $position++; ?>">
          </li>
            
        <?php elseif (is_category()) : ?>
            <!-- Архив категории блога -->
            <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
                itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?php echo esc_html(single_cat_title('', false)); ?></span>
                <meta itemprop="position" content="<?php echo $position++; ?>">
            </li>
            
        <?php elseif (is_tag()) : ?>
            <!-- Архив тега -->
            <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
                itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?php echo esc_html(single_tag_title('', false)); ?></span>
                <meta itemprop="position" content="<?php echo $position++; ?>">
            </li>
            
        <?php elseif (is_404()) : ?>
            <!-- Страница 404 -->
            <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
                itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name">Страница не найдена</span>
                <meta itemprop="position" content="<?php echo $position++; ?>">
            </li>
            
        <?php else : ?>
            <!-- Все остальные случаи -->
            <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page" itemprop="itemListElement"
                itemscope itemtype="https://schema.org/ListItem">
                <span itemprop="name"><?php echo esc_html(get_the_title($page_current_id)); ?></span>
                <meta itemprop="position" content="<?php echo $position++; ?>">
            </li>
        <?php endif; ?>
  </ul>
<?php
}
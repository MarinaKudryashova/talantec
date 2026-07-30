<?php
/**
 * Категория статей
 * category.php
 * 
 * @deprecated Используется редирект на страницу каталога с ЧПУ
 */

$news_page_id = get_option('page_for_posts');

if($news_page_id) {
    $page_slug = get_post_field('post_name', $news_page_id);
    $category = get_queried_object();
    
    if($category) {
        wp_redirect(home_url('/' . $page_slug . '/' . $category->slug . '/'), 301);
        exit;
    }
} else {
    architect_get_header(); ?>
    <main class="main">
      <div class="projects sec-offset">
        <div class="container">
            <h1 class="projects__title sec-title"><?php single_term_title(); ?></h1>
            <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post(); ?>
                    <h2><?php the_title(); ?></h2>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
      </div>
    </main>
    <?php architect_get_footer();
}
<?php
$page_id = $args["page_id"];
$type = $args["type"];
$taxonomy = $type . '_category';
$columns = get_projects_per_row();

// Только ЧПУ, без поддержки GET-параметров
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$current_cat = get_query_var($taxonomy);

$post_args = array(
    'post_type' => $type,
    'post_status' => 'publish',
    'posts_per_page' => get_projects_per_page(),
    'paged' => $paged,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

// Добавляем фильтр по категории из ЧПУ
if(!empty($current_cat)) {
    $post_args['tax_query'] = array(
        array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $current_cat
        )
    );
}

$projects_query = new WP_Query($post_args);
// echo var_dump(get_projects_per_row());
$page_slug = get_post_field('post_name', $page_id);
?>

<section class="<?php echo esc_attr($type); ?> sec-offset" id="<?php echo esc_attr($type); ?>">
  <div class="<?php echo esc_attr($type); ?>__container container">
    <div class="<?php echo esc_attr($type); ?>__content">
      
      <!-- Навигация по категориям с ЧПУ ссылками -->
      <div class="<?php echo esc_attr($type); ?>__nav categories-nav" data-aos="fade-up" data-aos-delay="200">
        <ul class="categories-nav__list">
          <li class="categories-nav__item">
            <a href="<?php echo get_permalink($page_id); ?>" class="categories-nav__link <?php echo empty($current_cat) ? 'is-active' : ''; ?>">
              Все проекты
            </a>
          </li>
          <?php
          $categories = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false
          ));
          
          foreach($categories as $cat) :
            $active = ($current_cat == $cat->slug) ? 'is-active' : '';
            $url = home_url('/' . $page_slug . '/' . $cat->slug . '/');
          ?>
            <li class="categories-nav__item">
              <a href="<?php echo esc_url($url); ?>" class="categories-nav__link <?php echo $active; ?>">
                <?php echo esc_html($cat->name); ?>
                <!-- <span class="count">(<?php //echo $cat->count; ?>)</span> -->
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      
      <!-- Список проектов -->
      <?php 
        if($projects_query->have_posts()) : 
          $index = 0;
          $projects_data = array();
          $template_dir = get_template_directory_uri();

          while($projects_query->have_posts()) : $projects_query->the_post();
            $item_name = get_the_title();
            $item_link = get_permalink() ?: '#';
            $item_img = get_the_post_thumbnail_url();
            
            $item_img_versions = (!empty($item_img) && function_exists('get_image_versions')) 
                ? get_image_versions($item_img)
                : array(
                    'webp_1x' => $template_dir . '/img/site-preview.webp',
                    'original_1x' => $template_dir . '/img/site-preview.jpg',
                    'full' => $template_dir . '/img/site-preview.jpg'
                    );
                // get_placeholder_image();

            $projects_data[] = array(
              'name' => $item_name,
              'link' => $item_link,
              'img_versions' => $item_img_versions
            );
          endwhile; 
          wp_reset_postdata(); 
      ?>
      <ul class="layout layout--<?php echo esc_attr( $columns ); ?>" style="--columns: <?php echo esc_attr( $columns ); ?>">
         <?php foreach($projects_data as $index => $item) : ?>
          <li class="layout__item" data-aos="fade-up" data-aos-anchor=".<?php echo esc_attr($type); ?>__nav" data-aos-delay="<?php echo 400 + $index++ * 100; ?>">
            <?php get_template_part( "template-parts/components/ui-card", '', array('id' => $page_id, 'item-data' => $item)); ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php else : ?>
        <p class="not-found">Проектов не найдено</p>
      <?php endif; ?>
    </div>
  </div>
</section>
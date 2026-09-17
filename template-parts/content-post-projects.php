<?php
// Проверяем наличие обязательных аргументов
if (!isset($args["page_id"]) || !isset($args["type"])) {
    return;
}

$page_id = $args["page_id"];
$type = $args["type"];
$content = get_the_content();

$tags = get_the_terms($page_id, 'projects_tags');
$chars = get_field('projects_chars', $page_id);
$info = get_field('projects_info', $page_id);
$gallery = get_field('projects_gallery', $page_id);
// var_dump($gallery);

// Проверяем, есть ли теги и нет ли ошибки
$has_tags = ($tags && !is_wp_error($tags) && !empty($tags));

// Проверяем, есть ли характеристики
$has_chars = (!empty($chars) && is_array($chars));

// Если нужно скрывать блок когда нет ни тегов, ни характеристик
// $has_content = $has_tags || $has_chars || !empty($info) || !empty($gallery);
// if (!$has_content) {
//     return;
// }
?>

<div class="<?php echo esc_attr($type); ?> sec-offset" id="<?php echo esc_attr($type); ?>">
  <div class="<?php echo esc_attr($type); ?>__container container">
    <div class="<?php echo esc_attr($type); ?>__about">
      <div class="<?php echo esc_attr($type); ?>__inner">
        <?php if ($has_tags): ?>
        <div class="<?php echo esc_attr($type); ?>__tag">
          <?php foreach ($tags as $item): ?>
            <span class="<?php echo esc_attr($type); ?>__taglink">
              <?php echo esc_html($item->name); ?>
            </span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <?php if ($has_chars): ?>
        <ul class="<?php echo esc_attr($type); ?>__chars">
          <?php foreach ($chars as $char): ?>
            <li>
              <b><?php echo esc_html($char['name']); ?></b>
              <span><?php echo esc_html($char['value']); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>

      <?php if (has_post_thumbnail($page_id)): ?>
      <picture class="<?php echo esc_attr($type); ?>__thumbs">
        <?php
          $projects_thumb_id = get_post_thumbnail_id($page_id);
          $projects_img_versions = (!empty($projects_thumb_id) && function_exists('get_image_versions'))
            ? get_image_versions($projects_thumb_id, 'full', false)
            : array(
              'webp_1x'     => get_template_directory_uri() . '/img/site-preview.webp',
              'original_1x' => get_template_directory_uri() . '/img/site-preview.jpg',
              'format'      => 'jpg',
          );
        ?>
          <?php architect_picture_mobile_sources($projects_img_versions); ?>
          <?php if (!empty($projects_img_versions['webp_1x'])) : ?>
          <source srcset="<?php echo esc_url($projects_img_versions['webp_1x']); ?>" type="image/webp">
          <?php endif; ?>
          <img 
            class="<?php echo esc_attr($type); ?>__img" 
            src="<?php echo esc_url($projects_img_versions['original_1x']); ?>" 
            width="640"
            height="460"
            alt="<?php echo esc_attr(get_the_title($page_id)); ?>" 
            loading="lazy"
            decoding="async"
          >
      </picture>
      <?php endif; ?>
      
    </div>
    
    <?php if (!empty($info)): ?>
    <div class="<?php echo esc_attr($type); ?>__info">
      <!-- Блок "Задача" -->
      <?php if (!empty($info['task'])): ?>
      <div class="<?php echo esc_attr($type); ?>__task">
        <?php if (!empty($info['task']['title'])): ?>
        <h3 class="<?php echo esc_attr($type); ?>__title">
          <?php echo esc_html($info['task']['title']); ?>
        </h3>
        <?php endif; ?>
        
        <?php if (!empty($info['task']['text'])): ?>
        <p class="<?php echo esc_attr($type); ?>__text">
          <?php echo esc_html($info['task']['text']); ?>
        </p>
        <?php endif; ?>
      </div>
      <?php endif; ?>
  
      <!-- Блок "Решение" -->
      <?php if (!empty($info['result'])): ?>
      <div class="<?php echo esc_attr($type); ?>__result">
        <?php if (!empty($info['result']['title'])): ?>
        <h3 class="<?php echo esc_attr($type); ?>__title">
          <?php echo esc_html($info['result']['title']); ?>
        </h3>
        <?php endif; ?>
        
        <?php if (!empty($info['result']['list']) && is_array($info['result']['list'])): ?>
        <ul class="<?php echo esc_attr($type); ?>__list">
          <?php foreach ($info['result']['list'] as $item): ?>
            <?php if (!empty($item['item'])): ?>
            <li>
              <svg>
                <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
              </svg>
              <span><?php echo esc_html($item['item']); ?></span>
            </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    
    
    <?php if (!empty($gallery) && is_array($gallery)): ?>
      <div class="<?php echo esc_attr($type); ?>__gallery">
        <?php 
        $counter = 0;
        foreach ($gallery as $img): 
          $counter++;
          $img_id = $img["ID"] ?? 0;
          
          // Путь к заглушке
          $placeholder_path = get_template_directory_uri() . '/img/placeholder';
          
          $img_versions = (!empty($img_id) && function_exists('get_image_versions')) 
            ? get_image_versions($img_id)
            : array(
                'webp_1x' => !empty($img['url']) ? $img['url'] : $placeholder_path . '.webp',
                'original_1x' => !empty($img['url']) ? $img['url'] : $placeholder_path . '.jpg',
                'full' => !empty($img['url']) ? $img['url'] : $placeholder_path . '.jpg'
          );
          
          // Если есть URL но нет webp версии - используем заглушку для webp
          if (!empty($img['url']) && empty($img_versions['webp_1x'])) {
            $img_versions['webp_1x'] = $placeholder_path . '.webp';
          }
          
          $img_alt = !empty($img['alt']) ? $img['alt'] : get_the_title($page_id);
          $img_caption = !empty($img['caption']) ? $img['caption'] : '';
          
          $link_class = esc_attr($type) . '__glink';
          $img_width = 291;
          $img_height = 218;
          
          if ($counter === 1) {
            $link_class .= ' ' . esc_attr($type) . '__glink--big';
            $img_width = 682;
            $img_height = 459;
          }
        ?>
          <a 
            data-fslightbox="<?php echo esc_attr($type); ?>-gallery" 
            data-caption="<?php echo esc_attr($img_caption); ?>"
            href="<?php echo !empty($img['url']) ? esc_url($img['url']) : esc_url($placeholder_path . '.jpg'); ?>"
            class="<?php echo $link_class; ?> gallery-zoom"         
          >
            <picture class="<?php echo esc_attr($type); ?>__picture">
              <?php architect_picture_mobile_sources($img_versions); ?>
              <?php if (!empty($img_versions['webp_1x'])): ?>
              <source srcset="<?php echo esc_url($img_versions['webp_1x']); ?>" type="image/webp">
              <?php endif; ?>
              <img 
                src="<?php echo esc_url($img_versions['original_1x']); ?>" 
                width="<?php echo esc_attr($img_width); ?>"
                height="<?php echo esc_attr($img_height); ?>"
                alt="<?php echo esc_attr($img_alt); ?>"
                decoding="async"
                loading="lazy"
              >
            </picture>
            <?php echo architect_gallery_zoom_icon(); ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    
    <div class="single-navigation">
      <?php custom_post_navigation(); ?>
    </div>

  </div>
</div>
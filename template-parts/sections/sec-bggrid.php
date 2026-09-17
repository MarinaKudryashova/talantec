<?php
/*
* Section: Сетка с фоном
*/

$page_id     = $args['id'] ?? 0;
$layout_data = is_array( $args['layout-data'] ?? null ) ? $args['layout-data'] : array();
$layout_name = $args['layout-name'] ?? '';

$field_list       = $layout_name . '_list';
$sec_bggrid_list  = $layout_data[ $field_list ] ?? array();
?>


<?php
if ( $sec_bggrid_list && is_array( $sec_bggrid_list ) ) :
	$template_dir = get_template_directory_uri();

	$bggrid_data = array();
	$counter     = 1;

	foreach ( $sec_bggrid_list as $item ) {
		$item_name = $item['title'];
		$item_link = $item['link'];
		$item_img  = $item['img'];

		$item_img_versions = ( ! empty( $item_img ) && function_exists( 'get_image_versions' ) )
			? get_image_versions( $item_img )
			: array(
				'webp_1x'     => $template_dir . '/img/site-preview.webp',
				'original_1x' => $template_dir . '/img/site-preview.jpg',
				'full'        => $template_dir . '/img/site-preview.jpg',
			);

		$bggrid_data[] = array(
			'index'        => $counter,
			'name'         => $item_name,
			'link'         => ( ! empty( $item_link ) && $item_link !== '#' ) ? $item_link : '#',
			'img_versions' => $item_img_versions,
		);

		$counter++;
	}

	if ( ! empty( $bggrid_data ) ) :
		?>
<div class="bggrid">
  <ul class="bggrid-bgs">
    <?php foreach ( $bggrid_data as $item ) : ?>
    <li class="bggrid-bgs__item <?php echo $item['index'] === 1 ? 'is-active' : ''; ?>" data-bg-index="<?php echo $item['index']; ?>">
      <picture class="bggrid-bgs__img">
        <?php architect_picture_mobile_sources( $item['img_versions'] ); ?>
        <?php if ( ! empty( $item['img_versions']['webp_1x'] ) ) : ?>
        <source srcset="<?php echo esc_url( $item['img_versions']['webp_1x'] ); ?>" type="image/webp">
        <?php endif; ?>
        <img loading="lazy" src="<?php echo esc_url( $item['img_versions']['original_1x'] ); ?>" width="1440" height="800" aria-hidden="true" alt="" decoding="async">
      </picture>
    </li>
    <?php endforeach; ?>
  </ul>

  <ul class="bggrid__list">
    <?php foreach ( $bggrid_data as $item ) : ?>
    <li class="bggrid__item">
      <a href="<?php echo esc_url( $item['link'] ); ?>" class="bggrid-link" data-bg-target="<?php echo $item['index']; ?>">
        <picture class="bggrid-link__img">
          <?php architect_picture_mobile_sources( $item['img_versions'] ); ?>
          <?php if ( ! empty( $item['img_versions']['webp_1x'] ) ) : ?>
          <source srcset="<?php echo esc_url( $item['img_versions']['webp_1x'] ); ?>" type="image/webp">
          <?php endif; ?>
          <img loading="lazy" src="<?php echo esc_url( $item['img_versions']['original_1x'] ); ?>" width="1440" height="800" aria-hidden="true" alt="" decoding="async">
        </picture>
        <span class="bggrid-link__number"></span>
        <?php if ( ! empty( $item['name'] ) ) : ?>
        <span class="bggrid-link__name"><?php echo esc_html( $item['name'] ); ?></span>
        <?php endif; ?>
        <span class="bggrid-link__arrow">
          <span class="ui-arrow">
            <svg class="ui-arrow__svg">
              <use xlink:href="<?php echo $template_dir; ?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
            <svg class="ui-arrow__svg ui-arrow__svg--copy">
              <use xlink:href="<?php echo $template_dir; ?>/img/sprite.svg#icon-arrow-diagonal"></use>
            </svg>
          </span>
        </span>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
		<?php
	endif;
endif;
?>

<?php
/**
 * Section: Преимущества
 */
$page_id     = $args['id'] ?? 0;
$layout_data = is_array( $args['layout-data'] ?? null ) ? $args['layout-data'] : array();
$layout_name = $args['layout-name'] ?? '';
$layout_ids  = $args['layout-ids'] ?? '';

$field_list    = $layout_name . '_list';
$field_columns = $layout_name . '_columns';
$benefits      = $layout_data[ $field_list ] ?? array();
$columns       = absint( $layout_data[ $field_columns ] ?? 4 );

if ( $columns < 1 ) {
	$columns = 4;
} elseif ( $columns > 6 ) {
	$columns = 6;
}

if ( ! is_array( $benefits ) || ! $benefits ) {
	return;
}
?>

<section class="sec-benefits sec-offset" id="<?php echo esc_attr( $layout_name . '-' . $layout_ids ); ?>">
	<div class="sec-benefits__container container">
		<ul class="benefits" style="--columns: <?php echo esc_attr( (string) $columns ); ?>">
			<?php
			$index = 0;
			foreach ( $benefits as $value ) :
				$icon  = $value['icon'] ?? '';
				$title = $value['title'] ?? '';
				$text  = $value['text'] ?? '';

				if ( is_array( $icon ) ) {
					$icon = $icon['url'] ?? '';
				} elseif ( is_numeric( $icon ) ) {
					$icon = wp_get_attachment_url( (int) $icon ) ?: '';
				}

				$icon  = is_string( $icon ) ? trim( $icon ) : '';
				$title = is_string( $title ) ? trim( $title ) : '';
				$text  = is_string( $text ) ? trim( $text ) : '';

				if ( $icon === '' && $title === '' && $text === '' ) {
					continue;
				}

				$delay = $index * 100 + 50;
				$index++;
				?>
			<li class="benefits__item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="<?php echo esc_attr( (string) $delay ); ?>">
				<?php if ( $icon !== '' ) : ?>
				<img loading="lazy" src="<?php echo esc_url( $icon ); ?>" class="benefits__icon" width="70" height="70" alt="<?php echo esc_attr( $title ); ?>" aria-hidden="true">
				<?php endif; ?>
				<?php if ( $title !== '' ) : ?>
				<span class="benefits__title"><?php echo esc_html( $title ); ?></span>
				<?php endif; ?>
				<?php if ( $text !== '' ) : ?>
				<span class="benefits__text"><?php echo esc_html( $text ); ?></span>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

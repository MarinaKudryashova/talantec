<?php

add_filter('post_gallery', 'custom_gallery_output', 10, 2);
function custom_gallery_output( $output, $attr ){
	static $gallery_counter = 0;
	$gallery_counter++;

	$ids_arr = explode(',', $attr['ids']);
	$ids_arr = array_map('trim', $ids_arr );

	$pictures = get_posts( array(
		'posts_per_page' => -1,
		'post__in'       => $ids_arr,
		'post_type'      => 'attachment',
		'orderby'        => 'post__in'
	) );

	if( ! $pictures ) return 'Запрос вернул пустой результат.';
	$cols = $attr['columns'];
	$out = '<div class="gallery-layout gallery-layout--'. $cols .'" style="--columns: '. $cols .'">';
	foreach( $pictures as $pic ){
		$src = $pic->guid;
		$t = esc_attr( $pic->post_title );
		$title = ( $t && false === strpos($src, $t)  ) ? $t : '';

		$out .= '<div class="gallery-layout__item"><a data-fslightbox="gallery-'. $gallery_counter .'" data-caption="" href="'.$src.'" class="gallery-layout__link"><img loading="lazy" class="gallery-layout__img" src="'. $src .'" width="318" height="198" alt="'.$title.'" /></a></div>';
	}
	$out .= '</div>';

	return $out;
}
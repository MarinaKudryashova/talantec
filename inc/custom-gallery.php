<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'post_gallery', 'custom_gallery_output', 10, 2 );
add_filter( 'render_block_core/gallery', 'architect_render_core_gallery_block', 10, 2 );
add_filter( 'use_default_gallery_style', '__return_false' );
add_action( 'enqueue_block_editor_assets', 'architect_enqueue_gallery_editor_assets' );

/**
 * Classic [gallery] shortcode → theme markup.
 *
 * @param string $output Default output.
 * @param array  $attr   Shortcode attributes.
 * @return string
 */
function custom_gallery_output( $output, $attr ) {
	if ( empty( $attr['ids'] ) ) {
		return $output;
	}

	$ids  = array_filter( array_map( 'absint', explode( ',', $attr['ids'] ) ) );
	$cols = isset( $attr['columns'] ) ? absint( $attr['columns'] ) : 3;
	$size = ! empty( $attr['size'] ) ? $attr['size'] : 'medium';

	if ( architect_post_has_core_gallery_with_ids( $ids ) ) {
		return "\n";
	}

	return architect_render_gallery_layout(
		$ids,
		array(
			'columns' => $cols,
			'size'    => $size,
		)
	);
}

/**
 * Native core/gallery block → the same theme markup.
 *
 * @param string $block_content Block HTML.
 * @param array  $block         Parsed block.
 * @return string
 */
function architect_render_core_gallery_block( $block_content, $block ) {
	$ids = architect_gallery_block_ids( $block, $block_content );
	if ( ! $ids ) {
		return $block_content;
	}

	$attrs = isset( $block['attrs'] ) && is_array( $block['attrs'] ) ? $block['attrs'] : array();
	$cols  = ! empty( $attrs['columns'] ) ? absint( $attrs['columns'] ) : 3;
	$size  = ! empty( $attrs['sizeSlug'] ) ? $attrs['sizeSlug'] : 'medium';

	return architect_render_gallery_layout(
		$ids,
		array(
			'columns' => $cols,
			'size'    => $size,
		)
	);
}

/**
 * Attachment IDs from a core/gallery block (nested images, legacy ids, or HTML).
 *
 * @param array  $block         Parsed block.
 * @param string $block_content Rendered block HTML.
 * @return int[]
 */
function architect_gallery_block_ids( $block, $block_content = '' ) {
	$ids = array();

	if ( ! empty( $block['innerBlocks'] ) && is_array( $block['innerBlocks'] ) ) {
		foreach ( $block['innerBlocks'] as $inner ) {
			if ( ( $inner['blockName'] ?? '' ) !== 'core/image' ) {
				continue;
			}
			if ( ! empty( $inner['attrs']['id'] ) ) {
				$ids[] = (int) $inner['attrs']['id'];
			}
		}
	}

	if ( ! $ids && ! empty( $block['attrs']['ids'] ) ) {
		$ids = array_map( 'absint', (array) $block['attrs']['ids'] );
	}

	if ( ! $ids && is_string( $block_content ) && $block_content !== '' ) {
		if ( preg_match_all( '/wp-image-(\d+)/', $block_content, $matches ) ) {
			$ids = array_map( 'absint', $matches[1] );
		}
	}

	return array_values( array_filter( $ids ) );
}

/**
 * True when the current post already has a core/gallery with the same attachments.
 * Prevents a leftover [gallery] shortcode from rendering next to the block.
 *
 * @param int[] $ids Attachment IDs.
 * @return bool
 */
function architect_post_has_core_gallery_with_ids( $ids ) {
	$post = get_post();
	if ( ! $post || empty( $post->post_content ) || ! has_block( 'core/gallery', $post ) ) {
		return false;
	}

	$want = array_values( array_filter( array_map( 'absint', (array) $ids ) ) );
	sort( $want );
	if ( ! $want ) {
		return false;
	}

	foreach ( parse_blocks( $post->post_content ) as $block ) {
		if ( ( $block['blockName'] ?? '' ) !== 'core/gallery' ) {
			continue;
		}
		$have = architect_gallery_block_ids( $block );
		sort( $have );
		if ( $have === $want ) {
			return true;
		}
	}

	return false;
}

/**
 * Shared gallery markup: layout, webp picture, fslightbox group.
 *
 * @param int[] $ids  Attachment IDs in order.
 * @param array $args columns, size.
 * @return string
 */
function architect_render_gallery_layout( $ids, $args = array() ) {
	static $gallery_counter = 0;

	$ids = array_values( array_filter( array_map( 'absint', (array) $ids ) ) );
	if ( ! $ids ) {
		return '';
	}

	$args = wp_parse_args(
		$args,
		array(
			'columns' => 3,
			'size'    => 'medium',
		)
	);

	$columns = max( 1, min( 8, (int) $args['columns'] ) );
	$size    = sanitize_key( $args['size'] );
	if ( $size === '' ) {
		$size = 'medium';
	}

	$gallery_counter++;
	$post_id = get_the_ID();
	$group   = 'gallery-' . ( $post_id ? (int) $post_id . '-' : '' ) . $gallery_counter;
	$sizes   = architect_gallery_sizes_attr( $columns );

	$out = '<div class="gallery-layout gallery-layout--' . esc_attr( $columns ) . '" style="--columns: ' . esc_attr( $columns ) . '">';

	foreach ( $ids as $id ) {
		$item = architect_gallery_item_markup( $id, $size, $sizes, $group );
		if ( $item !== '' ) {
			$out .= $item;
		}
	}

	$out .= '</div>';

	return $out;
}

/**
 * sizes= matching .gallery-layout breakpoints.
 *
 * @param int $columns Desktop column count.
 * @return string
 */
function architect_gallery_sizes_attr( $columns ) {
	$columns       = max( 1, (int) $columns );
	$small_desktop = max( 1, $columns - 1 );
	$big_tablet    = max( 1, $columns - 2 );

	return sprintf(
		'(max-width: 576px) calc(100vw - 32px), (max-width: 970px) calc((100vw - 48px) / %1$d), (max-width: 1280px) calc((min(100vw, 1280px) - 64px) / %2$d), calc((min(100vw, 1440px) - 80px) / %3$d)',
		$big_tablet,
		$small_desktop,
		$columns
	);
}

/**
 * Prefer a full srcset so thumbs can pick retina / wider slots.
 *
 * @param int    $id   Attachment ID.
 * @param string $size Requested size (fallback).
 * @return string
 */
function architect_gallery_attachment_srcset( $id, $size ) {
	$id = (int) $id;

	$srcset = wp_get_attachment_image_srcset( $id, 'full' );
	if ( is_string( $srcset ) && $srcset !== '' ) {
		return $srcset;
	}

	$srcset = wp_get_attachment_image_srcset( $id, $size );
	if ( is_string( $srcset ) && $srcset !== '' ) {
		return $srcset;
	}

	return '';
}

/**
 * Map a srcset string to webp-converter URLs.
 *
 * @param string $srcset Original srcset.
 * @return string
 */
function architect_gallery_srcset_to_webp( $srcset ) {
	if ( ! is_string( $srcset ) || $srcset === '' ) {
		return '';
	}

	$parts = array_map( 'trim', explode( ',', $srcset ) );
	$out   = array();

	foreach ( $parts as $part ) {
		if ( ! preg_match( '/^(\S+)(\s+.+)?$/', $part, $m ) ) {
			continue;
		}
		$webp = architect_webp_url( $m[1] );
		if ( $webp ) {
			$out[] = $webp . ( isset( $m[2] ) ? $m[2] : '' );
		}
	}

	return implode( ', ', $out );
}

/**
 * One gallery cell: picture + zoom + lightbox link.
 *
 * @param int    $id    Attachment ID.
 * @param string $size  WP size for the fallback src.
 * @param string $sizes sizes attribute.
 * @param string $group fslightbox group name.
 * @return string
 */
function architect_gallery_item_markup( $id, $size, $sizes, $group ) {
	$id  = (int) $id;
	$src = wp_get_attachment_image_src( $id, $size );
	if ( ! $src ) {
		$src = wp_get_attachment_image_src( $id, 'full' );
	}
	if ( ! $src ) {
		return '';
	}

	$full = wp_get_attachment_image_url( $id, 'full' );
	if ( ! $full ) {
		$full = $src[0];
	}

	$alt = (string) get_post_meta( $id, '_wp_attachment_image_alt', true );
	if ( $alt === '' ) {
		$attachment = get_post( $id );
		$alt        = $attachment ? (string) $attachment->post_title : '';
	}

	$caption = wp_get_attachment_caption( $id );
	$srcset  = architect_gallery_attachment_srcset( $id, $size );
	$webp_ss = architect_gallery_srcset_to_webp( $srcset );
	if ( $webp_ss === '' ) {
		$single_webp = architect_webp_url( $src[0] );
		if ( $single_webp ) {
			$webp_ss = $single_webp;
		}
	}

	$mime = get_post_mime_type( $id );
	if ( ! is_string( $mime ) || $mime === '' ) {
		$mime = 'image/jpeg';
	}

	$skip_webp = in_array( $mime, array( 'image/svg+xml', 'image/gif' ), true );
	$width     = (int) $src[1];
	$height    = (int) $src[2];

	$picture = '<picture class="gallery-layout__picture">';
	if ( ! $skip_webp && $webp_ss ) {
		$picture .= '<source type="image/webp" srcset="' . esc_attr( $webp_ss ) . '" sizes="' . esc_attr( $sizes ) . '">';
	}
	if ( $srcset ) {
		$picture .= '<source type="' . esc_attr( $mime ) . '" srcset="' . esc_attr( $srcset ) . '" sizes="' . esc_attr( $sizes ) . '">';
	}
	$picture .= '<img class="gallery-layout__img" src="' . esc_url( $src[0] ) . '"';
	if ( $srcset ) {
		$picture .= ' srcset="' . esc_attr( $srcset ) . '" sizes="' . esc_attr( $sizes ) . '"';
	}
	if ( $width ) {
		$picture .= ' width="' . esc_attr( $width ) . '"';
	}
	if ( $height ) {
		$picture .= ' height="' . esc_attr( $height ) . '"';
	}
	$picture .= ' alt="' . esc_attr( $alt ) . '" loading="lazy" decoding="async">';
	$picture .= '</picture>';

	$html  = '<div class="gallery-layout__item">';
	$html .= '<a class="gallery-layout__link gallery-zoom" data-fslightbox="' . esc_attr( $group ) . '" data-caption="' . esc_attr( $caption ? $caption : '' ) . '" href="' . esc_url( $full ) . '">';
	$html .= $picture;
	$html .= architect_gallery_zoom_icon();
	$html .= '</a></div>';

	return $html;
}

/**
 * Overlay icon for lightbox gallery links.
 *
 * @return string
 */
function architect_gallery_zoom_icon() {
	return '<span class="gallery-zoom__icon" aria-hidden="true"><svg width="32" height="32" focusable="false"><use xlink:href="' . esc_url( get_template_directory_uri() . '/img/sprite.svg#zoom-in' ) . '"></use></svg></span>';
}

/**
 * Gutenberg canvas: same crop / gap as frontend gallery-layout.
 */
function architect_enqueue_gallery_editor_assets() {
	$path = get_template_directory() . '/inc/editor-gallery.css';
	$uri  = get_template_directory_uri() . '/inc/editor-gallery.css';
	$ver  = file_exists( $path ) ? (string) filemtime( $path ) : _S_VERSION;

	wp_enqueue_style( 'architect-editor-gallery', $uri, array(), $ver );
}

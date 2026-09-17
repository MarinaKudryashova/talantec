<?php
/**
 * Image versions and <picture> helpers.
 *
 * @package architect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build a webp-converter URL for an uploads file.
 *
 * @param string $image_url Original image URL.
 * @return string
 */
function architect_webp_url( $image_url ) {
	if ( ! is_string( $image_url ) || $image_url === '' ) {
		return '';
	}

	$pathinfo  = pathinfo( $image_url );
	$filename  = $pathinfo['filename'] ?? '';
	$extension = $pathinfo['extension'] ?? 'jpg';
	$directory = $pathinfo['dirname'] ?? '';

	if ( $filename === '' || $directory === '' ) {
		return '';
	}

	return str_replace( '/uploads/', '/uploads-webpc/uploads/', $directory ) . '/' . $filename . '.' . $extension . '.webp';
}

/**
 * Resolve attachment ID from mixed ACF / WP image value.
 *
 * @param mixed $image ID, URL, or ACF array.
 * @return int
 */
function architect_get_image_id( $image ) {
	if ( is_numeric( $image ) ) {
		return (int) $image;
	}

	if ( is_array( $image ) ) {
		return (int) ( $image['ID'] ?? $image['id'] ?? 0 );
	}

	if ( is_string( $image ) && $image !== '' ) {
		$id = attachment_url_to_postid( $image );
		if ( $id ) {
			return (int) $id;
		}
	}

	return 0;
}

/**
 * Universal helper: get 1x / webp versions for an image.
 *
 * @param mixed       $image       Attachment ID, URL, or ACF array.
 * @param string      $size        WordPress size (thumbnail, medium, large, full).
 * @param string|bool $size_suffix Retina suffix, or false to skip 2x.
 * @return array
 */
function get_image_versions( $image, $size = 'full', $size_suffix = false ) {
	$image_url = '';
	$image_id  = architect_get_image_id( $image );

	if ( $image_id ) {
		$sized = wp_get_attachment_image_url( $image_id, $size );
		if ( $sized ) {
			$image_url = $sized;
		}
	} elseif ( is_array( $image ) && isset( $image['url'] ) ) {
		$image_url = $image['url'];
		if ( $size !== 'full' && ! empty( $image['sizes'][ $size ] ) ) {
			$image_url = $image['sizes'][ $size ];
		}
	} elseif ( is_string( $image ) ) {
		$image_url = $image;
	}

	if ( empty( $image_url ) ) {
		return array();
	}

	$pathinfo  = pathinfo( $image_url );
	$extension = strtolower( $pathinfo['extension'] ?? 'jpg' );
	$supported = array( 'jpg', 'jpeg', 'png', 'webp' );

	$alt_text = '';
	if ( $image_id ) {
		$alt_text = (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	} elseif ( is_array( $image ) && isset( $image['alt'] ) ) {
		$alt_text = (string) $image['alt'];
	}

	if ( ! in_array( $extension, $supported, true ) ) {
		return array(
			'original_1x'     => $image_url,
			'webp_1x'         => '',
			'original_2x'     => '',
			'webp_2x'         => '',
			'medium_original' => $image_url,
			'medium_webp'     => '',
			'alt'             => $alt_text,
			'format'          => $extension,
			'id'              => $image_id,
			'size'            => $size,
		);
	}

	$original_1x = $image_url;
	$webp_1x     = architect_webp_url( $image_url );
	$original_2x = '';
	$webp_2x     = '';

	if ( ! empty( $size_suffix ) ) {
		$directory   = $pathinfo['dirname'] ?? '';
		$filename    = $pathinfo['filename'] ?? '';
		$original_2x = $directory . '/' . $filename . $size_suffix . '.' . $extension;
		$webp_2x     = architect_webp_url( $original_2x );
	}

	$medium_original = $original_1x;
	$medium_webp     = $webp_1x;

	if ( $size !== 'medium' && $image_id ) {
		$medium_url = wp_get_attachment_image_url( $image_id, 'medium' );
		if ( $medium_url ) {
			$medium_original = $medium_url;
			$medium_webp     = architect_webp_url( $medium_url );
		}
	} elseif ( $size !== 'medium' && is_array( $image ) && ! empty( $image['sizes']['medium'] ) ) {
		$medium_original = $image['sizes']['medium'];
		$medium_webp     = architect_webp_url( $medium_original );
	}

	return array(
		'original_1x'     => $original_1x,
		'webp_1x'         => $webp_1x,
		'original_2x'     => $original_2x,
		'webp_2x'         => $webp_2x,
		'medium_original' => $medium_original,
		'medium_webp'     => $medium_webp,
		'alt'             => $alt_text,
		'format'          => $extension,
		'id'              => $image_id,
		'size'            => $size,
	);
}

/**
 * Mobile image versions: ACF mobile field, or a smaller WP size of the desktop image.
 *
 * @param mixed  $mobile_image  Optional ACF mobile/tablet image.
 * @param mixed  $desktop_image Fallback desktop image.
 * @param string $size          WordPress size for fallback and ACF mobile crop.
 * @return array
 */
function architect_get_mobile_image_versions( $mobile_image, $desktop_image = null, $size = 'medium' ) {
	if ( ! empty( $mobile_image ) ) {
		$versions = get_image_versions( $mobile_image, $size, false );
		if ( ! empty( $versions['original_1x'] ) ) {
			return $versions;
		}
	}

	if ( ! empty( $desktop_image ) ) {
		return get_image_versions( $desktop_image, $size, false );
	}

	return array();
}

/**
 * Print <source> tags for the mobile breakpoint (max-width: 576px).
 *
 * @param array $versions Image versions (mobile set, or desktop set with medium_* keys).
 * @return void
 */
function architect_picture_mobile_sources( $versions ) {
	if ( empty( $versions ) || ! is_array( $versions ) ) {
		return;
	}

	$size = $versions['size'] ?? 'full';
	if ( $size !== 'full' ) {
		$original = $versions['original_1x'] ?? '';
		$webp     = $versions['webp_1x'] ?? '';
	} else {
		$original = ! empty( $versions['medium_original'] ) ? $versions['medium_original'] : ( $versions['original_1x'] ?? '' );
		$webp     = ! empty( $versions['medium_webp'] ) ? $versions['medium_webp'] : ( $versions['webp_1x'] ?? '' );
	}
	$format   = strtolower( $versions['format'] ?? 'jpg' );
	$mime     = ( $format === 'png' ) ? 'image/png' : 'image/jpeg';

	if ( empty( $original ) ) {
		return;
	}

	if ( ! empty( $webp ) ) {
		printf(
			'<source media="(max-width: 576px)" srcset="%s" type="image/webp">' . "\n",
			esc_url( $webp )
		);
	}

	printf(
		'<source media="(max-width: 576px)" srcset="%s" type="%s">' . "\n",
		esc_url( $original ),
		esc_attr( $mime )
	);
}

/**
 * Output a picture element.
 *
 * @param array $sources Image versions from get_image_versions().
 * @param array $attrs   Attributes for the img tag. Optional 'mobile' versions array.
 * @return void
 */
function the_picture_element( $sources, $attrs = array() ) {
	if ( empty( $sources['original_1x'] ) ) {
		return;
	}

	$default_attrs = array(
		'width'         => '',
		'height'        => '',
		'alt'           => $sources['alt'] ?? '',
		'loading'       => 'lazy',
		'decoding'      => 'async',
		'fetchpriority' => 'auto',
		'class'         => '',
		'mobile'        => array(),
	);

	$attrs   = wp_parse_args( $attrs, $default_attrs );
	$mobile  = ! empty( $attrs['mobile'] ) ? $attrs['mobile'] : $sources;
	$has_2x  = ! empty( $sources['original_2x'] ) && ! empty( $sources['webp_2x'] );
	$format  = $sources['format'] ?? 'jpg';
	$mime    = ( $format === 'png' ) ? 'image/png' : 'image/jpeg';

	if ( $attrs['loading'] === 'eager' ) {
		$attrs['decoding']      = 'async';
		$attrs['fetchpriority'] = 'high';
	} else {
		unset( $attrs['fetchpriority'] );
		$attrs['decoding'] = 'async';
	}
	?>
	<picture class="picture-element <?php echo esc_attr( $attrs['class'] ); ?>">
		<?php architect_picture_mobile_sources( $mobile ); ?>
		<?php if ( ! empty( $sources['webp_1x'] ) ) : ?>
			<source srcset="<?php echo esc_url( $sources['webp_1x'] ); ?><?php echo $has_2x ? ', ' . esc_url( $sources['webp_2x'] ) . ' 2x' : ''; ?>" type="image/webp">
		<?php endif; ?>
		<source srcset="<?php echo esc_url( $sources['original_1x'] ); ?><?php echo $has_2x ? ', ' . esc_url( $sources['original_2x'] ) . ' 2x' : ''; ?>" type="<?php echo esc_attr( $mime ); ?>">
		<img src="<?php echo esc_url( $sources['original_1x'] ); ?>"
			<?php if ( $has_2x ) : ?>
			srcset="<?php echo esc_url( $sources['original_2x'] ); ?> 2x"
			<?php endif; ?>
			width="<?php echo esc_attr( $attrs['width'] ); ?>"
			height="<?php echo esc_attr( $attrs['height'] ); ?>"
			alt="<?php echo esc_attr( $attrs['alt'] ); ?>"
			loading="<?php echo esc_attr( $attrs['loading'] ); ?>"
			decoding="<?php echo esc_attr( $attrs['decoding'] ); ?>"
			<?php if ( $attrs['loading'] === 'eager' ) : ?>
			fetchpriority="<?php echo esc_attr( $attrs['fetchpriority'] ); ?>"
			<?php endif; ?>
			class="<?php echo esc_attr( $attrs['class'] ); ?>">
	</picture>
	<?php
}

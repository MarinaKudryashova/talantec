<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package architect
 */

architect_get_header();

$error_title          = get_theme_mod( 'error_404_title', '404' );
$error_text           = get_theme_mod( 'error_404_text', 'Страница не найдена' );
$error_background_url = get_theme_mod( 'error_404_background' );
$button_text          = get_theme_mod( 'error_404_button_text', 'На главную' );
$button_page_id       = get_theme_mod( 'error_404_button_page', 0 );
$button_custom_url    = get_theme_mod( 'error_404_button_url', '' );
$sprite_url           = get_template_directory_uri() . '/img/sprite.svg#icon-arrow-diagonal';

$error_background = ( ! empty( $error_background_url ) && function_exists( 'get_image_versions' ) )
	? get_image_versions( $error_background_url, 'full', false )
	: array();

$error_background_mobile = ( ! empty( $error_background['original_1x'] ) && function_exists( 'architect_get_mobile_image_versions' ) )
	? architect_get_mobile_image_versions( null, $error_background_url, 'large' )
	: array();

if ( empty( $error_background_mobile['original_1x'] ) ) {
	$error_background_mobile = $error_background;
}

if ( $button_page_id && get_post( $button_page_id ) ) {
	$button_url = get_permalink( $button_page_id );
} elseif ( $button_custom_url ) {
	$button_url = $button_custom_url;
} else {
	$button_url = home_url( '/' );
}
?>

<main class="main">
	<section class="error-404 not-found" aria-label="<?php esc_attr_e( 'Страница не найдена', 'architect' ); ?>">
		<div class="error-404__container container">
			<div class="error-404__content">
				<h1 class="error-404__title">
					<span>404</span>
					<?php if ( $error_title && $error_title !== '404' ) : ?>
						<?php echo esc_html( $error_title ); ?>
					<?php endif; ?>
				</h1>

				<?php if ( $error_text ) : ?>
				<p class="error-404__text"><?php echo esc_html( $error_text ); ?></p>
				<?php endif; ?>

				<?php if ( $button_text && $button_url ) : ?>
				<a href="<?php echo esc_url( $button_url ); ?>" class="error-404__link ui-btn-arrow">
					<span class="ui-btn-arrow__text"><?php echo esc_html( $button_text ); ?></span>
					<span class="ui-btn-arrow__arrow">
						<span class="ui-arrow">
							<svg class="ui-arrow__svg" aria-hidden="true">
								<use xlink:href="<?php echo esc_url( $sprite_url ); ?>"></use>
							</svg>
							<svg class="ui-arrow__svg ui-arrow__svg--copy" aria-hidden="true">
								<use xlink:href="<?php echo esc_url( $sprite_url ); ?>"></use>
							</svg>
						</span>
					</span>
				</a>
				<?php endif; ?>
			</div>
		</div>

		<div class="error-404__bg">
			<?php if ( ! empty( $error_background['original_1x'] ) ) : ?>
			<picture class="error-404__img">
				<?php architect_picture_mobile_sources( $error_background_mobile ); ?>
				<?php if ( ! empty( $error_background['webp_1x'] ) ) : ?>
				<source srcset="<?php echo esc_url( $error_background['webp_1x'] ); ?>" type="image/webp">
				<?php endif; ?>
				<img
					src="<?php echo esc_url( $error_background['original_1x'] ); ?>"
					width="1440"
					height="800"
					aria-hidden="true"
					alt=""
					loading="eager"
					decoding="async"
					fetchpriority="high"
				>
			</picture>
			<?php endif; ?>
			<div class="error-404__filter"></div>
		</div>
	</section>
</main>

<?php
architect_get_footer();

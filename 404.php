<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package apartner
 */

architect_get_header();
?>
<?php
$error_title = get_theme_mod( 'error_404_title', '404' );
$error_text = get_theme_mod( 'error_404_text', 'Страница не найдена' );
$error_background_url = get_theme_mod( 'error_404_background' );
$error_background = (!empty($error_background_url)) ? get_image_versions($error_background_url) : null;
$button_text = get_theme_mod( 'error_404_button_text', 'На главную' );

$button_page_id = get_theme_mod( 'error_404_button_page', 0 );
$button_custom_url = get_theme_mod( 'error_404_button_url', '' );

if ( $button_page_id && get_post( $button_page_id ) ) {
	$button_url = get_permalink( $button_page_id );
} elseif ( $button_custom_url ) {
	$button_url = esc_url( $button_custom_url );
} else {
	$button_url = home_url( '/' );
}

?>

	<main class="main">
		<section class="error-404 not-found">
			<div class="container">
				<?php if($error_background && is_array($error_background)) : ?>
					<picture class="error-404__img">
						<source srcset="<?php echo esc_url($error_background['webp_1x']); ?>" type="image/webp">
						<img src="<?php echo esc_url($error_background['original_1x']); ?>" width="576" height="330" aria-hidden="true" alt="Ошибка 404">
					</picture>
				<?php endif; ?>

				<div class="error-404__content">
					<?php if($error_title) : ?>
						<h1 class="error-404__title"><?php echo esc_html( $error_title ); ?></h1>
					<?php endif; ?>

					<?php if($error_text) : ?>
						<p class="error-404__decr"><?php echo esc_html( $error_text ); ?></p>
					<?php endif; ?>
				</div>

				<?php if($button_text && $button_url) : ?>
					<a href="<?php echo esc_url( $button_url ); ?>" class="error-404__link ui-btn-arrow"><?php echo esc_html( $button_text ); ?></a>
				<?php endif; ?>
			</div>
		</section>
	</main>

<?php
architect_get_footer();

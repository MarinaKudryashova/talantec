<?php
/**
 * Popup lead form modal (CF7 + GraphModal).
 *
 * @package architect
 */

$label           = get_field( 'modal-leadform_label', 'option' );
$title           = get_field( 'modal-leadform_title', 'option' );
$text            = get_field( 'modal-leadform_text', 'option' );
$form_shortcode  = get_field( 'modal-leadform_shortcode', 'option' );
$success_title   = get_field( 'modal-leadform_success_title', 'option' );
$success_text    = get_field( 'modal-leadform_success_text', 'option' );
$error_title     = get_field( 'modal-leadform_error_title', 'option' );
$error_text      = get_field( 'modal-leadform_error_text', 'option' );
$sprite          = get_template_directory_uri() . '/img/sprite.svg#icon-close';

if ( empty( $title ) && empty( $form_shortcode ) ) {
	return;
}

if ( empty( $success_title ) ) {
	$success_title = __( 'Спасибо', 'architect' );
}
if ( empty( $success_text ) ) {
	$success_text = __( 'Ваши данные успешно отправлены. Скоро свяжемся с вами!', 'architect' );
}
if ( empty( $error_title ) ) {
	$error_title = __( 'Ошибка', 'architect' );
}
if ( empty( $error_text ) ) {
	$error_text = __( 'Форма не отправлена. Пожалуйста, проверьте правильность заполнения формы', 'architect' );
}
?>
<div class="graph-modal">
  <div class="graph-modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-leadform-title" tabindex="-1" data-graph-target="modal-leadform">
    <button class="btn-reset js-modal-close graph-modal__close" type="button" aria-label="<?php esc_attr_e( 'Закрыть модальное окно', 'architect' ); ?>">
      <svg aria-hidden="true" width="24" height="24">
        <use xlink:href="<?php echo esc_url( $sprite ); ?>"></use>
      </svg>
    </button>
    <div class="graph-modal__content form">
      <div class="graph-modal__heading">
        <?php if ( ! empty( $label ) ) : ?>
        <p class="sec-title"><?php echo esc_html( $label ); ?></p>
        <?php endif; ?>
        <?php if ( ! empty( $title ) ) : ?>
        <h2 class="graph-modal__title" id="modal-leadform-title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        <?php if ( ! empty( $text ) ) : ?>
        <p class="graph-modal__descr"><?php echo wp_kses_post( $text ); ?></p>
        <?php endif; ?>
      </div>
      <?php if ( ! empty( $form_shortcode ) ) : ?>
      <div class="graph-modal__form">
        <?php echo do_shortcode( $form_shortcode ); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="graph-modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-send-title" tabindex="-1" data-graph-target="modal-send">
    <button class="btn-reset js-modal-close graph-modal__close" type="button" aria-label="<?php esc_attr_e( 'Закрыть модальное окно', 'architect' ); ?>">
      <svg aria-hidden="true" width="24" height="24">
        <use xlink:href="<?php echo esc_url( $sprite ); ?>"></use>
      </svg>
    </button>
    <div class="graph-modal__content modal-message">
      <h3 class="modal-message__title" id="modal-send-title"><?php echo esc_html( $success_title ); ?></h3>
      <?php if ( ! empty( $success_text ) ) : ?>
      <p class="modal-message__text"><?php echo wp_kses_post( $success_text ); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <div class="graph-modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-failed-title" tabindex="-1" data-graph-target="modal-failed">
    <button class="btn-reset js-modal-close graph-modal__close" type="button" aria-label="<?php esc_attr_e( 'Закрыть модальное окно', 'architect' ); ?>">
      <svg aria-hidden="true" width="24" height="24">
        <use xlink:href="<?php echo esc_url( $sprite ); ?>"></use>
      </svg>
    </button>
    <div class="graph-modal__content modal-message">
      <h3 class="modal-message__title" id="modal-failed-title"><?php echo esc_html( $error_title ); ?></h3>
      <?php if ( ! empty( $error_text ) ) : ?>
      <p class="modal-message__text"><?php echo wp_kses_post( $error_text ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>

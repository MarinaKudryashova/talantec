<?php
/**
 * Cookie notice
 *
 * @package architect
 */

$cookie_text = get_field( 'cookie_text', 'option' );
if ( empty( $cookie_text ) ) {
	$cookie_text = __( 'Мы используем необходимые cookie, чтобы сайт работал. Аналитику подключаем только с вашего согласия.', 'architect' );
}

$cookie_btn = get_field( 'cookie_btn_text', 'option' );
if ( empty( $cookie_btn ) || stripos( $cookie_btn, 'Разрешить' ) !== false ) {
	$cookie_btn = __( 'Принять', 'architect' );
}

$cookie_decline = get_field( 'cookie_btn_decline_text', 'option' );
if ( empty( $cookie_decline ) ) {
	$cookie_decline = __( 'Только необходимые', 'architect' );
}

$cookie_more = get_field( 'cookie_btn_more_text', 'option' );
if ( empty( $cookie_more ) ) {
	$cookie_more = __( 'Подробнее', 'architect' );
}

$cookie_policy_url = get_field( 'cookie_policy_url', 'option' );
if ( is_array( $cookie_policy_url ) && ! empty( $cookie_policy_url['url'] ) ) {
	$cookie_policy_url = $cookie_policy_url['url'];
}
if ( empty( $cookie_policy_url ) ) {
	$cookie_page = get_page_by_path( 'cookie-policy' );
	if ( ! $cookie_page instanceof WP_Post ) {
		$cookie_page = get_page_by_path( 'politika-ispolzovaniya-cookie' );
	}
	if ( ! $cookie_page instanceof WP_Post ) {
		$found = get_posts(
			array(
				'post_type'              => 'page',
				'post_status'            => 'publish',
				'posts_per_page'         => 1,
				'title'                  => 'Политика использования cookie',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			)
		);
		$cookie_page = ! empty( $found ) ? $found[0] : null;
	}
	$cookie_policy_url = $cookie_page instanceof WP_Post
		? get_permalink( $cookie_page )
		: home_url( '/cookie-policy/' );
}

$allowed_html = array(
	'a'      => array(
		'href'   => array(),
		'title'  => array(),
		'target' => array(),
		'rel'    => array(),
	),
	'p'      => array(),
	'br'     => array(),
	'strong' => array(),
	'em'     => array(),
);
?>
<div id="cookie-notice" class="cookie-notice" role="dialog" aria-live="polite" aria-label="<?php esc_attr_e( 'Уведомление об использовании cookie', 'architect' ); ?>">
  <div class="cookie-notice__container">
    <div class="cookie-notice__text"><?php echo wp_kses( $cookie_text, $allowed_html ); ?></div>
    <div class="cookie-notice__actions">
      <button type="button" id="cookie-accept" class="cookie-notice__btn cookie-notice__btn--accept"><?php echo esc_html( $cookie_btn ); ?></button>
      <button type="button" id="cookie-decline" class="cookie-notice__btn cookie-notice__btn--decline"><?php echo esc_html( $cookie_decline ); ?></button>
      <a href="<?php echo esc_url( $cookie_policy_url ); ?>" class="cookie-notice__btn cookie-notice__btn--more"><?php echo esc_html( $cookie_more ); ?></a>
    </div>
  </div>
</div>

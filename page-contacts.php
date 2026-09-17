<?php
/**
 * Template Name: Контакты
 * Template Post Type: page
 *
 * @package architect
 */

$page_id = get_the_ID();

$company_name = get_theme_mod( 'company_name', '' );
$company_inn  = get_theme_mod( 'company_inn', '' );
$company_ogrn = get_theme_mod( 'company_ogrn', '' );
$phone        = get_theme_mod( 'company_phone', '+7 (999) 123-45-67' );
$email        = get_theme_mod( 'company_email', 'info@architect.ru' );
$address      = get_theme_mod( 'company_address', 'г. Москва, ул. Примерная, д. 123' );
$hours        = get_theme_mod( 'company_hours', 'пн–пт 8:00–17:00' );
$phone_clean  = $phone ? preg_replace( '/[^0-9+]/', '', $phone ) : '';
$map_lat      = get_theme_mod( 'company_map_lat', '55.8184' );
$map_lng      = get_theme_mod( 'company_map_lng', '37.5002' );
$map_zoom     = absint( get_theme_mod( 'company_map_zoom', 16 ) );

architect_get_header();
?>
<main class="main main--no-bg" itemscope itemtype="https://schema.org/ContactPage">
  <section class="page-contacts" itemscope itemtype="https://schema.org/LocalBusiness">
    <meta itemprop="name" content="<?php echo esc_attr( $company_name ? $company_name : get_bloginfo( 'name' ) ); ?>">
    <div class="page-contacts__container container">
      <?php get_template_part( 'template-parts/components/breadcrumbs', '', $page_id ); ?>

      <h1 class="page-contacts__title"><?php echo esc_html( get_the_title( $page_id ) ); ?></h1>

      <ul class="page-contacts__list">
        <?php if ( $address ) : ?>
        <li class="page-contacts__item">
          <span class="page-contacts__label"><?php esc_html_e( 'Адрес', 'architect' ); ?></span>
          <p class="page-contacts__value" itemprop="address"><?php echo esc_html( $address ); ?></p>
        </li>
        <?php endif; ?>

        <?php if ( $phone ) : ?>
        <li class="page-contacts__item">
          <span class="page-contacts__label"><?php esc_html_e( 'Телефон', 'architect' ); ?></span>
          <a class="page-contacts__value page-contacts__value--link" href="tel:<?php echo esc_attr( $phone_clean ); ?>" itemprop="telephone"><?php echo esc_html( $phone ); ?></a>
        </li>
        <?php endif; ?>

        <?php if ( $company_name || $company_inn || $company_ogrn ) : ?>
        <li class="page-contacts__item page-contacts__item--requisites">
          <span class="page-contacts__label"><?php esc_html_e( 'Реквизиты', 'architect' ); ?></span>
          <div class="page-contacts__value page-contacts__value--stack">
            <?php if ( $company_name ) : ?>
            <span><?php echo esc_html( $company_name ); ?></span>
            <?php endif; ?>
            <?php if ( $company_inn ) : ?>
            <span><?php esc_html_e( 'ИНН', 'architect' ); ?> <span itemprop="taxID"><?php echo esc_html( $company_inn ); ?></span></span>
            <?php endif; ?>
            <?php if ( $company_ogrn ) : ?>
            <span><?php esc_html_e( 'ОГРН', 'architect' ); ?> <?php echo esc_html( $company_ogrn ); ?></span>
            <?php endif; ?>
          </div>
        </li>
        <?php endif; ?>

        <?php if ( $hours ) : ?>
        <li class="page-contacts__item">
          <span class="page-contacts__label"><?php esc_html_e( 'График работы', 'architect' ); ?></span>
          <p class="page-contacts__value" itemprop="openingHours"><?php echo esc_html( $hours ); ?></p>
        </li>
        <?php endif; ?>

        <?php if ( $email ) : ?>
        <li class="page-contacts__item">
          <span class="page-contacts__label"><?php esc_html_e( 'Почта', 'architect' ); ?></span>
          <a class="page-contacts__value page-contacts__value--link" href="mailto:<?php echo esc_attr( $email ); ?>" itemprop="email"><?php echo esc_html( $email ); ?></a>
        </li>
        <?php endif; ?>
      </ul>
    </div>

    <div
      class="page-contacts__map"
      id="contacts-map"
      role="region"
      aria-label="<?php esc_attr_e( 'Карта проезда', 'architect' ); ?>"
      data-center="<?php echo esc_attr( $map_lat . ',' . $map_lng ); ?>"
      data-zoom="<?php echo esc_attr( $map_zoom ); ?>"
      data-address="<?php echo esc_attr( $address ); ?>"
    ></div>
  </section>
</main>
<?php architect_get_footer(); ?>

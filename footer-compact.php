<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package architect
 */

$company_name = get_theme_mod('company_name', '');
$company_ogrn = get_theme_mod('company_ogrn', '');
$company_inn = get_theme_mod('company_inn', '');
?>
    <footer class="footer footer--compact">
      <div class="footer__top">
        <div class="footer__container container">
          <div class="footer__row">
            <?php 
              $footer_logo = get_theme_mod('site_logo');
              if ( $footer_logo ) : ?>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo footer__col-3">
                <?php if ( $footer_logo ) : ?>
                  <img src="<?php echo esc_url( $footer_logo ); ?>" alt="Логотип <?php bloginfo('name'); ?>" width="256" height="59">
                <?php endif; ?>
              </a>
            <?php endif; ?>
            <div class="footer__contacts footer__col-9">
              <!-- Телефон -->
                <div class="footer__phone">
                  <span class="footer__contacts-title"><?php esc_html_e( 'Телефон', 'architect' ); ?></span>
                  <?php 
                  $phone = get_theme_mod('company_phone', '+7 (999) 123-45-67');
                  if ( $phone ) : 
                      $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
                  ?>
                    <a class="footer__contacts-link" href="tel:<?php echo esc_attr( $phone_clean ); ?>" data-text="<?php echo esc_attr( $phone ); ?>">
                      <?php echo esc_html( $phone ); ?>
                    </a>
                  <?php endif; ?>
                </div>
                
                <!-- Email -->
                <div class="footer__email">
                  <span class="footer__contacts-title"><?php esc_html_e( 'Почта', 'architect' ); ?></span>
                  <?php 
                  $email = get_theme_mod('company_email', 'info@architect.ru');
                  if ( $email ) : ?>
                    <a class="footer__contacts-link" href="mailto:<?php echo esc_attr( $email ); ?>" data-text="<?php echo esc_attr( $email ); ?>">
                      <?php echo esc_html( $email ); ?>
                    </a>
                  <?php endif; ?>
                </div>
                
                <!-- Адрес -->
                <div class="footer__address">
                  <span class="footer__contacts-title"><?php esc_html_e( 'Адрес', 'architect' ); ?></span>
                  <?php 
                  $address = get_theme_mod('company_address', 'г. Москва, ул. Примерная, д. 123');
                  if ( $address ) : ?>
                    <p class="footer__contacts-link footer__contacts-link--inactive">
                      <?php echo esc_html( $address ); ?>
                    </p>
                  <?php endif; ?>
                </div>

            </div>
          </div>
        </div>
      </div>
      <div class="footer__container container">
        <div class="footer__row">
          <div class="footer__info footer__col-3">
          <?php /*-- Название компании --*/ ?>
          <?php if($company_name) : ?>
          <span class="sec-contacts__caption" itemprop="name"><?php echo esc_html($company_name); ?></span>
          <? endif; ?>

          <?php /*-- Реквизиты --*/ ?>
          <?php if($company_ogrn) : ?>
          <span class="sec-contacts__text">ОГРН <span itemprop="taxID"><?php echo esc_html($company_ogrn); ?></span></span>
          <? endif; ?>
          <?php if($company_inn) : ?>
          <span class="sec-contacts__text">ИНН <span itemprop="taxID"><?php echo esc_html($company_inn); ?></span></span>
          <? endif; ?>
          </div>
          <div class="footer__content footer__col-9">
            <div class="footer-menu">
              <?php
                wp_nav_menu( [
                  'theme_location'  => 'header_compact',
                  'menu'            => 'header_compact',
                  'container'       => false,
                  'menu_class'      => false,
                  'menu_id'         => '',
                  'echo'            => true,
                  'fallback_cb'     => 'wp_page_menu',
                  'before'          => '',
                  'after'           => '',
                  'link_before'     => '  ',
                  'link_after'      => '',
                  'items_wrap'      => '<ul class="footer-menu__list" data-menu>%3$s</ul>',
                  'depth'           => 1,
                  'walker'          => new Footer_Menu_Walker(),
                ] );
              ?>
            </div>
          </div>
        </div>

        <div class="footer__row footer__row--bottom">
          <p class="footer__company footer__col-3">
              <?php 
              $copyright = get_theme_mod('footer_copyright', '©2026 architect');
              $copyright = trim(preg_replace('/\s+/', ' ', $copyright));
              echo wp_kses_post( $copyright );
              ?>
          </p>
          <div class="footer__bottom-right footer__col-9">
            <a class="footer__policy" href="/privacy-policy" data-text="Политика конфиденциальности">Политика конфиденциальности</a>
            <p class="footer__made">Сделано в&#160;
              <a href="https://www.cosmo-design.com/" class="footer__made-link" target="_blank">Cosmo design</a>
            </p>
            <button class="footer__top-btn" type="button">
              <span class="footer__btn-text">Вернуться наверх</span>
              <svg class="footer__btn-icon" aria-hidden="true" width="24" height="24">
                <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-up"></use>
              </svg>
            </button>
          </div>
        </div>

      </div>

      <!-- Фон -->
      <div class="footer__bg footer-bg">
        <div class="footer-bg__horizontal"></div>
        <div class="footer-bg__vertical"></div>
      </div>
    </footer>

		<?php wp_footer(); ?>

  </div>
</body>

</html>


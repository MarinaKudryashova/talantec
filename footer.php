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

?>
    <footer class="footer">
      <div class="footer__container container">
        <div class="footer__top">
          <!-- <a href="<?php //echo esc_url( home_url( '/' ) ); ?>" class="footer__logo">
            <img src="<?php //echo get_field('site_logo', 'option') ?>" alt="Логотип architect" width="256" height="59">
          </a> -->

          <?php 
          $footer_logo = get_theme_mod('footer_logo');
          if ( $footer_logo ) : ?>
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo">
                  <img src="<?php echo esc_url( $footer_logo ); ?>" alt="Логотип <?php bloginfo('name'); ?>" width="256" height="59">
              </a>
          <?php endif; ?>


          <div class="footer__content">
            <div class="footer__contacts">
              <?php
                // $phone = get_field('company_tel', 'options');
                // $phone = explode(PHP_EOL, $phone);
                // $phone_href = preg_replace('![^0-9]+!', '', $phone);
              ?>
              <!-- <div class="footer__phone">
                <span class="footer__contacts-title"><?php //esc_html_e( 'Телефон', 'architect' ); ?></span>
                <a class="footer__contacts-link" href="tel:<?php //echo $phone_href[0]; ?>"
                  data-text="<?php //echo $phone[0]; ?>"><?php //echo $phone[0]; ?></a>
              </div>
              <div class="footer__email">
                <span class="footer__contacts-title"><?php //esc_html_e( 'Почта', 'architect' ); ?></span>
                <a class="footer__contacts-link" href="mailto:<?php //echo get_field('company_mail', 'option') ?>"
                  data-text="<?php //echo get_field('company_mail', 'option') ?>"><?php //echo get_field('company_mail', 'option') ?></a>
              </div>
              <div class="footer__address">
                <span class="footer__contacts-title"><?php //esc_html_e( 'Адрес', 'architect' ); ?></span>
                <p class="footer__contacts-link footer__contacts-link--inactive"><?php echo get_field('company_address', 'option') ?></p>
              </div> -->

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
            <div class="footer__nav">
							<?php if(has_nav_menu('footer_primary')) : ?>
              <div class="footer-menu">
								<?php if(!empty(get_field('footer-menu_title_1', 'option'))) : ?>
                <h3 class="footer-menu__title"><?php echo get_field('footer-menu_title_1', 'option') ?></h3>
								<?php endif; ?>
								<?php
									wp_nav_menu( [
										'theme_location'  => 'footer_primary',
										'menu'            => 'footer_primary',
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
							<?php endif; ?>

							<?php if(has_nav_menu('footer_nav')) : ?>
              <div class="footer-menu">
								<?php if(!empty(get_field('footer-menu_title_2', 'option'))) : ?>
                <h3 class="footer-menu__title"><?php echo get_field('footer-menu_title_2', 'option') ?></h3>
								<?php endif; ?>
								<?php
									wp_nav_menu( [
										'theme_location'  => 'footer_nav',
										'menu'            => 'footer_nav',
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
							<?php endif; ?>

              <?php if(has_nav_menu('footer_info')) : ?>
              <div class="footer-menu">
								<?php if(!empty(get_field('footer-menu_title_3', 'option'))) : ?>
                <h3 class="footer-menu__title"><?php echo get_field('footer-menu_title_3', 'option') ?></h3>
								<?php endif; ?>
								<?php
									wp_nav_menu( [
										'theme_location'  => 'footer_info',
										'menu'            => 'footer_info',
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
							<?php endif; ?>
            </div>

            <?php /* == Мобильное меню аккордеон == */ ?>
            <div class="footer-mobile-nav accordion">
							 <?php if(has_nav_menu('footer_primary')) : ?>
              <div class="accordion__item">
                <button class="accordion__control">
									<?php if(!empty(get_field('footer-menu_title_1', 'option'))) : ?>
                  <span class="accordion__title footer-mobile-nav__title"><?php echo get_field('footer-menu_title_1', 'option') ?></span>
									<?php endif; ?>
                  <span class="accordion__icon">
                    <svg aria-hidden="true" width="24" height="24">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-up"></use>
                    </svg>
                  </span>
                </button>
                <!-- Содержание -->
                <div class="accordion__content" aria-hidden="true">
                  <ul class="footer-mobile-nav__list" data-menu>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item data-text="Продукция">Продукция</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Производство">Производство</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Реализованные проекты">Реализованные проекты</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="О компании">О&#160;компании</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item data-text="Карьера">Карьера</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item data-text="Контакты">Контакты</a>
                    </li>
                  </ul>
                </div>
              </div>
							<?php endif; ?>

							<?php if(has_nav_menu('footer_nav')) : ?>
              <div class="accordion__item">
                <button class="accordion__control">
									<?php if(!empty(get_field('footer-menu_title_2', 'option'))) : ?>
                  <span class="accordion__title footer-mobile-nav__title"><?php echo get_field('footer-menu_title_2', 'option') ?></span>
									<?php endif; ?>
                  <span class="accordion__icon">
                    <svg aria-hidden="true" width="24" height="24">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-up"></use>
                    </svg>
                  </span>
                </button>
                <!-- Содержание -->
                <div class="accordion__content" aria-hidden="true">
                  <ul class="footer-mobile-nav__list" data-menu>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Деревянные окна и двери">Деревянные окна и&#160;двери</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Дерево-алюминиевые окна и двери">Дерево-алюминиевые окна и&#160;двери</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Алюминиевые окна и двери">Алюминиевые окна и&#160;двери</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Структурные окна и двери">Структурные окна и&#160;двери</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Панорамное остекление">Панорамное остекление</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Остекление домов и коттеджей">Остекление домов и&#160;коттеджей</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item data-text="Премиум окна">Премиум
                        окна</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Холодные складные конструкции">Холодные складные конструкции</a>
                    </li>
                  </ul>
                </div>
              </div>
							<?php endif; ?>

							<?php if(has_nav_menu('footer_info')) : ?>
              <div class="accordion__item">
                <button class="accordion__control">
									<?php if(!empty(get_field('footer-menu_title_3', 'option'))) : ?>
                  <span class="accordion__title footer-mobile-nav__title"><?php echo get_field('footer-menu_title_3', 'option') ?></span>
									<?php endif; ?>
                  <span class="accordion__icon">
                    <svg aria-hidden="true" width="24" height="24">
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-up"></use>
                    </svg>
                  </span>
                </button>
                <!-- Содержание -->
                <div class="accordion__content" aria-hidden="true">
                  <ul class="footer-mobile-nav__list" data-menu>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item data-text="Блог">Блог</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item data-text="Гарантии">Гарантии</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Для архитекторов и подрядных организаций">Для архитекторов и&#160;подрядных
                        организаций</a>
                    </li>
                    <li class="footer-mobile-nav__item">
                      <a class="footer-mobile-nav__link" href="#" data-menu-item
                        data-text="Материалы для скачивания">Материалы для скачивания</a>
                    </li>
                  </ul>
                </div>
              </div>
							<?php endif; ?>
            </div>
          </div>
        </div>

        <div class="footer__bottom">
          <!-- <p class="footer__company">&#169;2025&#160;architect</p> -->

          <p class="footer__company">
              <?php 
              $copyright = get_theme_mod('footer_copyright', '©2026 architect');
              $copyright = trim(preg_replace('/\s+/', ' ', $copyright));
              echo wp_kses_post( $copyright );
              ?>
          </p>
          <div class="footer__bottom-right">
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
        <div class="footer-bg__line">
          <img src="<?php echo get_template_directory_uri();?>/img/footer/footer-bg.svg" width="1440" height="698" aria-hidden="true" alt="">
        </div>
        <div class="footer-bg__line footer-bg__line--mobile">
          <img src="<?php echo get_template_directory_uri();?>/img/footer/footer-bg-mobile.svg" width="375" height="1107" aria-hidden="true" alt="">
        </div>
      </div>
    </footer>

		<?php wp_footer(); ?>

  </div>
</body>

</html>


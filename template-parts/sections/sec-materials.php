 <?php
/*
* Section: Материалы 
*/

  $sec_products_title = get_field('sec-products_sec_heading_title');
  $sec_products_descr = get_field('sec-products_sec_heading_descr');
  $sec_products_list = get_field('sec-products_list');
    // echo '<pre>';
    // var_dump($sec_products_list);
    // echo '</pre>';
?>
<section class="sec-materials">
  <div class="sec-materials__container container">
    <div class="sec-materials__heading">
      <h2 class="sec-materials__title sec-title">Материалы</h2>
      <div class="sec-materials__descr">
        <p class="sec-materials__slogan">
          Команда, которая живет вашим проектом&#160;&#8212; ведем от&#160;идеи до&#160;успешного воплощения
        </p>
        <p class="sec-materials__text">
          Мы&#160;погружаемся в&#160;каждую деталь вашего проекта, внимательно слушая и&#160;понимая ваши
          потребности. Вместе с&#160;вами
          проходим путь от&#160;концепции к&#160;реальному результату, обеспечивая поддержку и&#160;контроль
          на&#160;всех этапах.
        </p>
      </div>
    </div>
    
    <div class="sec-materials__list">
      <div class="sec-materials__nav slider-nav">
        <button class="sec-materials__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="sec-materials__btn-next slider-nav__btn slider-nav__btn--next">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
      </div>

      <div class="sec-materials__slider">
        <div class="swiper materials-slider">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <a href="#" class="ui-card">
                <picture class="ui-card__img">
                  <source srcset="<?php echo get_template_directory_uri();?>/img/materials/materials-img.webp" type="image/webp">
                  <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/materials/materials-img.jpg" width="640" height="425"
                    aria-hidden="true" alt="">
                </picture>
                <div class="ui-card__link">
                  <span class="ui-card__name">Дерево-алюминиевые</span>
                  <span class="ui-card__arrow">
                    <span class="ui-arrow">
                      <svg class="ui-arrow__svg">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                      <svg class="ui-arrow__svg ui-arrow__svg--copy">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                    </span>
                  </span>
                </div>
              </a>
            </div>

            <div class="swiper-slide">
              <a href="#" class="ui-card">
                <picture class="ui-card__img">
                  <source srcset="<?php echo get_template_directory_uri();?>/img/materials/materials-img.webp" type="image/webp">
                  <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/materials/materials-img.jpg" width="640" height="425"
                    aria-hidden="true" alt="">
                </picture>
                <div class="ui-card__link">
                  <span class="ui-card__name">Алюминиевые</span>
                  <span class="ui-card__arrow">
                    <span class="ui-arrow">
                      <svg class="ui-arrow__svg">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                      <svg class="ui-arrow__svg ui-arrow__svg--copy">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                    </span>
                  </span>
                </div>
              </a>
            </div>
            <div class="swiper-slide">
              <a href="#" class="ui-card">
                <picture class="ui-card__img">
                  <source srcset="<?php echo get_template_directory_uri();?>/img/materials/materials-img.webp" type="image/webp">
                  <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/materials/materials-img.jpg" width="640" height="425"
                    aria-hidden="true" alt="">
                </picture>
                <div class="ui-card__link">
                  <span class="ui-card__name">Деревянные</span>
                  <span class="ui-card__arrow">
                    <span class="ui-arrow">
                      <svg class="ui-arrow__svg">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                      <svg class="ui-arrow__svg ui-arrow__svg--copy">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                    </span>
                  </span>
                </div>
              </a>
            </div>
            <div class="swiper-slide">
              <a href="#" class="ui-card">
                <picture class="ui-card__img">
                  <source srcset="<?php echo get_template_directory_uri();?>/img/materials/materials-img.webp" type="image/webp">
                  <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/materials/materials-img.jpg" width="640" height="425"
                    aria-hidden="true" alt="">
                </picture>
                <div class="ui-card__link">
                  <span class="ui-card__name">Каменные</span>
                  <span class="ui-card__arrow">
                    <span class="ui-arrow">
                      <svg class="ui-arrow__svg">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                      <svg class="ui-arrow__svg ui-arrow__svg--copy">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                    </span>
                  </span>
                </div>
              </a>
            </div>
            <div class="swiper-slide">
              <a href="#" class="ui-card">
                <picture class="ui-card__img">
                  <source srcset="<?php echo get_template_directory_uri();?>/img/materials/materials-img.webp" type="image/webp">
                  <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/materials/materials-img.jpg" width="640" height="425"
                    aria-hidden="true" alt="">
                </picture>
                <div class="ui-card__link">
                  <span class="ui-card__name">Стальные</span>
                  <span class="ui-card__arrow">
                    <span class="ui-arrow">
                      <svg class="ui-arrow__svg">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                      <svg class="ui-arrow__svg ui-arrow__svg--copy">
                        <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow-diagonal"></use>
                      </svg>
                    </span>
                  </span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
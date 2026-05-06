 <?php
/*
* Section: Характеристики
*/

// $sec_components_title = get_field('sec-components_title');
// $sec_components_subtitle = get_field('sec-galleryworks_subtitle');
// $sec_components_list = get_field('sec-components_show_blocks');

?>
<section class="sec-chars">
  <div class="sec-chars__container container">
    <div class="sec-chars__heading">
      <div class="sec-chars__inner">
        <h2 class="sec-chars__title sec-title">Характеристики</h2>
        <p class="sec-chars__subtitle">
          Lorem ipsum Lorem ipsum Lorem dolor
        </p>
      </div>
      <div class="sec-chars__nav slider-nav">
        <button class="sec-chars__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="sec-chars__btn-next slider-nav__btn slider-nav__btn--next">
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
    </div>

    <div class="swiper sec-chars__slider">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <a href="#" class="chars-card">
            <div class="chars-card__img">
              <picture class="chars-card__pic">
                <source srcset="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.webp" type="image/webp">
                <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.jpg" width="480" height="300" aria-hidden="true" alt="">
              </picture>
            </div>
            <div class="chars-card__content">
              <h3 class="chars-card__title">Внешний вид, интерьер</h3>
              <div class="chars-card__descr">
                <p class="chars-card__text">Комфортное пространство для повседневной жизни</p>
                <ul class="chars-card__list">
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                </ul>
              </div>
              <span class="chars-card__link ui-card-link">
                <span class="ui-card-link__text">Заказать</span>
                <span class="ui-card-link__icons ui-arrow">
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
          <a href="#" class="chars-card">
            <div class="chars-card__img">
              <picture class="chars-card__pic">
                <source srcset="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.webp" type="image/webp">
                <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.jpg" width="480" height="300" aria-hidden="true" alt="">
              </picture>
            </div>
            <div class="chars-card__content">
              <h3 class="chars-card__title">Внешний вид, интерьер</h3>
              <div class="chars-card__descr">
                <p class="chars-card__text">Комфортное пространство для повседневной жизни</p>
                <ul class="chars-card__list">
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                </ul>
              </div>
              <span class="chars-card__link ui-card-link">
                <span class="ui-card-link__text">Заказать</span>
                <span class="ui-card-link__icons ui-arrow">
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
          <a href="#" class="chars-card">
            <div class="chars-card__img">
              <picture class="chars-card__pic">
                <source srcset="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.webp" type="image/webp">
                <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.jpg" width="480" height="300" aria-hidden="true" alt="">
              </picture>
            </div>
            <div class="chars-card__content">
              <h3 class="chars-card__title">Внешний вид, интерьер</h3>
              <div class="chars-card__descr">
                <p class="chars-card__text">Комфортное пространство для повседневной жизни</p>
                <ul class="chars-card__list">
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                </ul>
              </div>
              <span class="chars-card__link ui-card-link">
                <span class="ui-card-link__text">Заказать</span>
                <span class="ui-card-link__icons ui-arrow">
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
          <a href="#" class="chars-card">
            <div class="chars-card__img">
              <picture class="chars-card__pic">
                <source srcset="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.webp" type="image/webp">
                <img loading="lazy" src="<?php echo get_template_directory_uri();?>/img/solutions/sol-1.jpg" width="480" height="300" aria-hidden="true" alt="">
              </picture>
            </div>
            <div class="chars-card__content">
              <h3 class="chars-card__title">Внешний вид, интерьер</h3>
              <div class="chars-card__descr">
                <p class="chars-card__text">Комфортное пространство для повседневной жизни</p>
                <ul class="chars-card__list">
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                  <li class="chars-card__item">
                    <svg class="chars-card__marker" aria-hidden>
                      <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#check-check"></use>
                    </svg>
                    <span class="chars-card__span">Несущие профили из дерева</span>
                  </li>
                </ul>
              </div>
              <span class="chars-card__link ui-card-link">
                <span class="ui-card-link__text">Заказать</span>
                <span class="ui-card-link__icons ui-arrow">
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
</section>

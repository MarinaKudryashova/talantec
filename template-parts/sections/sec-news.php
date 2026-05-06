
<?php
/*
* Section: Новости и блог
*/

$sec_news_title = get_field('sec-news_title');
$sec_news_subtitle = get_field('sec-news_subtitle');
$sec_news_list = get_field('sec-news_list');
?>
<section class="news" id="news-blog">
  <div class="news__container container">
    <div class="news__heading">
      <div class="news__inner">
        <?php if (!empty($sec_news_title)) : ?>
        <h2 class="news__title sec-title"><?php esc_html_e($sec_news_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($sec_news_subtitle)) : ?>
        <p class="news__subtitle"><?php echo wp_kses_post($sec_news_subtitle); ?></p>
        <?php endif; ?>
      </div>
      <div class="news__nav slider-nav">
        <button class="news__btn-prev slider-nav__btn slider-nav__btn--prev">
          <span class="slider-nav__icons">
            <svg class="slider-nav__icon slider-nav__icon--original">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            <svg class="slider-nav__icon slider-nav__icon--copy">
              <use xlink:href="<?php echo get_template_directory_uri();?>/img/sprite.svg#icon-arrow"></use>
            </svg>
          </span>
        </button>
        <button class="news__btn-next slider-nav__btn slider-nav__btn--next">
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

    <!-- Слайдер -->
    <div class="swiper news__slider slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="news-card">
            <a href="#" class="news-card__link"></a>
            <div class="news-card__info">
              <span class="news-card__category">Категория 1</span>
              <p class="news-card__text is-clamp" style="--lines: 2;">Lorem isum dolor smile, dont worry
                be&#160;happy, my&#160;dear and lovely user</p>
              <div class="news-card__contact">
                <span class="news-card__name">Связаться с&#160;нами</span>
                <span class="news-card__arrow">
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
            </div>
            <div class="news-card__view">
              <picture class="news-card__picture">
                <img src="<?php echo get_template_directory_uri();?>/img/news/news-thumb.jpg" alt="Иллюстрация к новости" loading="lazy" width="416"
                  height="300">
              </picture>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="news-card">
            <a href="#" class="news-card__link"></a>
            <div class="news-card__info">
              <span class="news-card__category">Категория 1</span>
              <p class="news-card__text is-clamp" style="--lines: 2;">Lorem isum dolor smile</p>
              <div class="news-card__contact">
                <span class="news-card__name">Связаться с&#160;нами</span>
                <span class="news-card__arrow">
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
            </div>
            <div class="news-card__view">
              <picture class="news-card__picture">
                <img src="<?php echo get_template_directory_uri();?>/img/news/news-thumb.jpg" alt="Иллюстрация к новости" loading="lazy" width="416"
                  height="300">
              </picture>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="news-card">
            <a href="#" class="news-card__link"></a>
            <div class="news-card__info">
              <span class="news-card__category">Категория 1</span>
              <p class="news-card__text is-clamp" style="--lines: 2;">Lorem isum dolor smile, dont worry
                be&#160;happy, my&#160;dear and lovely user</p>
              <div class="news-card__contact">
                <span class="news-card__name">Связаться с&#160;нами</span>
                <span class="news-card__arrow">
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
            </div>
            <div class="news-card__view">
              <picture class="news-card__picture">
                <img src="<?php echo get_template_directory_uri();?>/img/news/news-thumb.jpg" alt="Иллюстрация к новости" loading="lazy" width="416"
                  height="300">
              </picture>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="news-card">
            <a href="#" class="news-card__link"></a>
            <div class="news-card__info">
              <span class="news-card__category">Категория 1</span>
              <p class="news-card__text is-clamp" style="--lines: 2;">Lorem isum dolor smile, dont worry
                be&#160;happy, my&#160;dear and lovely user</p>
              <div class="news-card__contact">
                <span class="news-card__name">Связаться с&#160;нами</span>
                <span class="news-card__arrow">
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
            </div>
            <div class="news-card__view">
              <picture class="news-card__picture">
                <img src="<?php echo get_template_directory_uri();?>/img/news/news-thumb.jpg" alt="Иллюстрация к новости" loading="lazy" width="416"
                  height="300">
              </picture>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
import Swiper, { Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y, Thumbs } from "swiper";
Swiper.use([Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y, Thumbs]);

const styleSliders = document.querySelectorAll(".style-slider");
if (styleSliders) {
  styleSliders.forEach((slider) => {
    const styleSlider = slider.querySelector(".style-slider__large");
    const styleSliderThumbs = slider.querySelector(".style-slider__thumbs");
    const btnNext = slider.closest(".sec-style").querySelector(".sec-style__btn-next");
    const btnPrev = slider.closest(".sec-style").querySelector(".sec-style__btn-prev");

    // Инициализируем сначала слайдер с миниатюрами
    const sliderThumbs = new Swiper(styleSliderThumbs, {
      loop: true,
      spaceBetween: 32,
      slidesPerView: 2.16,
      slidesPerGroup: 1,
      watchSlidesProgress: true,
      watchSlidesVisibility: true,
      navigation: {
        nextEl: btnNext,
        prevEl: btnPrev,
      },
      on: {
        init: function () {
          updateActiveThumbVisibility(this);
        },
        slideChange: function () {
          updateActiveThumbVisibility(this);
        },
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 16,
          slidesPerGroup: 1,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 24,
          slidesPerGroup: 1,
        },
        1280: {
          slidesPerView: 2.18,
          spaceBetween: 32,
          slidesPerGroup: 1,
        },
      },
    });

    // Затем инициализируем основной слайдер
    const sliderLarge = new Swiper(styleSlider, {
      loop: true,
      effect: "fade",
      fadeEffect: {
        crossFade: true,
      },
      spaceBetween: 20,
      slidesPerView: 1,
      navigation: {
        nextEl: btnNext,
        prevEl: btnPrev,
      },
      on: {
        init: function () {
          updateActiveThumbVisibility(sliderThumbs);
        },
        // ПРОСТОЙ ПОДХОД: синхронизируем только при клике по кнопкам
        slideChange: function () {
          // Просто обновляем видимость активного слайда
          if (sliderThumbs && !sliderThumbs.destroyed) {
            updateActiveThumbVisibility(sliderThumbs);
          }
        },
      },
      breakpoints: {
        360: {
          slidesPerView: 1,
          spaceBetween: 8,
        },
        769: {
          slidesPerView: 1,
          spaceBetween: 16,
        },
      },
      // ВАЖНО: используем стандартную привязку к миниатюрам
      thumbs: {
        swiper: sliderThumbs,
      },
    });

    // Дополнительная синхронизация при клике по миниатюрам
    sliderThumbs.slides.forEach((slide, index) => {
      slide.addEventListener("click", () => {
        if (sliderLarge && !sliderLarge.destroyed) {
          sliderLarge.slideTo(index);
        }
      });
    });

    function updateActiveThumbVisibility(swiper) {
      swiper.slides.forEach((slide) => {
        slide.classList.remove("thumb-hidden");
      });

      const activeSlide = swiper.slides[swiper.activeIndex];
      if (activeSlide) {
        activeSlide.classList.add("thumb-hidden");
      }
    }
  });
}

const mobileStyleSliders = document.querySelectorAll(".style-slider-mobile__slider");
if (mobileStyleSliders) {
  mobileStyleSliders.forEach((slider) => {
    const btnNext = slider.closest(".sec-style").querySelector(".sec-style__btn-next");
    const btnPrev = slider.closest(".sec-style").querySelector(".sec-style__btn-prev");

    const swiper = new Swiper(slider, {
      spaceBetween: 8,
      slidesPerView: 1.18,
      navigation: {
        nextEl: btnNext,
        prevEl: btnPrev,
      },
      breakpoints: {
        375: {
          slidesPerView: 1.1,
          spaceBetween: 8,
        },
        578: {
          slidesPerView: 1.5,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 2.1,
          spaceBetween: 16,
        },
      },
    });
  });
}

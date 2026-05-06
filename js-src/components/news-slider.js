import Swiper, { Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y } from "swiper";
Swiper.use([Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y]);

const newsSliders = document.querySelectorAll(".news__slider");

if (newsSliders) {
  newsSliders.forEach((slider) => {
    const btnNextSlider = slider.closest(".news").querySelector(".news__btn-next");
    const btnPrevSlider = slider.closest(".news").querySelector(".news__btn-prev");

    const newsSwiper = new Swiper(slider, {
      // loop: true,
      lazy: true,
      spaceBetween: 8,
      slidesPerView: 1,
      navigation: {
        nextEl: btnNextSlider,
        prevEl: btnPrevSlider,
      },
      breakpoints: {
        320: {
          slidesPerView: 1.1,
          spaceBetween: 8,
        },
        576: {
          slidesPerView: 1.5,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 2.1,
          spaceBetween: 16,
        },
        1024: {
          slidesPerView: 3.1,
          spaceBetween: 24,
        },
        1280: {
          slidesPerView: 3.1,
          spaceBetween: 32,
        },
      },
    });
  });
}

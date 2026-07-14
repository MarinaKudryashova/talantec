import Swiper from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y, Thumbs } from "swiper/modules";

const constructionSliders = document.querySelectorAll(".sec-construction__slider");

if (constructionSliders) {
  constructionSliders.forEach((slider) => {
    const btnNextSlider = slider.parentNode.querySelector(".sec-construction__btn-next");
    const btnPrevSlider = slider.parentNode.querySelector(".sec-construction__btn-prev");

    const constructionSwiper = new Swiper(slider, {
      modules: [Navigation, FreeMode, A11y],
      // loop: true,
      lazy: true,
      // spaceBetween: 8,
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

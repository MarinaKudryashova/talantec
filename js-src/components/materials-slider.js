import Swiper from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y, Thumbs } from "swiper/modules";

const materialSliders = document.querySelectorAll(".materials-slider");

if (materialSliders) {
  materialSliders.forEach((slider) => {
    const btnNextSlider = slider.parentNode.parentNode.querySelector(".sec-materials__btn-next");
    const btnPrevSlider = slider.parentNode.parentNode.querySelector(".sec-materials__btn-prev");

    const materialSwiper = new Swiper(slider, {
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
          slidesPerView: 1.3,
          spaceBetween: 16,
        },
        768: {
          slidesPerView: 1.3,
          spaceBetween: 16,
        },
        1024: {
          slidesPerView: 1.3,
          spaceBetween: 24,
        },
        1280: {
          slidesPerView: 1.3,
          spaceBetween: 32,
        },
      },
    });
  });
}

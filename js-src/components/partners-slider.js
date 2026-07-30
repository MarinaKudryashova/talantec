import Swiper from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y, Thumbs } from "swiper/modules";

const partnersSlider = document.querySelector(".sec-partners__slider");

if (partnersSlider) {
  const swiper_partnersSlider = new Swiper(partnersSlider, {
    modules: [Navigation, FreeMode, A11y, Autoplay],
    loop: true,
    freeMode: true,
    enabled: true,
    lazy: true,
    grabCursor: true,
    slidesPerView: 1.5,
    spaceBetween: 16,
    centeredSlides: true,
    watchSlidesProgress: true,
    speed: 3000,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
    breakpoints: {
      380: {
        slidesPerView: 2,
        spaceBetween: 8,
      },
      576: {
        slidesPerView: 2.5,
        spaceBetween: 16,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 16,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 24,
      },
      1280: {
        slidesPerView: 4,
        spaceBetween: 32,
      },
    },
  });
}

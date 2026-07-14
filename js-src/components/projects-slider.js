import Swiper from "swiper";
import { Navigation, Pagination, Autoplay, EffectFade, FreeMode, Grid, A11y, Thumbs } from "swiper/modules";

const projectsSliders = document.querySelectorAll(".sec-projects__slider");

if (projectsSliders) {
  projectsSliders.forEach((slider) => {
    const btnNextSlider = slider.parentNode.querySelector(".sec-projects__btn-next");
    const btnPrevSlider = slider.parentNode.querySelector(".sec-projects__btn-prev");

    const projectsSwiper = new Swiper(slider, {
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
          // Для очень маленьких экранов
          slidesPerView: 1.1,
          spaceBetween: 8,
        },
        576: {
          // от 576px и выше
          slidesPerView: 1.5,
          spaceBetween: 8,
        },
        768: {
          // от 768px и выше
          slidesPerView: 2,
          spaceBetween: 16,
        },
        1024: {
          // от 1024px и выше
          slidesPerView: 2.4,
          spaceBetween: 24,
        },
        1280: {
          // от 1280px и выше
          slidesPerView: 2,
          spaceBetween: 32,
        },
        // 320: {
        //   slidesPerView: 1.1,
        //   spaceBetween: 16,
        // },
        // 576: {
        //   slidesPerView: 1.5,
        //   spaceBetween: 16,
        // },
        // 768: {
        //   slidesPerView: 2,
        //   spaceBetween: 20,
        // },
        // 1024: {
        //   slidesPerView: 2.3,
        //   spaceBetween: 32,
        // },
      },
    });
  });
}

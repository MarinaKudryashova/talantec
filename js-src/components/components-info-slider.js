import GraphTabs from "graph-tabs";
// import Swiper, { Navigation, FreeMode } from "swiper";
// Swiper.use([Navigation, FreeMode]);
import Swiper from "./init-slider";

let swiper_componentsInfoSlider;
const componentsInfoSlider = document?.querySelectorAll(".components-info__slider");

if (document.querySelector("[data-tabs='tabs-components']")) {
  const sliderTabs = new GraphTabs("tabs-components", {
    isChanged: (tabs) => {
      initSwiperComponentsInfoSlider();
    },
  });
  initSwiperComponentsInfoSlider();
}

function initSwiperComponentsInfoSlider() {
  const activePanel = document.querySelector(".tabs__panel--active");
  if (!activePanel) return;

  const btnNextComponentsInfoSlider = activePanel?.querySelector(".components-info__btn-next");
  const btnPrevComponentsInfoSlider = activePanel?.querySelector(".components-info__btn-prev");

  if (swiper_componentsInfoSlider) {
    swiper_componentsInfoSlider.destroy(true, true);
  }

  const fondSlide = [...componentsInfoSlider].find((slider) => {
    return slider.parentNode.parentNode.classList.contains("tabs__panel--active");
  });

  swiper_componentsInfoSlider = new Swiper(fondSlide, {
    lazy: true,
    spaceBetween: 8,
    slidesPerView: 1,
    navigation: {
      nextEl: btnNextComponentsInfoSlider,
      prevEl: btnPrevComponentsInfoSlider,
    },
    breakpoints: { // УБЕРИТЕ лишний breakpoints
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

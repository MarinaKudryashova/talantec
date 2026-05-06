// import GraphTabs from "graph-tabs";
// import Swiper, { Navigation, FreeMode } from "swiper";
// Swiper.use([Navigation, FreeMode]);

// let swiper_componentsInfoSlider;
// const componentsInfoSlider = document?.querySelectorAll(".components-info__slider");
// const btnNextComponentsInfoSlider = document?.querySelector(".components-info__btn-next");
// const btnPrevComponentsInfoSlider = document?.querySelector(".components-info__btn-prev");

// if (document.querySelector("[data-tabs='components']")) {
//   const sliderTabs = new GraphTabs("components", {
//     isChanged: (tabs) => {
//       initSwiperComponentsInfoSlider();
//     },
//   });
//   initSwiperComponentsInfoSlider();
// }

// function initSwiperComponentsInfoSlider() {
//   if (swiper_componentsInfoSlider) {
//     console.log(swiper_componentsInfoSlider);

//     swiper_componentsInfoSlider.destroy(true, true);
//   }
//   const fondSlide = [...componentsInfoSlider].find((slider) => {
//     return slider.parentNode.parentNode.classList.contains("tabs__panel--active");
//   });

//   swiper_componentsInfoSlider = new Swiper(fondSlide, {
//     lazy: true,
//     spaceBetween: 8,
//     slidesPerView: 1,
//     navigation: {
//       nextEl: btnNextComponentsInfoSlider,
//       prevEl: btnPrevComponentsInfoSlider,
//     },
//     breakpoints: {
//       375: {
//         slidesPerView: 1.5,
//         spaceBetween: 8,
//       },
//       576: {
//         slidesPerView: 2,
//         spaceBetween: 8,
//       },
//       768: {
//         slidesPerView: 2.5,
//         spaceBetween: 16,
//       },
//       1024: {
//         slidesPerView: 3,
//         spaceBetween: 16,
//       },
//       1440: {
//         slidesPerView: 4,
//         spaceBetween: 32,
//       },
//     },
//   });
// }

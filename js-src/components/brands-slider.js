import Swiper from './init-slider';

const brandsSlider = document.querySelector('.sec-brands__slider');
if (brandsSlider) {
  const swiper_brandsSlider = new Swiper(brandsSlider, {
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
    }
  });
}

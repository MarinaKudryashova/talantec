import Swiper from "./init-slider";

const charsSliders = document.querySelectorAll(".sec-chars__slider");

if (charsSliders) {
  charsSliders.forEach((slider) => {
    const btnNextSlider = slider.parentNode.querySelector(".sec-chars__btn-next");
    const btnPrevSlider = slider.parentNode.querySelector(".sec-chars__btn-prev");

    const charsSwiper = new Swiper(slider, {
      // loop: true,
      lazy: true,
      spaceBetween: 8,
      slidesPerView: 1,
      navigation: {
        nextEl: btnNextSlider,
        prevEl: btnPrevSlider,
      },
      breakpoints: {
                576: {  // от 576px и выше
          slidesPerView: 1.5,
          spaceBetween: 8, // 8px
        },
        768: {  // от 768px и выше
          slidesPerView: 2,
          spaceBetween: 16, // 16px
        },
        1024: { // от 1024px и выше
          slidesPerView: 3,
          spaceBetween: 24, // 24px"
        },
        1280: { // от 1280px и выше
          slidesPerView: 3,
          spaceBetween: 32, // 32px
        }
      },
    });
  });
}

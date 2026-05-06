import { isMobile, isTablet, isDesktop } from "../functions/check-viewport";
import { loadMoreCards } from "../functions/loadMoreCards";

document.addEventListener("DOMContentLoaded", function () {
  const loadMoreBtn = document.querySelector(".sec-galleryworks__more-btn");
  let visibleCount = 5; // Показываем первые 5 карточки
  let loadMoreCount = 5; // Показываем по 5 дополнительные карточки

  loadMoreCards("#galleryworksList .sec-galleryworks__item", loadMoreBtn, visibleCount, loadMoreCount);
});

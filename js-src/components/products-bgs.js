document.addEventListener("DOMContentLoaded", function () {
  const productsList = document.querySelector(".products__list");
  const bgItems = document.querySelectorAll(".products-bgs__item");
  let hoverTimeout;
  let isTransitioning = false;

  if (!productsList || !bgItems) return;

  // Функция для плавной смены фона
  function switchBackground(bgIndex) {
    if (isTransitioning) return;

    isTransitioning = true;

    // Находим текущий активный и целевой фон
    const currentActive = document.querySelector(".products-bgs__item.is-active");
    const targetBg = document.querySelector(`.products-bgs__item[data-bg-index="${bgIndex}"]`);

    if (!targetBg || currentActive === targetBg) {
      isTransitioning = false;
      return;
    }

    if (currentActive) {
      currentActive.classList.add("fading-out");
      currentActive.classList.remove("is-active");
    }

    // Показываем новый фон
    targetBg.classList.add("is-active");

    // Сбрасываем флаг после завершения анимации
    setTimeout(() => {
      if (currentActive) {
        currentActive.classList.remove("fading-out");
      }
      isTransitioning = false;
    }, 300);
  }

  // Делегирование событий
  productsList.addEventListener("mouseover", function (e) {
    const link = e.target.closest(".products-link");
    if (!link) return;

    clearTimeout(hoverTimeout);
    const bgIndex = link.getAttribute("data-bg-target");
    switchBackground(bgIndex);
  });

  productsList.addEventListener("mouseout", function (e) {
    if (!e.relatedTarget || !productsList.contains(e.relatedTarget)) {
      hoverTimeout = setTimeout(() => {
        switchBackground("1"); // Возвращаемся к первому фону
      }, 500);
    }
  });
});

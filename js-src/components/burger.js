document.addEventListener("DOMContentLoaded", function() {
  const burgerBtn = document.querySelector('[data-burger]');
  const overlay = document.querySelector('.header__overlay');
  const menu = document.querySelector('.mobile-menu');
  const menuItems = document.querySelectorAll('[data-menu-item]');
  const header = document.querySelector('.header');

  if (!burgerBtn || !menu) return;

  function openMenu() {
    menu.classList.add("is-open")
    overlay.classList.add("is-open")
    document.body.style.overflow = "hidden";
    header.classList.add("header--burger")
    burgerBtn.classList.add("is-open")
  }

  function closeMenu() {
    menu.classList.remove("is-open")
    overlay.classList.remove("is-open")
    burgerBtn.classList.remove("is-open")
    document.body.style.overflow = "";
    header.classList.remove("header--burger")
  }

    function toggleMenu() {
    if (menu.classList.contains("is-open")) {
      closeMenu();
    } else {
      openMenu();
    }
  }

    // Обработчик клика вне меню
  function handleClickOutside(e) {
    if (!burgerBtn.contains(e.target) && !menu.contains(e.target) && menu.classList.contains('is-open')) {
      closeMenu();
    }
  }

  burgerBtn.addEventListener("click", function(e) {
    e.preventDefault();
    toggleMenu();
  });

  menuItems.forEach(item => {
    item.addEventListener("click", closeMenu);
  });

  document.addEventListener("keydown", function(e) {
    if (e.key === "Escape" && menu.classList.contains("is-open")) {
      closeMenu();
    }
  });

  document.addEventListener("click", handleClickOutside);
})

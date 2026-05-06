// Находим конкретный аккордеон
const accordion = document.querySelector('.mobile-nav__accordion');

// Функция для закрытия аккордеона
const closeAccordion = function() {
  if (accordion.classList.contains('is-open')) {
    accordion.classList.remove('is-open');
    const control = accordion.querySelector('.accordion__control');
    const content = accordion.querySelector('.accordion__content');

    if (control) control.setAttribute('aria-expanded', false);
    if (content) {
      content.setAttribute('aria-hidden', true);
      content.style.maxHeight = null;
    }
  }
};

// Функция для открытия аккордеона
const openAccordion = function() {
  accordion.classList.add('is-open');
  const control = accordion.querySelector('.accordion__control');
  const content = accordion.querySelector('.accordion__content');

  if (control) control.setAttribute('aria-expanded', true);
  if (content) {
    content.setAttribute('aria-hidden', false);
    content.style.maxHeight = content.scrollHeight + 'px';
  }
};

// Инициализируем обработчик клика на кнопке аккордеона
if (accordion) {
  const control = accordion.querySelector('.accordion__control');

  if (control) {
    control.addEventListener('click', (e) => {
      e.stopPropagation();

      if (accordion.classList.contains('is-open')) {
        // Если аккордеон уже открыт - закрываем его
        closeAccordion();
      } else {
        // Если аккордеон закрыт - открываем его
        openAccordion();
      }
    });
  }
}

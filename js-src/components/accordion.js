const accordions = document.querySelectorAll('.accordion__item');

// Закрываем аккордеон
const close = function() {
  accordions.forEach(el => {
    if (el.classList.contains('is-open')) {
      el.classList.remove('is-open')
      el.querySelector('.accordion__control').setAttribute('aria-expanded', false);
      el.querySelector('.accordion__content').setAttribute('aria-hidden', true);
      el.querySelector('.accordion__content').style.maxHeight = null;
    }
  })
}

// Открываем аккордеон
const open = function(current) {
  current.classList.add('is-open');
  const control = current.querySelector('.accordion__control');
  const content = current.querySelector('.accordion__content');
  control.setAttribute('aria-expanded', true);
  content.setAttribute('aria-hidden', false);
  content.style.maxHeight = content.scrollHeight + 'px';
}

accordions.forEach(el => {
  const control = el.querySelector('.accordion__control');

  control.addEventListener('click', (e) => {
    const current = e.currentTarget.closest('.accordion__item');

    if(current.classList.contains('is-open')) {
      close();
    } else {
      close();
      open(current);
    }
  });
});



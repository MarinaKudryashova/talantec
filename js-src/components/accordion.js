const accordions = document.querySelectorAll('.accordion__item');

const close = function() {
  accordions.forEach(el => {
    if (!el.classList.contains('is-open')) {
      return;
    }

    const control = el.querySelector('.accordion__control');
    const content = el.querySelector('.accordion__content');

    el.classList.remove('is-open');

    if (control) {
      control.setAttribute('aria-expanded', false);
    }

    if (content) {
      content.setAttribute('aria-hidden', true);
      content.style.maxHeight = null;
    }
  });
};

const open = function(current) {
  const control = current.querySelector('.accordion__control');
  const content = current.querySelector('.accordion__content');

  if (!control || !content) {
    return;
  }

  current.classList.add('is-open');
  control.setAttribute('aria-expanded', true);
  content.setAttribute('aria-hidden', false);
  content.style.maxHeight = content.scrollHeight + 'px';
};

accordions.forEach(el => {
  const control = el.querySelector('.accordion__control');

  if (!control) {
    return;
  }

  control.addEventListener('click', (e) => {
    const current = e.currentTarget.closest('.accordion__item');

    if (!current) {
      return;
    }

    if (current.classList.contains('is-open')) {
      close();
    } else {
      close();
      open(current);
    }
  });
});

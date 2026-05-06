document.addEventListener('DOMContentLoaded', function() {
  const btn = document.querySelector('.footer__top-btn');

  if(btn) {
    btn.onclick = function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      })
    }
  }
})

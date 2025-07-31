document.addEventListener('DOMContentLoaded', function () {
  const pages = document.querySelectorAll('.book .page');
  let current = 0;

  pages.forEach((page, index) => {
    page.style.zIndex = pages.length - index;
    page.addEventListener('click', () => {
      if (index === current) {
        page.classList.add('flipped');
        current = Math.min(current + 1, pages.length - 1);
      } else if (index === current - 1) {
        page.classList.remove('flipped');
        current = Math.max(current - 1, 0);
      }
    });
  });
});


document.addEventListener('DOMContentLoaded', function () {
  const headers = document.querySelectorAll('h1');
  headers.forEach(header => {
    const text = header.textContent;
    header.textContent = '';
    let i = 0;
    function type() {
      if (i <= text.length) {
        header.textContent = text.slice(0, i);
        i++;
        setTimeout(type, 75);
      }
    }
    type();
  });
});

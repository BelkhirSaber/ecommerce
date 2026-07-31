document.addEventListener(
  'error',
  (e) => {
    if (e.target instanceof HTMLImageElement) {
      e.target.style.display = 'none';
    }
  },
  true,
);

export function initImagePreview() {
  const imageInput = document.getElementById('imageInput');
  if (!imageInput) return;

  imageInput.addEventListener('change', function (event) {
    const mainPreview = document.getElementById('mainPreview');
    const listContainer = document.getElementById('imageList');

    if (!mainPreview || !listContainer) return;

    listContainer.innerHTML = '';
    mainPreview.innerHTML = '<p>No image selected</p>';

    const files = event.target.files;

    Array.from(files).forEach((file, index) => {
      if (!file.type.startsWith('image/')) return;

      const reader = new FileReader();

      reader.onload = function (e) {
        const thumbnail = document.createElement('img');
        thumbnail.src = e.target.result;

        thumbnail.addEventListener('click', () => {
          mainPreview.innerHTML = '';
          const mainImg = document.createElement('img');
          mainImg.src = e.target.result;
          mainPreview.appendChild(mainImg);
        });

        if (index === 0) {
          mainPreview.innerHTML = '';
          const mainImg = document.createElement('img');
          mainImg.src = e.target.result;
          mainPreview.appendChild(mainImg);
        }

        listContainer.appendChild(thumbnail);
      };

      reader.readAsDataURL(file);
    });
  });
}

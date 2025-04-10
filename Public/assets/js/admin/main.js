'use strict';

$(document).ready(function () {

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const mainPreview = document.getElementById('mainPreview');
        const listContainer = document.getElementById('imageList');

        listContainer.innerHTML = ''; // Clear previous images
        mainPreview.innerHTML = '<p>No image selected</p>'; // Reset main preview

        const files = event.target.files;

        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const thumbnail = document.createElement('img');
                    thumbnail.src = e.target.result;

                    // On click, set as main preview
                    thumbnail.addEventListener('click', () => {
                        mainPreview.innerHTML = '';
                        const mainImg = document.createElement('img');
                        mainImg.src = e.target.result;
                        mainPreview.appendChild(mainImg);
                    });

                    // Automatically set the first image as the main preview
                    if (index === 0) {
                        mainPreview.innerHTML = '';
                        const mainImg = document.createElement('img');
                        mainImg.src = e.target.result;
                        mainPreview.appendChild(mainImg);
                    }

                    listContainer.appendChild(thumbnail);
                };

                reader.readAsDataURL(file);
            } else {
                alert('File type not supported: ' + file.name);
            }
        });
    });

});


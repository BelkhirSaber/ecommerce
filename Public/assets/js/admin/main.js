'use strict';

// Ce fichier est maintenant importé par admin-bundle.js
// Gardez uniquement le code spécifique aux pages admin

$(document).ready(function () {
    // Image preview functionality
    const imageInput = document.getElementById('imageInput');
    
    if (imageInput) {
        imageInput.addEventListener('change', function(event) {
            const mainPreview = document.getElementById('mainPreview');
            const listContainer = document.getElementById('imageList');

            listContainer.innerHTML = '';
            mainPreview.innerHTML = '<p>No image selected</p>';

            const files = event.target.files;

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
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
                } else {
                    alert('File type not supported: ' + file.name);
                }
            });
        });
    }
});
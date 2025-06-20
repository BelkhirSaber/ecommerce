"use strict";

const addProduct = (event, _this) => {

    event.preventDefault();

    // -- Recuperer form 
    const form = document.querySelector('#'+$(_this).attr('form'));
    const formData = new FormData(form);

     $.ajax({
        url: '/submit.php',
        type: 'POST',
        data: formData,
        processData: false, // nécessaire pour FormData
        contentType: false, // nécessaire pour FormData
        dataType: 'json',
        success: function (response) {
            $('#errors').empty(); // efface les erreurs précédentes

            if (response.success) {
                alert('Formulaire envoyé avec succès !');
            } else if (response.errors) {
                $.each(response.errors, function (field, message) {
                $('#errors').append('<p style="color:red;">' + field + ': ' + message + '</p>');
                });
            }
        },
        error: function () {
            alert('Erreur lors de l’envoi du formulaire.');
        }
    });

}
export function initAddProductForm() {
  const form = document.getElementById('product');
  if (!form) return;

  const saveBtn = document.getElementById('saveProductBtn');
  if (!saveBtn) return;

  saveBtn.addEventListener('click', function (event) {
    event.preventDefault();

    const formData = new FormData(form);

    $.ajax({
      url: '/submit.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function (response) {
        $('#errors').empty();

        if (response.success) {
          alert('Formulaire envoyé avec succès !');
        } else if (response.errors) {
          $.each(response.errors, function (field, message) {
            $('#errors').append('<p style="color:red;">' + field + ': ' + message + '</p>');
          });
        }
      },
      error: function () {
        alert('Erreur lors de l\'envoi du formulaire.');
      },
    });
  });
}

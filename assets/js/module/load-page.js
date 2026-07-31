import { closeSidebar } from '../modules/sidebar.js';

export const initializeAjaxEvents = () => {
  $(document).ajaxStart(function () {
    $('#progress-container').show();
    $('#progress-bar').css('width', '0%');
  });

  $(document).ajaxSend(function (event, jqxhr) {
    jqxhr.progress = function (event) {
      if (event.lengthComputable) {
        const percentComplete = (event.loaded / event.total) * 100;
        $('#progress-bar').css('width', percentComplete + '%');
      }
    };
  });

  $(document).ajaxComplete(function () {
    $('#progress-bar').css('width', '100%');
    setTimeout(function () {
      $('#progress-container').fadeOut();
    }, 500);
  });
};

export const loadPage = (e, url) => {
  e.preventDefault();

  $.ajax({
    url: url,
    method: 'GET',
    xhr: function () {
      const xhr = new window.XMLHttpRequest();
      xhr.addEventListener('progress', function (event) {
        if (event.lengthComputable) {
          const percentComplete = (event.loaded / event.total) * 100;
          $('#progress-bar').css('width', percentComplete + '%');
        }
      }, false);
      return xhr;
    },
    success: function (data) {
      $('#content').html(data);
      window.history.pushState({ path: url }, '', url);
      closeSidebar();
    },
    error: function (xhr, status, error) {
      console.error('Error fetching data:', error);
    },
  });
};
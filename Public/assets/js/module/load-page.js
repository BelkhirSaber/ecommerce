// All Global Function 

"use strict";

const initializeAjaxEvents = () => {

  // -- show progress bar when page load

  $(document).ajaxStart(function() {
    $("#progress-container").show();
    $("#progress-bar").css("width", "0%");
  });

  $(document).ajaxSend(function(event, jqxhr, settings) {

    jqxhr.progress = function(event) {
        if (event.lengthComputable) {
            var percentComplete = (event.loaded / event.total) * 100;
            $("#progress-bar").css("width", percentComplete + "%");
        }
    }
  });

  $(document).ajaxComplete(function() {
    $("#progress-bar").css("width", "100%");
    setTimeout(function() {
        $("#progress-container").fadeOut();
    }, 500);
  });

}

// -- load page function

const loadPage = (e, url) => {

  // -- Prevent default action

  e.preventDefault();

  // -- Send request

  $.ajax({
    url: url, // URL of your MVC endpoint to fetch data
    method: 'GET',
    xhr: function() {
      var xhr = new window.XMLHttpRequest();
      xhr.addEventListener("progress", function(event) {
          if (event.lengthComputable) {
              var percentComplete = (event.loaded / event.total) * 100;
              $("#progress-bar").css("width", percentComplete + "%");
          }
      }, false);
      return xhr;
    },
    success: function(data) {
      // -- Update UI with fetched data
      
      $('#content').html(data);
      window.history.pushState({ path: url }, '', url);
      closeSidebar();
    },
    error: function(xhr, status, error) {
      console.error('Error fetching data:', error);
    }
  });
}

export {initializeAjaxEvents, loadPage};
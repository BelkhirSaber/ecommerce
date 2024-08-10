"use strict";

const sidebar = document.getElementById('sidebar');
const btnOpenSidebar = document.getElementById('openSidebar');
const btnSidebarBackground = document.getElementById('sidebarBackground');
const btnCloseSidebar = document.getElementById('closeSidebar');
const btnReduceSidebar = document.getElementById('reduceSidebar');

// -- Close Sidebar

const closeSidebar = () => {sidebar.classList.remove('open');};

// -- Show Sidebar

btnOpenSidebar.addEventListener('click', () => {
  sidebar.classList.add('open');
});

// -- Hide Sidebar

btnSidebarBackground.addEventListener('click', closeSidebar);
btnCloseSidebar.addEventListener('click', closeSidebar);

// -- Reduce Sidebar

btnReduceSidebar.addEventListener('click', () => {
  sidebar.classList.toggle('reduce');

  // -- Save state to localStorage
  const isCollapsed = sidebar.classList.contains('reduce');
  localStorage.setItem('sidebarCollapsed', JSON.stringify(isCollapsed));
});

// -- Apply saved state on page load

document.addEventListener('DOMContentLoaded', function() {
  
  const isCollapsed = JSON.parse(localStorage.getItem('sidebarCollapsed'));
  
  if (isCollapsed !== null && isCollapsed) {
    sidebar.classList.add('reduce');
  } else {
    sidebar.classList.remove('reduce');
  }
});

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




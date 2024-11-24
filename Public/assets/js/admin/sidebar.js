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




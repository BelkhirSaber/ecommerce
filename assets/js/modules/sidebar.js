const sidebar = document.getElementById('sidebar');
const btnOpenSidebar = document.getElementById('openSidebar');
const btnSidebarBackground = document.getElementById('sidebarBackground');
const btnCloseSidebar = document.getElementById('closeSidebar');
const btnReduceSidebar = document.getElementById('reduceSidebar');

export const closeSidebar = () => {
  if (sidebar) sidebar.classList.remove('open');
};

export const openSidebar = () => {
  if (sidebar) sidebar.classList.add('open');
};

const reduceSidebar = () => {
  if (!sidebar) return;
  sidebar.classList.toggle('reduce');
  const isCollapsed = sidebar.classList.contains('reduce');
  localStorage.setItem('sidebarCollapsed', JSON.stringify(isCollapsed));
};

if (btnOpenSidebar) {
  btnOpenSidebar.addEventListener('click', openSidebar);
}

if (btnSidebarBackground) {
  btnSidebarBackground.addEventListener('click', closeSidebar);
}

if (btnCloseSidebar) {
  btnCloseSidebar.addEventListener('click', closeSidebar);
}

if (btnReduceSidebar) {
  btnReduceSidebar.addEventListener('click', reduceSidebar);
}

document.addEventListener('DOMContentLoaded', () => {
  if (!sidebar) return;
  const isCollapsed = JSON.parse(localStorage.getItem('sidebarCollapsed'));
  if (isCollapsed) {
    sidebar.classList.add('reduce');
  } else {
    sidebar.classList.remove('reduce');
  }
});

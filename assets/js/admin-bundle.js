import $ from 'jquery';
import 'bootstrap';
import 'admin-lte';
import 'admin-lte/dist/css/adminlte.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import '../css/admin.css';

import DataTable from 'datatables.net-dt';
import frLanguage from './vendor/datatables/fr-FR.json';
import { initializeAjaxEvents, loadPage } from './module/load-page.js';
import { closeSidebar } from './modules/sidebar.js';
import { initImagePreview } from './modules/image-preview.js';
import { initAddProductForm } from './pages/add-product.js';
import './modules/image-fallback.js';

window.$ = $;
window.jQuery = $;
window.loadPage = loadPage;

$(document).ready(function () {
  initializeAjaxEvents();
  initImagePreview();
  initAddProductForm();

  if ($('#admin-dashboard').length) {
    new DataTable('#admin-dashboard', {
      language: frLanguage,
    });
  }
});

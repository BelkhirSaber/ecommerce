'use strict';

// Import des dépendances dans l'ordre correct pour AdminLTE
import $ from 'jquery';
import 'bootstrap';
import 'admin-lte';

// Rendre jQuery global (requis par AdminLTE)
window.$ = $;
window.jQuery = $;

// Import DataTables
import DataTable from 'datatables.net-dt';
DataTable(window, $);

// Import de votre module existant
import { initializeAjaxEvents, loadPage } from './module/load-page.js';

// Initialisation
$(document).ready(function() {
    console.log('AdminLTE + Vite loaded!');
    
    // Ajax initialize events load content of page
    initializeAjaxEvents();
    
    // Attach load page function to the global object window
    window.loadPage = loadPage;
    
    // DataTable initialization
    if ($('#admin-dashboard').length) {
        $('#admin-dashboard').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json'
            }
        });
    }
});
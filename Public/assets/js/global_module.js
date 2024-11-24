import {initializeAjaxEvents, loadPage} from './module/load-page.js';

// Ajax initialize events load content of page
initializeAjaxEvents();

// -- Attach load page function to the global object window
window.loadPage = loadPage;

// // Handle click event of backward and forward browser button
// window.addEventListener('popstate', (event) => {
//   console.log('testing')
//   if (event.state && event.state.path) {
//       loadPage(event, event.state.path);
//   }
// });
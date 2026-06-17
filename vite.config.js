import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  root: 'Public',
  
  build: {
    outDir: 'assets/dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        // Point d'entrée admin (avec AdminLTE, Bootstrap, jQuery)
        admin: path.resolve(__dirname, 'Public/assets/js/admin-bundle.js'),
        // Point d'entrée front-end
        app: path.resolve(__dirname, 'Public/assets/js/app.js'),
        // Module spécifique admin
        adminMain: path.resolve(__dirname, 'Public/assets/js/admin/main.js')
      }
    }
  },
  
  server: {
    port: 5173,
    strictPort: true,
    cors: true
  },
  
  // Optimisations pour AdminLTE
  optimizeDeps: {
    include: ['jquery', 'bootstrap', 'admin-lte', 'datatables.net-dt']
  }
});
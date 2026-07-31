import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  root: 'Public',
  base: '',

  build: {
    outDir: 'assets/dist',
    emptyOutDir: true,
    manifest: 'manifest.json',
    rollupOptions: {
      input: {
        admin: path.resolve(__dirname, 'Public/assets/js/admin-bundle.js'),
        app: path.resolve(__dirname, 'Public/assets/js/app.js'),
      },
    },
  },

  server: {
    port: 5173,
    strictPort: true,
    cors: true,
  },
});

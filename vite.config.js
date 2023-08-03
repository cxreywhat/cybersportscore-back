import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    define: {
        __VUE_I18N_FULL_INSTALL__: true,
        __VUE_I18N_LEGACY_API__: false,
        __INTLIFY_PROD_DEVTOOLS__: false,
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    server: {
        port: 5173,
        host: "0.0.0.0",
        hmr: {
            protocol: 'ws',
            host: 'localhost'
        }
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './src'),
        },
    }
});

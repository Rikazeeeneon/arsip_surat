import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: { // Tambahkan bagian ini
        host: '0.0.0.0',
        hmr: {
            host: '192.168.56.1' // Ganti dengan IP laptop kamu
        },
    },
});

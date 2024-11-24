import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin'; // Check if using default export works

export default defineConfig({
    plugins: [
        laravel.default({ // Use default if laravel is a CommonJS module
            input: ['resources/sass/app.scss', 'resources/js/app.js', 'resources/sass/welcomePage.scss', 'resources/js/shakeDecoration.js'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    }
});
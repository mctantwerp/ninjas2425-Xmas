import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js', 'resources/sass/welcomePage.scss', 'resources/js/shakeDecoration.js', 'resources/js/404.js', 'resources/sass/404.scss', 'resources/js/gsap.js'],
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

import { defineConfig } from 'vite';
import i18n from 'laravel-vue-i18n/vite';
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin';
import * as path from "node:path";

export default defineConfig({
    plugins: [
        vue(),
        i18n(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js')
        },
    }
});

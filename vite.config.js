import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler",
        },
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: [
                "resources/js/app.js",
                "resources/css/app.css",
                "resources/sass/main.sass",
            ],
            refresh: true,
        }),
    ],
});

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
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,

                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
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

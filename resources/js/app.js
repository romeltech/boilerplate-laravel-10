import "./bootstrap";
import "../css/app.css";
import "../sass/main.scss";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./Plugins/routes";
const router = createRouter({
    // history: createWebHistory(process.env.BASE_URL),
    history: createWebHistory(import.meta.env.APP_URL),
    routes,
});

import { createPinia } from "pinia";
const pinia = createPinia();

import vuetify from "./Plugins/vuetify";
// import utilsPlugin from "./Plugins/utilsPlugin";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

// https://stackoverflow.com/questions/72864434/default-persistent-layout-in-laravel-inertia-vite

// inertia route
// https://stackoverflow.com/questions/66106482/route-with-multiple-parameter-inertiajs
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(vuetify)
            .use(router)
            // .use(utilsPlugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: "#000000",
    },
});

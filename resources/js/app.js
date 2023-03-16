import "./bootstrap";
// import "../css/app.css";
import "../sass/main.scss";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";


/**
 * Pinia
 */
import { createPinia } from "pinia";
const pinia = createPinia();


/**
 * Vuetify
 */
import vuetify from "./Plugins/vuetify";


/**
 * Utility plugin
 */
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
            // .use(utilsPlugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: "#C6A92D",
    },
});

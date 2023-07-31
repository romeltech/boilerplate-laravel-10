/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";
const app = createApp({});

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

/**
 * Pinia JS
 */
import { createPinia } from "pinia";
import piniaPluginPersistedState from "pinia-plugin-persistedstate";
const pinia = createPinia();
pinia.use(piniaPluginPersistedState);
app.use(pinia);

/**
 * User Store
 */
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();

/**
 * Vue Router
 */
import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./router/routes";
const router = createRouter({
    // history: createWebHistory(process.env.BASE_URL),
    // history: createWebHistory(import.meta.env.VITE_APP_URL),
    // history: createWebHistory(import.meta.env.APP_URL),
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from, next) => {
    // console.log("to.meta.requiresAuth", to.meta.requiresAuth);
    // console.log("authStore.is_logged_in", authStore.is_logged_in);

    if (to.meta.requiresAuth && !authStore.is_logged_in) {
        // is not logged in
        next("/login");
    } else {
        // check if in login page
        if (to.name === "Login") {
            next("/");
        }

        // is logged in
        if (to.meta.role && to.meta.role == authStore.user.role) {
            next();
        } else if (to.meta.role && to.meta.role !== authStore.user.role) {
            next("/unauthorized");
        } else {
            next();
        }
    }
});
router.afterEach((to, from) => {
    document.title =
        import.meta.env.VITE_APP_NAME + " - " + to.meta.title ||
        import.meta.env.VITE_APP_NAME;
});
app.use(router);

/**
 * Vuetify
 */
import vuetify from "./plugins/vuetify";
app.use(vuetify);

/**
 * App Component
 */
import App from "./App.vue";
app.component("App", App);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount("#app");

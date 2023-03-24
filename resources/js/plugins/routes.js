// import Dashboard from "../components/admin//Dashboard.vue";
// import Users from "../admin//Users.vue";
// import Large from "../admin//Large.vue";
export const routes = [
    /**
     * Auth
     * https://medium.com/@ripoche.b/create-a-spa-with-role-based-authentication-with-laravel-and-vue-js-ac4b260b882f
     *
     * Auth with sanctum
     * https://techvblogs.com/blog/spa-authentication-laravel-9-sanctum-vue3-vite
     */
    {
        path: "/login",
        component: () => import("../auth/Login.vue"),
        name: "Login",
        meta: {
            title: "Login",
        },
    },

    /**
     * Admin routes
     */
    {
        path: "/admin",
        component: () => import("../pages/admin/Dashboard.vue"),
        name: "AdminDashboard",
        meta: {
            title: "Dashboard",
        },
    },

    /**
     * Normal user routes
     */
    {
        path: "/u/dashboard",
        component: () => import("../pages/admin/Dashboard.vue"),
        name: "UserDashboard",
        meta: {
            title: "Dashboard",
        },
    },
    // {
    //     path: "/admin/users",
    //     component: () => import("../admin/Users/Users.vue"),
    //     name: "Users",
    // },
    // {
    //     path: "/admin/test",
    //     component: () => import("../admin/Test.vue"),
    //     name: "Test",
    // },
    // {
    //     path: "/admin/large",
    //     component: () => import("../admin/Large.vue"),
    //     // component: Large, // use this instead if offline mode is required
    //     name: "Large",
    // },
];

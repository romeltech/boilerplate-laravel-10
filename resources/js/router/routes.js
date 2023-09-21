// import Dashboard from "../pages/admin/Dashboard.vue";
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
        path: "/",
        component: () => import("../pages/admin/Dashboard.vue"),
        name: "Home",
        meta: {
            requiresAuth: true,
            role: ["admin", "normal"],
            title: "Home",
        },
    },

    /**
     * Auth Login
     */
    {
        path: "/login",
        component: () => import("../auth/SanctumLogin.vue"),
        name: "Login",
        meta: {
            requiresAuth: false,
            title: "Login",
        },
    },

    /**
     * Admin routes
     */
    {
        path: "/admin",
        component: () => import("../pages/admin/Dashboard.vue"),
        name: "Admin",
        meta: {
            requiresAuth: true,
            role: ["admin", "normal"],
            title: "Dashboard",
        },
    },
    {
        path: "/admin/dashboard",
        component: () => import("../pages/admin/Dashboard.vue"),
        name: "Dashboard",
        meta: {
            requiresAuth: true,
            role: ["admin", "normal"],
            title: "Dashboard",
            // meta: {
            //     middleware: [
            //         isAuthenticated
            //     ]
            // }
        },
    },
    {
        path: "/admin/users",
        component: () => import("../pages/admin/users/Users.vue"),
        name: "Users",
        meta: {
            requiresAuth: true,
            role: ["admin", "normal"],
            title: "Users",
        },
    },
    {
        path: "/admin/users/page/:page",
        component: () => import("../pages/admin/users/Users.vue"),
        name: "PaginatedUsers",
        meta: {
            requiresAuth: true,
            role: ["admin", "normal"],
            title: "Users",
        },
    },

    {
        path: "/admin/users/:id",
        component: () => import("../pages/admin/users/EditUser.vue"),
        name: "EditUser",
        meta: {
            requiresAuth: true,
            role: ["admin", "normal"],
            title: "Edit User",
        },
    },
    {
        path: "/admin/logs",
        component: () => import("../pages/admin/Logs.vue"),
        name: "Logs",
        meta: {
            requiresAuth: true,
            role: ["admin", "normal"],
            title: "Logs",
        },
    },

    /**
     * Studio
     */
    {
        path: "/admin/studio",
        component: () => import("../studio/Studio.vue"),
        name: "Studio",
        meta: {
            title: "Studio",
        },
    },
    {
        path: "/admin/uploader",
        component: () => import("../studio/Uploader.vue"),
        name: "Uploader",
        meta: {
            title: "Uploader",
        },
    },

    /**
     * Normal user routes
     */
    {
        path: "/account",
        component: () => import("../pages/account/Account.vue"),
        name: "Account",
        meta: {
            requiresAuth: true,
            title: "Account",
        },
    },

    /**
     * Normal user routes
     */
    {
        path: "/unauthorized",
        component: () => import("../pages/Unauthorized.vue"),
        name: "Unauthorized",
        meta: {
            requiresAuth: true,
            title: "Unauthorized",
        },
    },
];

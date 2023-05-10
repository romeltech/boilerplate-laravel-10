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

    // {
    //     path: "/",
    //     component: () => import("../App.vue"),
    //     name: "App",
    //     meta: {
    //         title: "App",
    //     },
    // },
    /**
     * Auth Login
     */
    {
        path: "/login",
        component: () => import("../auth/Login.vue"),
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
        // component: Dashboard,
        name: "AdminRoot",
        meta: {
            requiresAuth: true,
            role: "admin",
            title: "Dashboard",
        },
    },
    {
        path: "/admin/dashboard",
        component: () => import("../pages/admin/Dashboard.vue"),
        name: "Dashboard",
        meta: {
            requiresAuth: true,
            role: "admin",
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
            role: "admin",
            title: "Users",
        },
    },
    {
        path: "/admin/users/:id",
        component: () => import("../pages/admin/users/EditUser.vue"),
        name: "EditUser",
        meta: {
            requiresAuth: true,
            role: "admin",
            title: "Edit User",
        },
    },
    {
        path: "/admin/logs",
        component: () => import("../pages/admin/Logs.vue"),
        name: "Logs",
        meta: {
            requiresAuth: true,
            role: "admin",
            title: "Logs",
        },
    },
    {
        path: "/admin/departments",
        component: () => import("../pages/admin/Departments.vue"),
        name: "Departments",
        meta: {
            requiresAuth: true,
            role: "admin",
            title: "Departments",
        },
    },
    {
        path: "/admin/companies",
        component: () => import("../pages/admin/Companies.vue"),
        name: "Companies",
        meta: {
            requiresAuth: true,
            role: "admin",
            title: "Companies",
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

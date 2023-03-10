// import Dashboard from "../Pages/Admin/Dashboard.vue";
// import Users from "../Pages/Admin/Users.vue";
// import Large from "../Pages/Admin/Large.vue";
export const routes = [
    {
        path: "/admin/dashboard",
        component: () => import("../Pages/Admin/Dashboard.vue"),
        name: "Dashboard",
    },
    {
        path: "/admin/users",
        component: () => import("../Pages/Admin/Users/Users.vue"),
        name: "Users",
    },
    {
        path: "/admin/test",
        component: () => import("../Pages/Admin/Test.vue"),
        name: "Test",
    },
    {
        path: "/admin/large",
        component: () => import("../Pages/Admin/Large.vue"),
        // component: Large, // use this instead if offline mode is required
        name: "Large",
    },
];

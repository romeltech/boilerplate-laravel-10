// import Dashboard from "../Pages/Admin/Dashboard.vue";
// import Users from "../Pages/Admin/Users.vue";
export const routes = [
    {
        path: "/admin/dashboard",
        // component: Dashboard,
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
];

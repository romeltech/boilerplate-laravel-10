import { defineStore } from "pinia";

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: {},
        token: "",
    }),
    getters: {
        authUser: (state) => state.user,
        authToken: (state) => state.token,
    },
    actions: {
        setUser(user) {
            this.user = user;
            console.log("setUser called");
        },
        setToken(token) {
            this.token = token;
        },
    },
});

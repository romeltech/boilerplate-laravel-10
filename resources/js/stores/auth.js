import { defineStore } from "pinia";
import { useStorage } from '@vueuse/core'

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: {},
        token: "",
        storage_token: useStorage('token', []),
    }),
    getters: {
        authUser: (state) => state.user,
        authToken: (state) => state.token,
    },
    actions: {
        async getUser(data) {
            this.user = data.user;
            this.token = data.token;
        },
        async setCredentials(data) {
            this.user = data.user;
            this.token = data.token;
        },
        async setUser(user) {
            this.user = user;
        },
        async setToken(token) {
            this.token = token;
            localStorage.setItem("sanctum_server_token", JSON.stringify(token));
        },
    },
});

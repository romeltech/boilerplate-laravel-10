import { defineStore } from "pinia";
import { useLocalStorage, useStorage } from "@vueuse/core";
import CryptoJS from "crypto-js";
// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application

const dk = "mel182";

// decrypt data
const decryptData = (data) => {
    return data
        ? JSON.parse(CryptoJS.AES.decrypt(data, dk).toString(CryptoJS.enc.Utf8))
        : null;
};

// encrypt data
const encryptData = (data) => {
    return CryptoJS.AES.encrypt(JSON.stringify(data), dk).toString();
};

export const useAuthStore = defineStore("authUser", {
    state: () => ({
        auth: useLocalStorage("authUser", {}),
    }),
    getters: {
        user: (state) => {
            return state.auth && state.auth.data
                ? decryptData(state.auth.data).u
                : null;
        },
        token: (state) => {
            return state.auth && state.auth.data
                ? decryptData(state.auth.data).t
                : null;
        },
        authRole: (state) => {
            return state.auth && state.auth.data
                ? decryptData(state.auth.data).r
                : null;
        },
        authIsLoggedIn: (state) => {
            return state.auth && state.auth.data
                ? decryptData(state.auth.data).is_logged_in
                : null;
        },
    },
    actions: {
        async setCredentials(res) {
            // save to localstorage
            useStorage(
                "authUser",
                {
                    data: encryptData({
                        u: res.user,
                        t: res.token ? res.token : null,
                        r: [res.user.role],
                        is_logged_in: true,
                    }),
                },
                localStorage,
                {
                    mergeDefaults: true,
                }
            );
        },
        async logout() {
            // this.auth = null;
            this.auth = {};
        },
    },
});

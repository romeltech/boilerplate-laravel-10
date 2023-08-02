import { defineStore } from "pinia";
import { useLocalStorage, useStorage } from "@vueuse/core";
import CryptoJS from "crypto-js";
// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useAuthStore = defineStore("authUser", {
    state: () => ({
        userData: useLocalStorage("authUser", {}),
        role: [], // app_admin, normal
        is_logged_in: false,
    }),
    getters: {
        authUser: (state) => {
            let userData = null;
            if (state.userData && state.userData.u) {
                let bytes = CryptoJS.AES.decrypt(state.userData.u, "mel182");
                let decryptedData = JSON.parse(
                    bytes.toString(CryptoJS.enc.Utf8)
                );
                userData = decryptedData;
            }
            return userData;
        },
        authToken: (state) => {
            let tokenData = null;
            if (state.userData && state.userData.t) {
                let bytes = CryptoJS.AES.decrypt(
                    state.userData.t,
                    "mel182"
                );
                let decryptedData = JSON.parse(
                    bytes.toString(CryptoJS.enc.Utf8)
                );
                tokenData = decryptedData;

            }
            return tokenData;
        },
        authRole: (state) => state.role,
        authIsLoggedIn: (state) => state.is_logged_in,
    },
    actions: {
        async setCredentials(res) {
            console.log("setCredentials", res);

            // encrypt user data
            let cipherUser = CryptoJS.AES.encrypt(
                JSON.stringify(res.user),
                "mel182"
            ).toString();

            // encrypt token data
            let cipherToken = CryptoJS.AES.encrypt(
                JSON.stringify(res.token),
                "mel182"
            ).toString();

            // save to localstorage
            useStorage(
                "authUser",
                { u: cipherUser, t: cipherToken },
                localStorage,
                {
                    mergeDefaults: true,
                }
            );

            if (res.user && res.token) {
                this.is_logged_in = true;
            }
        },
        async logout() {
            this.userData = null;
            this.is_logged_in = false;
        },
        async setUser(user) {
            this.user = user;
        },
        async setToken(token) {
            this.token = token;
        },
    },
});

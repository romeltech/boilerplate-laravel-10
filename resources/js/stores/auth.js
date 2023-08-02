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
    }),
    getters: {
        user: (state) => {
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
                let bytes = CryptoJS.AES.decrypt(state.userData.t, "mel182");
                let decryptedData = JSON.parse(
                    bytes.toString(CryptoJS.enc.Utf8)
                );
                tokenData = decryptedData;
            }
            return tokenData;
        },
        authRole: (state) => state.userData.r,
        authIsLoggedIn: (state) => state.userData.is_logged_in,
    },
    actions: {
        encryptData(data) {
            // encrypt data
            let cipherText = CryptoJS.AES.encrypt(
                JSON.stringify(data),
                "mel182"
            ).toString();
            return cipherText;
        },
        async setCredentials(res) {
            // save to localstorage
            useStorage(
                "authUser",
                {
                    u: this.encryptData(res.user),
                    t: this.encryptData(res.token),
                    r: [res.user.role],
                    is_logged_in: true,
                },
                localStorage,
                {
                    mergeDefaults: true,
                }
            );
        },
        async logout() {
            useStorage(
                "authUser",
                {
                    u: null,
                    t: null,
                    r: [],
                    is_logged_in: false,
                },
                localStorage,
                {
                    mergeDefaults: true,
                }
            );
        },
    },
});

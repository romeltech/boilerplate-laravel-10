import { defineStore } from "pinia";
import { useStorage } from '@vueuse/core'
import { samctumApi } from "@/services/sacntumApi";

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
        user: {},
        token: "",
        storage_token: localStorage.getItem("sanctum_token")
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
        async checkUser() {
            let data = {
                token: this.storage_token
            }
            await samctumApi
                .get("/sanctum/csrf-cookie")
                .then((res) => {
                    samctumApi
                        .get("api/checkuser",
                            {
                                headers:
                                {
                                    Authorization: `Bearer ${data.token}`,
                                    Accept: 'application/json',
                                }
                            })
                        .then((checkRes) => {
                            this.user = checkRes.data.user;
                        })
                        .catch((err) => {
                            console.log("api/checkuser err", err);
                        });
                })
                .catch((err) => {
                    console.log("csrf-cookie err", err);
                });
        },
        // async login(data) {
        //     await samctumApi
        //         .get("/sanctum/csrf-cookie")
        //         .then((res) => {
        //             samctumApi
        //                 .post("api/sanctumlogin", data)
        //                 .then((loginres) => {
        //                     console.log("loginres", loginres);
        //                     authStore.setCredentials(loginres.data).then(() => {
        //                         loadingLogin.value = false;
        //                         router.push({ path: "/admin" });
        //                     });
        //                 })
        //                 .catch((loginerr) => {
        //                     console.log("loginerr", loginerr);
        //                 });
        //         })
        //         .catch((err) => {
        //             console.log("err", err);
        //         });
        // },
        async setCredentials(data) {
            this.user = data.user;
            this.token = data.token;
            // useStorage(
            //     'sanctum_token',
            //     data.token,
            //     localStorage,
            //     { mergeDefaults: true }
            // )

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

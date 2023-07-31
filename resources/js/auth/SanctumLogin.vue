<template>
    <GuestLayout>
        <v-card
            class="mt-8 pa-3 rounded-lg elevation-3"
            width="90%"
            max-width="450"
        >
            <v-card-title class="px-5 pb-0 primary--text">Login</v-card-title>
            <v-card-text class="py-5">
                <v-form autocomplete="off" ref="form">
                    <v-text-field
                        v-model="credentials.login"
                        variant="outlined"
                        required
                        class="border-radius"
                        autocomplete="off"
                        label="Username or Email"
                    >
                    </v-text-field>
                    <v-text-field
                        v-model="credentials.password"
                        variant="outlined"
                        required
                        autocomplete="off"
                        label="Password"
                        type="password"
                    >
                    </v-text-field>
                    <v-btn
                        @click="login"
                        width="100%"
                        color="primary"
                        height="55"
                        large
                        :loading="loadingLogin"
                        >Login</v-btn
                    >
                </v-form>
            </v-card-text>
        </v-card>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "../layouts/GuestLayout.vue";
import { useRouter } from "vue-router";
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";

import { samctumApi } from "@/services/sacntumApi";

const authStore = useAuthStore();
const router = useRouter();
const credentials = ref({
    login: "",
    password: "",
});
const loadingLogin = ref(false);
const login = async () => {
    loadingLogin.value = true;
    let data = {
        username: credentials.value.login,
        password: credentials.value.password,
    };
    await samctumApi
        .get("/sanctum/csrf-cookie")
        .then((res) => {
            console.log("res", res);
            samctumApi
                .post("api/sanctumlogin", data)
                .then((loginres) => {
                    console.log("loginres", loginres);
                    authStore.setCredentials(loginres.data).then(() => {
                        loadingLogin.value = false;
                        router.push({ path: "/admin" });
                    });
                })
                .catch((loginerr) => {
                    console.log("loginerr", loginerr);
                });
        })
        .catch((err) => {
            console.log("err", err);
        });
};
</script>

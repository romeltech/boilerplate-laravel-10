<template>
  <GuestLayout>
    <div
      class="mx-auto px-3 text-center"
      style="z-index: 1; max-width: 400px; width: 100%; margin-top: 100px"
    >
      <WhiteLogo width="100%" />
      <div class="text-subtitle-1 text-white">{{ appName }}</div>
    </div>

    <v-card class="mt-8 pa-3 rounded-lg elevation-3" width="90%" max-width="450">
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
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { authApi } from "@/services/sacntumApi";
import GuestLayout from "../layouts/GuestLayout.vue";
import WhiteLogo from "@/Components/logo/WhiteLogo.vue";

const appName = ref(import.meta.env.VITE_APP_NAME);

// login
const authStore = useAuthStore();
const router = useRouter();
const credentials = ref({
  login: "admin",
  password: "admin@112211",
});
const loadingLogin = ref(false);
const login = async () => {
  loadingLogin.value = true;
  authLogin()
    .then((res) => {
      saveClientKey(res.data);
    })
    .catch((err) => {
      loadingLogin.value = false;
      console.log("error while trying to login to server", err);
    });
};

// auth login to sanctum
const authLogin = async () => {
  let data = {
    username: credentials.value.login,
    password: credentials.value.password,
  };
  const response = await authApi.post("/api/sanctumlogin", data);
  return response;
};

// save client key
const saveClientKey = async (data) => {
  let ckData = {
    key: data.token,
    user_id: data.user.id,
  };
  const response = await axios.post("/client/savekey", ckData);
  if (response) {
    authStore.setCredentials(data).then(() => {
      loadingLogin.value = false;
      router.push({ path: "/admin" });
    });
  }
  return response;
};
</script>

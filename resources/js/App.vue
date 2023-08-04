<template>
  <div>
    <Normal v-if="authStore.authIsLoggedIn == true" />
    <Public v-else />
    <!-- <div
      v-if="settingStore.pageLoading.status"
      style="
        position: fixed;
        top: 0;
        left: auto;
        right: auto;
        bottom: auto;
        width: 100%;
        height: 100vh;
        z-index: 100000;
      "
    >
      <v-card class="w-100 h-screen d-flex flex-column align-center justify-center">
        <v-progress-circular
          class="mb-3"
          indeterminate
          color="secondary"
        ></v-progress-circular>
        <div class="text-body-1">{{ settingStore.pageLoading.msg }}</div>
      </v-card>
    </div> -->
  </div>
</template>
<script setup>
import { defineAsyncComponent } from "vue";
import { useAuthStore } from "@/stores/auth";
import { axiosWithBearer } from "@/services/sacntumApi";
import { useRouter } from "vue-router";
// import { useSettingStore } from "@/stores/settings";
const Public = defineAsyncComponent(() => import("./portals/Public.vue"));
const Normal = defineAsyncComponent(() => import("./portals/Normal.vue"));

const router = useRouter();
const authStore = useAuthStore();
// const settingStore = useSettingStore();

// get user when refreshed
const refreshAuth = async () => {
  //   settingStore.setPageLoading(true);
  await axiosWithBearer(authStore.token)
    .get("/api/checkuser")
    .then((res) => {
      console.log("api/checkuser", res);
      // update the user token in pinia
      //   authStore.saveClientKey(res.data).then((keyResponse) => {
      //     settingStore.setPageLoading(false);
      //     settingStore.setIsFromLogin(false);
      //     settingStore.setPmsSettings(keyResponse.data.pms_settings);
      //     settingStore.setAllSettings(keyResponse.data.all_settings);
      //   });
    })
    .catch((err) => {
      console.log("error", err.response.status);
      // if error 401 unauthorize
      if (err.response.status == 401) {
        // logout user and redirect to login
        localStorage.removeItem("authUser");
        router.push({ path: "/login" });
      }
      //   settingStore.setPageLoading(false);
    });
};

// console.log("App", authStore.auth, authStore.auth.is_logged_in);
// if (authStore.auth && authStore.auth.is_logged_in && authStore.auth.is_logged_in == false) {
//   console.log("authStore.auth", authStore.auth);
//   console.log("authStore.auth.is_logged_id", authStore.auth.is_logged_id);
// }
refreshAuth();
</script>

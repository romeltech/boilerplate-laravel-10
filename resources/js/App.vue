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
import { useSettingStore } from "@/stores/settings";
const Public = defineAsyncComponent(() => import("./portals/Public.vue"));
const Normal = defineAsyncComponent(() => import("./portals/Normal.vue"));
const authStore = useAuthStore();
const settingStore = useSettingStore();
</script>

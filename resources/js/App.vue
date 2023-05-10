<template>
  <div>
    <Admin v-if="authUser && authUser.role == 'admin'" />
    <Normal v-else-if="authUser && authUser.role == 'normal'" />
    <Public v-else />
  </div>
</template>
<script setup>
import { computed, defineAsyncComponent } from "vue";
import { useAuthStore } from "@/stores/auth";
const Public = defineAsyncComponent(() => import("./portals/Public.vue"));
const Admin = defineAsyncComponent(() => import("./portals/Admin.vue"));
const Normal = defineAsyncComponent(() => import("./portals/Normal.vue"));

// authenticated user object
const authStore = useAuthStore();
const authUser = computed(() => {
  return authStore.user;
});
</script>

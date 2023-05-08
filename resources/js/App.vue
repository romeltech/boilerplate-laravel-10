<script setup>
import { computed, defineAsyncComponent } from "vue";
import { useAuthStore } from "@/stores/auth";
const Public = defineAsyncComponent(() => import("./portals/Public.vue"));
const Admin = defineAsyncComponent(() => import("./portals/Admin.vue"));
const authStore = useAuthStore();

// authenticated user object
const authUser = computed(() => {
  return authStore.user;
});

console.log(authUser.value);
</script>

<template>
  <div>
    <Admin v-if="authUser && authUser.role == 'admin'" />
    <Public v-else />
  </div>
</template>

<script setup>
import { watch } from "vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const prop = defineProps({
  auth: {
    type: Object,
    default: null,
  },
});
// set auth in pinia js
authStore.setUser(prop.auth);

// watch for changes
watch(prop, () => {
  authStore.setUser(prop.auth);
});
</script>

<template>
  <div>
    <AdminLayout v-if="authStore.user.role == 'admin'">
      <router-view />
    </AdminLayout>
  </div>
</template>

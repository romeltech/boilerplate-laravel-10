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
    <div v-if="authStore.user && authStore.user.role && authStore.user.role == 'admin'">
      <AdminLayout>
        <router-view></router-view>
      </AdminLayout>
    </div>
    <div v-else>
      <router-view></router-view>
    </div>
  </div>
</template>

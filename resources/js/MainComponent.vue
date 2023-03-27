<template>
    <div>
        <div v-if="is_authed">
            <AdminLayout>
                <router-view />
            </AdminLayout>
        </div>
        <div v-else>
            <router-view />
        </div>
    </div>
</template>

<script setup>
import { watch, computed } from "vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
// const prop = defineProps({
//     auth: {
//         type: Object,
//         default: null,
//     },
// });
// set auth in pinia js
// authStore.setUser(prop.auth);

// watch for changes
watch(prop, () => {
    authStore.setUser(prop.auth);
    localStorage.setItem("sanctum_server_token", JSON.stringify(data.token));
});

const is_authed = computed(() => {
    return authStore.user;
});
</script>

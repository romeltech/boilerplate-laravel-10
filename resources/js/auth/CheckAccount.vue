<template>
    <div>
        checking...
    </div>
</template>

<script setup>
import { watch, computed, ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const router = useRouter();
const is_authed = computed(() => {
    return authStore.user.hasOwnProperty('id') ?? true;
});
// watch(authStore, (newState, oldState) => {
//     if (newState.authUser.hasOwnProperty('id')) {
//         router.push('/admin').catch((err) => { });
//     } else {
//         authStore.checkUser();
//         if (is_authed.value == true) {
//             router.push('/admin');
//         } else {
//             router.push('/access').catch((err) => { });
//         }
//     }
// }, { deep: true })
onMounted(() => {
    if (is_authed.value == true) {
        router.push('/admin');
    } else {
        router.push('/access').catch((err) => { });
    }
})
</script>

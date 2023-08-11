<template>
  <div>
    <div v-if="authStore.authIsLoggedIn == true">
      <LoggedInLayout>
        <router-view></router-view>
      </LoggedInLayout>
    </div>
    <div v-else>
      <router-view></router-view>
    </div>
  </div>
</template>
<script setup>
import { useAuthStore } from "@/stores/auth";
import { axiosToken } from "@/services/axiosToken";
import { useRouter } from "vue-router";
import LoggedInLayout from "@/layouts/LoggedInLayout.vue";
const router = useRouter();
const authStore = useAuthStore();
// get user when refreshed
const refreshAuth = async () => {
  console.log("refreshAuth");
  await axiosToken(authStore.token)
    .get("/api/checkuser")
    .then((res) => {
      authStore
        .setCredentials({
          user: res.data.user,
          token: authStore.token,
        })
        .then(() => {
          router.push({ path: "/admin" });
        });
    })
    .catch((err) => {
      console.log("refreshAuth error: ", err.response.status);
      // if error 401 unauthorize
      if (err.response.status == 401) {
        // logout user and redirect to login
        localStorage.removeItem("authUser");
        router.push({ path: "/login" });
      }
    });
};
if (authStore && authStore.authIsLoggedIn && authStore.authIsLoggedIn == false) {
  refreshAuth();
}
</script>

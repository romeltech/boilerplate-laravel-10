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
import { useTheme } from "vuetify";
const theme = useTheme();
const router = useRouter();
const authStore = useAuthStore();

// check user
const checkUser = async () => {
  await axiosToken(authStore.token)
    .get("/api/checkuser")
    .then((res) => {
      authStore
        .setCredentials({
          user: res.data.user,
          token: authStore.token,
        })
        .then(() => {
          //   router.push({ path: "/admin" });
        });
    })
    .catch((err) => {
      // if error 401 unauthorize
      if (err.response.status == 401) {
        // logout user and redirect to login
        localStorage.removeItem("authUser");
        router.push({ path: "/login" });
      }
    });
};
if (authStore || authStore.authIsLoggedIn || authStore.authIsLoggedIn == false) {
  checkUser();
}

// set dark mode on load
const gagDarkTheme = localStorage.getItem("gag_dark_theme");
if (gagDarkTheme) {
  theme.global.name.value = gagDarkTheme;
} else {
  theme.global.name.value = "light";
  localStorage.setItem("gag_dark_theme", theme.global.name.value);
}

// pusher beams
// import * as PusherPushNotifications from "@pusher/push-notifications-web";
// const beamsClient = new PusherPushNotifications.Client({
//   instanceId: "a9bdb868-c750-495a-9107-128cccb629d6",
// });
// beamsClient
//   .start()
//   .then((beamsClient) => beamsClient.getDeviceId())
//   .then((deviceId) =>
//     console.log("Successfully registered with Beams. Device ID:", deviceId)
//   )
//   .then(() => beamsClient.addDeviceInterest("hello"))
//   .then(() => beamsClient.getDeviceInterests())
//   .then((interests) => console.log("Current interests:", interests))
//   .catch(console.error);
</script>

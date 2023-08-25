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

// FCM
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";

// import { initializeApp } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-app.js";
// import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-analytics.js";
// import { messaging } from "https://www.gstatic.com/firebasejs/10.3.0/firebase-messaging.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBbSEk8U21SAh0z8Od6p9n-T6wCVNlJ2Ak",
  authDomain: "push-notification-7f303.firebaseapp.com",
  projectId: "push-notification-7f303",
  storageBucket: "push-notification-7f303.appspot.com",
  messagingSenderId: "451607915135",
  appId: "1:451607915135:web:0e8049b2f05d6535d7ed4a",
  measurementId: "G-X30478C2Q2",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// const analytics = getAnalytics(app);
const appMessaging = getMessaging(app);

// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
getToken(appMessaging, { vapidKey: 'BDAh4xN7lndvg7C5rFvQLK-CTZQnXG7msnkUfdh_uqPLjf0ogqVyenE1i58U26P-FUnoOVAScjDvxtzsEyKN74o' }).then((currentToken) => {
  if (currentToken) {
    // Send the token to your server and update the UI if necessary
    // ...
    console.log("currentToken", currentToken);
  } else {
    // Show permission request UI
    console.log('No registration token available. Request permission to generate one.');
    // ...
  }
}).catch((err) => {
  console.log('An error occurred while retrieving token. ', err);
  // ...
});

// getToken(messaging, { vapidKey: '<YOUR_PUBLIC_VAPID_KEY_HERE>' }).then((currentToken) => {
//   if (currentToken) {
//     // Send the token to your server and update the UI if necessary
//     // ...
//   } else {
//     // Show permission request UI
//     console.log('No registration token available. Request permission to generate one.');
//     // ...
//   }
// }).catch((err) => {
//   console.log('An error occurred while retrieving token. ', err);
//   // ...
// });

// function initFirebaseMessagingRegistration() {
//   appMessaging
//     .requestPermission()
//     .then(function () {
//       return appMessaging.getToken();
//     })
//     .then(function (token) {
//       axios
//         .post("/fcm-token", {
//           token,
//         })
//         .then(({ data }) => {
//           console.log(data);
//         })
//         .catch(({ response: { data } }) => {
//           console.error(data);
//         });
//     })
//     .catch(function (err) {
//       console.log(`Token Error :: ${err}`);
//     });
// }
// initFirebaseMessagingRegistration();

// appMessaging.onMessage(function ({ data: { body, title } }) {
//   new Notification(title, { body });
// });
</script>

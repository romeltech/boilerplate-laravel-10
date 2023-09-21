<template>
  <div>
    <v-navigation-drawer
      :rail="temporary == true ? false : rail"
      v-model="drawer"
      :temporary="temporary"
      :permanent="!temporary"
      class="pt-4"
      color="black"
    >
      <div class="d-flex flex-column h-100">
        <v-list-item
          nav
          :prepend-avatar="logo"
          :title="appName"
          class="mb-3"
        ></v-list-item>
        <v-divider></v-divider>
        <v-list nav>
          <div v-for="item in sideNavigation" :key="item.title" :value="item.title">
            <v-list-group v-if="item.subs" :value="item.title">
              <template v-slot:activator="{ props }">
                <v-list-item
                  nav
                  v-bind="props"
                  :prepend-icon="item.icon"
                  :title="item.title"
                ></v-list-item>
              </template>
              <div class="bg-grey-darken-4" style="border-radius: 4px">
                <v-list-item
                  density="compact"
                  style="padding-left: 12px !important"
                  v-for="(sub, i) in item.subs"
                  :key="i"
                  :title="sub.title"
                  :value="sub.title"
                  @click="() => openPage(sub.path)"
                >
                  <template v-slot:title>
                    <div style="font-size: 12px">{{ sub.title }}</div>
                  </template>
                  <template v-slot:prepend>
                    <v-icon size="16" :icon="sub.icon"></v-icon>
                  </template>
                </v-list-item>
              </div>
            </v-list-group>
            <v-list-item
              v-else
              :prepend-icon="item.icon"
              :title="item.title"
              :value="item.title"
              @click="() => openPage(item.path)"
            ></v-list-item>
          </div>
        </v-list>
        <v-divider></v-divider>
        <v-list nav class="mt-auto">
          <v-list-item
            :prepend-icon="rail == false ? mdiChevronLeft : mdiChevronRight"
            title="Collapse"
            @click="rail = !rail"
          ></v-list-item>
        </v-list>
        <!-- <v-btn
          v-if="mobile == false"
          icon
          color="transparent"
          @click="navStore.toggleDrawer"
          class="mr-1 mb-3"
        >
          <v-icon
            color="white"
            :icon="navStore.railState == false ? mdiChevronLeft : mdiChevronRight"
          ></v-icon>
        </v-btn> -->
      </div>
    </v-navigation-drawer>
    <v-app-bar density="compact" color="white" elevation="0">
      <template v-slot:prepend>
        <div class="d-flex align-center">
          <v-app-bar-nav-icon
            v-if="mobile == true"
            @click="drawer = !drawer"
            size="small"
          ></v-app-bar-nav-icon>
          <div class="ml-1 text-body-1 text-pirmary">
            {{ appName }}
          </div>
        </div>
      </template>
      <v-spacer></v-spacer>
      <v-btn
        size="36"
        class="mr-2"
        color="grey-darken-1"
        @click="toggleTheme"
        :icon="`${
          theme.global.name.value == 'light' ? mdiWeatherNight : mdiWhiteBalanceSunny
        }`"
      >
      </v-btn>
      <v-btn size="36" class="mr-2" color="grey-darken-1" :icon="mdiBellOutline"> </v-btn>
      <v-menu v-model="menu" :close-on-content-click="false" location="bottom">
        <template v-slot:activator="{ props }">
          <v-avatar
            :color="`${
              theme.global.name.value == 'light' ? 'grey-lighten-4' : 'grey-darken-4'
            }`"
            :size="36"
            class="mr-3"
            v-bind="props"
            style="cursor: pointer"
          >
            {{ printInitials(authStore.user.username) }}
          </v-avatar>
        </template>
        <v-card min-width="300" class="rounded-lg mt-1">
          <div class="d-flex align-center pa-3">
            <v-avatar
              color="grey-lighten-3"
              :size="36"
              class="d-flex align-center justify-center mr-3"
              style="cursor: pointer"
            >
              <div>{{ printInitials(authStore.user.username) }}</div>
            </v-avatar>
            <div>
              <div class="text-body-1">{{ authStore.user.username }}</div>
              <div class="text-caption">{{ authStore.user.email }}</div>
            </div>
          </div>
          <v-divider></v-divider>
          <v-list nav density="compact" class="d-flex flex-column">
            <v-list-item
              :prepend-icon="mdiAccount"
              title="Account Settings"
              @click="() => openPage('/account')"
            ></v-list-item>
          </v-list>
          <v-divider></v-divider>
          <div class="pa-3">
            <v-btn :loading="loadingLogout" @click="logout" width="100%" color="primary">
              Logout
            </v-btn>
          </div>
        </v-card>
      </v-menu>
    </v-app-bar>
    <v-main>
      <!-- <v-btn @click="sendNotification"> Send Notification </v-btn> -->
      <slot />
    </v-main>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useDisplay } from "vuetify";
import {
  mdiChevronLeft,
  mdiChevronRight,
  mdiHomeOutline,
  mdiBellOutline,
  mdiAccount,
  mdiCog,
  mdiPlaylistEdit,
  mdiAccountGroup,
  mdiWhiteBalanceSunny,
  mdiWeatherNight,
} from "@mdi/js";
import { useAuthStore } from "@/stores/auth";
import { printInitials } from "@/composables/printInitials";
import { useRouter } from "vue-router";
import axios from "axios";
import { useTheme } from "vuetify";
import { axiosToken } from "@/services/axiosToken";

const theme = useTheme();
const appName = ref(import.meta.env.VITE_APP_NAME);
const logo = ref(import.meta.env.VITE_APP_URL + "/assets/images/fav.png");

// toggle dark mode
const toggleTheme = () => {
  theme.global.name.value = theme.global.current.value.dark ? "light" : "dark"; // toggle
  localStorage.setItem("gag_dark_theme", theme.global.name.value);
};

// navigatio
const authStore = useAuthStore();
const router = useRouter();
const sideNavigation = ref([
  {
    title: "Dashboard",
    icon: mdiHomeOutline,
    path: "/admin",
  },

  {
    title: "Admin",
    icon: mdiCog,
    subs: [
      {
        title: "Users",
        icon: mdiAccountGroup,
        path: "/admin/users",
      },
      {
        title: "Logs",
        icon: mdiPlaylistEdit,
        path: "/admin/logs",
      },
    ],
  },
]);
const openPage = (openPath) => {
  menu.value = false;
  router
    .push({
      path: openPath,
    })
    .catch((err) => {});
};

// app orientation
const { mobile } = useDisplay();
const menu = ref(false);
const rail = ref(true);
const drawer = ref(true);
const temporary = ref(false);
watch(mobile, async (newMobileValue, oldMobileValue) => {
  if (newMobileValue == true) {
    drawer.value = false;
    temporary.value = true;
  } else {
    drawer.value = true;
    temporary.value = false;
  }
});
onMounted(() => {
  if (mobile.value == true) {
    drawer.value = false;
    temporary.value = true;
  } else {
    drawer.value = true;
    temporary.value = false;
  }
});

// logout
const loadingLogout = ref(false);
const logout = async () => {
  loadingLogout.value = true;
  let data = {
    username: authStore.user.username,
  };
  await axios
    .post("/api/sanctumlogout", data)
    .then(() => {
      authStore.logout().then(() => {
        // localStorage.removeItem('authUser');
        loadingLogout.value = false;
        router.push({ path: "/login" });
      });
    })
    .catch((err) => {
      console.log("api/sanctumlogout error: ", err);
    });
};

// FCM
const setFirebaseToken = async (fcmToken) => {
  await axiosToken(authStore.token)
    .post("/api/set-token", { fcm_token: fcmToken })
    .then((res) => {
      console.log("setFirebaseToken", res);
    })
    .catch((err) => {
      console.log(err.response.data);
    });
};

const sendNotification = async () => {
  console.log("sendNotification");
  await axiosToken(authStore.token)
    .post("/api/send-notification")
    .then((res) => {
      console.log("sendNotification", res);
    })
    .catch((err) => {
      console.log(err.response.data);
    });
};

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

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

function requestPermission() {
  console.log("Requesting permission...");
  Notification.requestPermission().then((permission) => {
    if (permission === "granted") {
      console.log("Notification permission granted.");
    }
  });
}

// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
getToken(appMessaging, {
  vapidKey:
    "BDAh4xN7lndvg7C5rFvQLK-CTZQnXG7msnkUfdh_uqPLjf0ogqVyenE1i58U26P-FUnoOVAScjDvxtzsEyKN74o",
})
  .then((currentToken) => {
    if (currentToken) {
      // Send the token to your server and update the UI if necessary
      console.log("currentToken", currentToken);
      setFirebaseToken(currentToken);
    } else {
      // Show permission request UI
      console.log("No registration token available. Request permission to generate one.");
      requestPermission();
    }
  })
  .catch((err) => {
    console.log("An error occurred while retrieving token. ", err);
    // ...
  });

// appMessaging.onMessage(function ({ data: { body, title } }) {
//   new Notification(title, { body });
// });
onMessage(appMessaging, function ({ notification }) {
  new Notification(notification.title, {
    body: notification.body,
    icon: "https://romel.tech/ri-fav.png",
    badge: "https://romel.tech/ri-fav.png",
  });
  // ...
});
</script>

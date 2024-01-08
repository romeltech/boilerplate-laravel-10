<template>
  <v-app>
    <v-navigation-drawer
      :rail="temporary == true ? false : rail"
      v-model="drawer"
      :temporary="temporary"
      :permanent="!temporary"
      class="pt-4"
      color="black"
      :expand-on-hover="false"
    >
      <div class="d-flex flex-column" style="height: 100%">
        <v-list-item nav :title="appName" class="mb-3">
          <template v-slot:prepend>
            <v-avatar size="40">
              <v-img :src="logo"></v-img>
            </v-avatar>
          </template>
        </v-list-item>
        <v-divider></v-divider>
        <div class="overflow-y-auto gag-scroll" style="height: calc(100% - 120px)">
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
        </div>
        <v-divider></v-divider>
        <v-list nav>
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
          <div class="ml-1 text-body-1 text-primary">
            {{ appName + " - Admin Panel" }}
          </div>
        </div>
      </template>
      <v-spacer></v-spacer>
      <!-- <v-btn size="36" class="mx-2" icon variant="flat">
        <v-icon color="grey-darken-1" :icon="mdiBellOutline"></v-icon>
      </v-btn> -->
      <v-menu v-model="menu" :close-on-content-click="false" location="bottom">
        <template v-slot:activator="{ props }">
          <v-avatar
            color="grey-lighten-3"
            :size="36"
            class="d-flex align-center justify-center mr-3"
            v-bind="props"
            style="cursor: pointer"
          >
            <div>{{ usePrintInitials(authStore.user.username) }}</div>
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
              <div>{{ usePrintInitials(authStore.user.username) }}</div>
            </v-avatar>
            <div>
              <div class="text-body-1">{{ authStore.user.username }}</div>
              <div class="text-caption">{{ authStore.user.email }}</div>
            </div>
          </div>
          <!-- <v-divider></v-divider>
          <v-list nav density="compact" class="d-flex flex-column">
            <v-list-item
              :prepend-icon="mdiAccount"
              title="Account Settings"
              @click="() => openPage('Account')"
            ></v-list-item>
          </v-list> -->
          <v-divider></v-divider>
          <div class="pa-3">
            <v-btn @click="logout" :loading="loadingLogout" width="100%" color="primary">
              Logout
            </v-btn>
          </div>
        </v-card>
      </v-menu>
    </v-app-bar>
    <v-main>
      <slot />
    </v-main>
  </v-app>
</template>

<script setup>
import {usePrintInitials} from "@/Composables/printInitials"
import { ref, onMounted, watch } from "vue";
import { Link } from "@inertiajs/vue3";
import { useDisplay } from "vuetify";

import { mdiChevronLeft } from "@mdi/js";
import { mdiHomeOutline } from "@mdi/js";
import { mdiBellOutline } from "@mdi/js";
import { mdiAccountGroup } from "@mdi/js";
// import route from "vendor/tightenco/ziggy/src/js";

import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
if (!authStore.user && !authStore.user.hasOwnProperty("id")) {
  authStore.setToken("melmelmel");
  authStore.setUser({
    id: 1,
    username: "melmelmel",
    email: "melmelmel@gmail.com",
  });
}

const { mobile } = useDisplay();
const appName = ref(import.meta.env.VITE_APP_NAME);
const logo = ref(window.location.origin + "/assets/images/fav.png");
const menu = ref(false);
const drawer = ref(true);
const rail = ref(false);
const temporary = ref(false);
const sideNavigation = ref([
  {
    title: "Dashboard",
    icon: mdiHomeOutline,
    // path: "/admin/dashboard",
    // path: "admin.dashboard",
    path: "Dashboard",
  },
  {
    title: "Users",
    icon: mdiAccountGroup,
    // path: "/admin/users",
    // path: "admin.users",
    path: "Users",
  },
  {
    title: "Test",
    icon: mdiAccountGroup,
    // path: "/admin/users",
    // path: "admin.users",
    path: "Test",
  },
  {
    title: "Large",
    icon: mdiAccountGroup,
    // path: "/admin/users",
    // path: "admin.users",
    path: "Large",
  },
]);
const openPage = (path) => {
  //   this.$router.push({ name: "user", params: { userId: "123" } });
  //   console.log($inertia);
  //   this.$inertia.put(route("rooms.update", { room: this.editingRoomUuid }), this.form);
  //   console.log($page.props);
  //   route(path);
};
const logout = () => {
  console.log("logout");
};
watch(mobile, async (newMobileValue, oldMobileValue) => {
  if (newMobileValue == true) {
    drawer.value = false;
    rail.value = false;
    temporary.value = true;
  } else {
    drawer.value = true;
    rail.value = true;
    temporary.value = false;
  }
});
onMounted(() => {
  if (mobile.value == true) {
    drawer.value = false;
    rail.value = false;
    temporary.value = true;
  } else {
    drawer.value = true;
    rail.value = true;
    temporary.value = false;
  }
});
</script>

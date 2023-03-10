<script setup>
import { ref, onMounted, watch } from "vue";
import { Link } from "@inertiajs/vue3";
import { useDisplay } from "vuetify";

import { mdiChevronLeft } from "@mdi/js";
import { mdiHomeOutline } from "@mdi/js";
import { mdiBellOutline } from "@mdi/js";
import { mdiAccountGroup } from "@mdi/js";
// import route from "vendor/tightenco/ziggy/src/js";

import { useRouter, useRoute } from "vue-router";
const router = useRouter();

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
  router.push({ name: path }).catch((e) => {
    console.log("error", e);
  });
  //   this.$router.push({ name: "user", params: { userId: "123" } });
  //   console.log($inertia);
  //   this.$inertia.put(route("rooms.update", { room: this.editingRoomUuid }), this.form);
  //   console.log($page.props);
  //   route(path);
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
<template>
  <v-app id="inspire">
    <v-navigation-drawer
      :rail="rail"
      v-model="drawer"
      :temporary="temporary"
      :permanent="rail"
      class="pt-4"
      color="primary"
      @click="rail = false"
    >
      <v-list-item :prepend-avatar="logo" :title="appName" nav class="mb-3">
        <template v-slot:append>
          <v-btn
            v-if="mobile == false"
            variant="text"
            size="small"
            :icon="mdiChevronLeft"
            @click.stop="rail = !rail"
          ></v-btn>
        </template>
      </v-list-item>
      <v-divider></v-divider>
      <v-list nav>
        <!-- <Link
          v-for="item in sideNavigation"
          :key="item.title"
          :href="item.path"
          class="text-white text-decoration-none"
        >
          <v-list-item
            :prepend-icon="item.icon"
            :title="item.title"
            :value="item.title"
          ></v-list-item>
        </Link> -->
        <!-- -->

        <v-list-item
          v-for="item in sideNavigation"
          :key="item.title"
          :prepend-icon="item.icon"
          :title="item.title"
          :value="item.title"
          @click="() => openPage(item.path)"
        ></v-list-item>
      </v-list>
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
      <v-btn size="36" class="mx-2" icon variant="flat">
        <v-icon color="grey-darken-1" :icon="mdiBellOutline"></v-icon>
      </v-btn>
      <v-menu v-model="menu" :close-on-content-click="false" location="bottom">
        <template v-slot:activator="{ props }">
          <v-avatar
            color="grey-lighten-3"
            :size="36"
            class="d-flex align-center justify-center mr-3"
            v-bind="props"
            style="cursor: pointer"
          >
            <div>RI</div>
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
              <div>RI</div>
            </v-avatar>
            <div>
              <div class="text-body-1">Romel Indemne</div>
              <div class="text-caption">romel.i@gagroup.net</div>
            </div>
          </div>
          <div class="pa-3 mt-3">
            <Link
              :href="route('logout')"
              method="post"
              as="v-btn"
              class="text-decoration-none"
            >
              <v-btn width="100%" color="primary"> Logout </v-btn>
            </Link>
          </div>
        </v-card>
      </v-menu>
    </v-app-bar>
    <!-- Page Content -->
    <v-main style="background-color: #fafafa">
      <slot />
    </v-main>
  </v-app>
</template>

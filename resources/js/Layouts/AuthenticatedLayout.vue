<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

import { mdiAccount } from "@mdi/js";
import { mdiChevronLeft } from "@mdi/js";
import { mdiMapMarker } from "@mdi/js";
import { mdiAlertCircleOutline } from "@mdi/js";


const showingNavigationDropdown = ref(false);

const baseURL = window.location.origin;
const sideNavigation = ref([
  {
    title: "Tickets",
    icon: mdiAlertCircleOutline,
  },
  {
    title: "Location",
    icon: mdiMapMarker,
  },
  {
    title: "Account",
    icon: mdiAccount,
  },
]);

const drawer = ref(true);
const rail = ref(true);
</script>

<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :rail="rail"
      permanent
      class="pt-4"
      color="primary"
      @click="rail = false"
    >
      <v-list-item
        prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
        title="John Leider"
        nav
        class="mb-3"
      >
        <template v-slot:append>
          <v-btn
            variant="text"
            size="small"
            :icon="mdiChevronLeft"
            @click.stop="rail = !rail"
          ></v-btn>
        </template>
      </v-list-item>

      <v-divider></v-divider>

      <v-list nav>
        <v-list-item
          v-for="item in sideNavigation"
          :key="item.name"
          :prepend-icon="item.icon"
          :title="item.title"
          :value="item.title"
        ></v-list-item>
      </v-list>
      <!-- <v-img
        class="d-flex align-center justify-center px-1 mx-auto mb-5"
        :src="baseURL + '/assets/images/fav.png'"
        alt="GAG"
        style="max-width: 50px"
      ></v-img> -->

      <!-- <v-btn size="x-small" icon class="d-block text-center mx-auto mb-9">
        <v-icon :icon="mdiAccount" />
      </v-btn> -->
    </v-navigation-drawer>
    <!-- Page Content -->

    <v-main>
      <div>
        <slot />
      </div>
    </v-main>
  </v-app>
</template>

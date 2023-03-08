<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import { mdiBell } from "@mdi/js";
const props = defineProps({
  title: {
    type: String,
    default: "Ghassan Aboud Groups",
  },
});

const menu = ref(false);
</script>
<template>
  <Head :title="title" />
  <v-app-bar density="compact" color="transparent" elevation="0">
    <!-- <template v-slot:prepend>
        <v-app-bar-nav-icon size="small"></v-app-bar-nav-icon>
      </template> -->
    <v-app-bar-title class="text-subtitle-1">{{ title }}</v-app-bar-title>
    <v-spacer></v-spacer>
    <v-btn size="36" class="mx-2" color="grey-lighten-3" icon variant="flat">
      <v-icon color="grey-darken-1" size="small" :icon="mdiBell"></v-icon>
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
        <v-list>
          <v-list-item
            prepend-avatar="https://cdn.vuetifyjs.com/images/john.jpg"
            title="John Leider"
            subtitle="Founder of Vuetify"
          >
          </v-list-item>
        </v-list>
        <!-- <v-divider></v-divider> -->
        <!-- <v-list>
          <v-list-item>
            <v-switch
              v-model="message"
              color="purple"
              label="Enable messages"
              hide-details
            ></v-switch>
          </v-list-item>
          <v-list-item>
            <v-switch
              v-model="hints"
              color="purple"
              label="Enable hints"
              hide-details
            ></v-switch>
          </v-list-item>
        </v-list> -->
        <div class="pa-2 mt-3">
          <Link :href="route('logout')" method="post">
            <v-btn width="100%" color="primary"> Logout </v-btn>
          </Link>
        </div>
      </v-card>
    </v-menu>
  </v-app-bar>
</template>

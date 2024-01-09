<script setup>
import { Head } from "@inertiajs/vue3";
const props = defineProps({
  title: {
    type: String,
    default: "Dashboard",
  },
});
</script>
<template>
  <Head :title="title" />
  <v-app-bar density="compact" color="app-background" elevation="0">
    <div class="px-4 d-flex align-center">
      <div class="text-overline text-grey-darken-1">{{ title }}</div>
    </div>
    <v-spacer></v-spacer>
  </v-app-bar>
</template>

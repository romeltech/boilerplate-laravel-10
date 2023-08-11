<template>
  <v-dialog v-model="loader.status" fullscreen :scrim="false">
    <v-card class="w-100 h-screen d-flex flex-column align-center justify-center">
      <v-progress-circular
        class="mb-3"
        indeterminate
        color="secondary"
      ></v-progress-circular>
      <div class="text-body-1">{{ loader.text }}</div>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { useSettingStore } from "@/stores/settings";
import { ref } from "vue";
const settingStore = useSettingStore();
const loader = ref({
  status: settingStore.pageLoading.status,
  text: settingStore.pageLoading.text,
});
</script>

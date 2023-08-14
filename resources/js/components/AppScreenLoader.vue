<template>
  <v-dialog v-model="loader.status" fullscreen>
    <v-card class="rounded-0">
      <v-card-text class="h-100 w-100 d-flex flex-column align-center justify-center">
        <v-progress-circular
          indeterminate
          color="primary"
          class="mb-3"
        ></v-progress-circular>
        <div>{{ loader.text }}</div>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, watch } from "vue";
const props = defineProps({
  options: {
    type: Object,
    default: null,
  },
});
const loader = ref({
  status: false,
  text: "Loading...",
});
watch(
  () => props.options,
  (newVal) => {
    console.log("props.options", props.options);
    loader.value = { ...loader.value, ...newVal };
  }
);
</script>

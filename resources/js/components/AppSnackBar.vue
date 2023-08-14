<template>
  <v-snackbar v-model="snackbar.status" :color="snackbar.type">
    {{ snackbar.text }}

    <template v-slot:actions>
      <v-btn color="white" variant="text" @click="snackbar = false"> Close </v-btn>
    </template>
  </v-snackbar>
</template>

<script setup>
import { ref, watch } from "vue";
const props = defineProps({
  options: {
    type: Object,
    default: null,
  },
});
const snackbar = ref({
  status: false,
  type: "primary",
  text: "Default Message",
});
watch(
  () => props.options,
  (newVal) => {
    snackbar.value = { ...snackbar.value, ...newVal };
  }
);
</script>

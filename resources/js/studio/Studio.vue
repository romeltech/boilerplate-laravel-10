<template>
  <v-dialog
    v-model="studioSettings.dialog"
    persistent
    width="1000"
    style="min-height: 400px"
  >
    <v-card>
      <div>this is studio</div>
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
const studioSettings = ref({
  dialog: false,
  multiSelect: false,
});
watch(
  () => props.options,
  (newVal) => {
    studioSettings.value = { ...studioSettings.value, ...newVal };
    console.log("watch studio settings", studioSettings.value);
  }
);
</script>

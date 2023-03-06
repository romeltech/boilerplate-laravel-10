<script setup>
import { onMounted, ref } from "vue";

defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <v-text-field
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
    variant="outlined"
  >
  </v-text-field>
</template>

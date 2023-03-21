<script setup>
defineProps(["value", "classes"]);
</script>

<template>
  <th :class="`text-left text-capitalize ${classes}`">
    {{ value }}
  </th>
</template>

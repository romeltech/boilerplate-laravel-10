<script setup>
import SimpleTable from "@/Components/Common/SimpleTable.vue";
import PageHeader from "@/Components/Common/PageHeader.vue";
</script>

<template>
  <v-container>
    <PageHeader title="Users" />
    <v-row class="mb-3">
      <div class="v-col-12"><SimpleTable /></div>
    </v-row>
  </v-container>
</template>

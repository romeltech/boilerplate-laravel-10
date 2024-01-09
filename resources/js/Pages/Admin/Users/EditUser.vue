<template>
  <PageHeader title="Users" />
  <v-container>
    <v-row class="mb-3">
      <div class="v-col-12"><SimpleTable /></div>
    </v-row>
  </v-container>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SimpleTable from "@/Components/Common/SimpleTable.vue";
import PageHeader from "@/Components/Common/PageHeader.vue";
defineOptions({ layout: AdminLayout });
</script>

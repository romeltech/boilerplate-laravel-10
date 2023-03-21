<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import SimpleTable from "@/Components/Common/SimpleTable.vue";
</script>

<template>
  <v-container>
    <PageHeader title="Logs" />
    <v-row>
      <div class="v-col-12">
        <SimpleTable />
      </div>
    </v-row>
  </v-container>
</template>

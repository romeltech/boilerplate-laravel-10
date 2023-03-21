<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import SimpleTable from "@/Components/Common/SimpleTable.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
// import { ref } from "vue";
// import { router } from "@inertiajs/vue3";
</script>

<template>
  <NormalLayout>
    <v-container>
      <PageHeader title="Account" />
      <v-row>
        <div class="v-col-12">
          <SimpleTable />
        </div>
      </v-row>
    </v-container>
  </NormalLayout>
</template>

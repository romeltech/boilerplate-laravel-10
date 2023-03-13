<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import SimpleTable from "@/Components/Common/SimpleTable.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
</script>

<template>
  <AdminLayout>
    <v-container>
      <PageHeader title="Companies" />
      <v-row>
        <div class="v-col-12">
          <SimpleTable />
        </div>
      </v-row>
    </v-container>
  </AdminLayout>
</template>

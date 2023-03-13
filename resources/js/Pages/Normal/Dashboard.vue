<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import SimpleTable from "@/Components/Common/SimpleTable.vue";
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router } from "@inertiajs/vue3";

const cards = ref([
  {
    id: 1,
    title: "Users",
    path: "/admin/users",
  },
  {
    id: 2,
    title: "Settings",
    path: "/admin/settings",
  },
  {
    id: 3,
    title: "Logs",
    path: "/admin/logs",
  },
]);

const openPage = (path) => {
  router.visit(path, { method: "get" });
};
</script>

<template>
  <AdminLayout>
    <v-container>
      <PageHeader title="Dashboard" />
      <v-row class="mb-3">
        <div class="v-col-12 v-col-md-4 pb-0" v-for="item in cards" :key="item.id">
          <v-card
            color="secondary"
            height="80"
            width="100%"
            class="d-flex align-center justify-center rounded-lg"
            style="cursor: pointer"
            @click="() => openPage(item.path)"
          >
            <div class="text-h6 text-capitalize">{{ item.title }}</div>
          </v-card>
        </div>
      </v-row>
      <v-row>
        <div class="v-col-12">
          <SimpleTable />
        </div>
      </v-row>
    </v-container>
  </AdminLayout>
</template>

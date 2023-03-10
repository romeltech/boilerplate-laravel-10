<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageHeader from "@/Components/Common/PageHeader.vue";
import SimpleTable from "@/Components/Common/SimpleTable.vue";
import { ref } from "vue";
const cards = ref([
  {
    id: 1,
    title: "New Tickets",
    path: "/tickets/new",
  },
  {
    id: 2,
    title: "Pending",
    path: "/tickets/pendings",
  },
  {
    id: 3,
    title: "Completed",
    path: "/tickets/completed",
  },
]);
</script>

<template>
  <AuthenticatedLayout>
    <v-container>
      <PageHeader title="Dashboard" />
      <v-row class="mb-3">
        <div class="v-col-12 v-col-md-4 pb-0" v-for="item in cards" :key="item.id">
          <router-link to="/admin/users">
            <v-card
              v-ripple
              color="secondary"
              height="80"
              width="100%"
              class="d-flex align-center justify-center rounded-lg"
              style="cursor: pointer"
            >
              <div class="text-h6 text-capitalize">{{ item.title }}</div>
            </v-card>
          </router-link>
        </div>
      </v-row>
      <v-row>
        <div class="v-col-12">
          <SimpleTable />
        </div>
      </v-row>
    </v-container>
  </AuthenticatedLayout>
</template>

<template>
  <PageHeader title="Dashboard" />
  <v-container>
    <v-row class="mb-3">
      <div class="v-col-12 v-col-md-4 pb-0" v-for="item in cards" :key="item.id">
        <v-card
          v-ripple
          color="secondary"
          height="80"
          width="100%"
          class="d-flex align-center justify-center"
          style="cursor: pointer"
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
</template>

<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeader from "@/Components/Common/PageHeader.vue";
import SimpleTable from "@/Components/Common/SimpleTable.vue";
defineOptions({ layout: AdminLayout });
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
if (!authStore.user && !authStore.user.hasOwnProperty("id")) {
  authStore.setToken("melmelmel");
  authStore.setUser({
    id: 1,
    username: "melmelmel",
    email: "melmelmel@gmail.com",
  });
}

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

<template>
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
        <!-- content -->
      </div>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from "vue";
import PageHeader from "@/components/PageHeader.vue";
import { useRouter } from "vue-router";
const cards = ref([
  {
    id: 1,
    title: "Users",
    path: "/admin/users",
  },
  {
    id: 2,
    title: "Companies",
    path: "/admin/companies",
  },
  {
    id: 3,
    title: "Departments",
    path: "/admin/departments",
  },
]);
const router = useRouter();
const openPage = (openPath) => {
  router
    .push({
      path: openPath,
    })
    .catch((err) => {});
};
</script>

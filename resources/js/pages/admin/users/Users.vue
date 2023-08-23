<template>
  <v-container>
    <AppPageHeader title="Users" />
    <v-row class="mb-3">
      <div class="v-col-12">
        <v-card :loading="users.loading">
          <v-card-title class="text-primary text-capitalize">Users</v-card-title>
          <v-table>
            <thead>
              <tr>
                <th class="text-left text-capitalize">Username</th>
                <th class="text-left text-capitalize">Email</th>
                <th class="text-left text-capitalize">Status</th>
                <th class="text-right text-capitalize">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in users.data" :key="item.id">
                <td>{{ item.username }}</td>
                <td>{{ item.email }}</td>
                <td>
                  <v-chip
                    class="text-uppercase"
                    size="small"
                    :color="`${item.status == 'active' ? 'success' : 'error'}`"
                    >{{ item.status }}</v-chip
                  >
                </td>
                <td>
                  <div class="d-flex align-center justify-end">
                    <v-icon
                      size="small"
                      @click="() => editUser(item.id)"
                      :icon="mdiPencil"
                      class="mx-1"
                    />
                    <v-icon
                      size="small"
                      @click="() => deleteUser(item.id)"
                      :icon="mdiTrashCan"
                      class="mx-1"
                    />
                  </div>
                </td>
              </tr>
            </tbody>
          </v-table>
          <v-sheet v-if="users.data.length == 0" class="pa-3 text-center w-100"
            >No records found</v-sheet
          >
        </v-card>
        <v-pagination
          v-if="totalPageCount > 1"
          v-model="currentPage"
          class="my-4"
          :length="totalPageCount"
          :total-visible="8"
          variant="elevated"
          active-color="primary"
          density="comfortable"
          :disabled="users.loading"
        ></v-pagination>
      </div>
    </v-row>
  </v-container>
</template>

<script setup>
import AppPageHeader from "@/components/ApppageHeader.vue";
import { onMounted, ref, watch } from "vue";
import { mdiPencil, mdiTrashCan } from "@mdi/js";
import { useRouter, useRoute } from "vue-router";
import { axiosToken } from "@/services/axiosToken";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
const users = ref({
  loading: false,
  data: [],
});
const totalPageCount = ref(0);
const totalResult = ref(0);
const currentPage = ref(route.params && route.params.page ? route.params.page : 1);
const getAllUsers = async () => {
  users.value.loading = true;
  await axiosToken(authStore.token)
    .get("/api/user/all?page=" + currentPage.value)
    .then((res) => {
      totalPageCount.value = res.data.last_page;
      currentPage.value = res.data.current_page;
      totalResult.value = res.data.total;
      users.value.data = res.data.data;
      users.value.loading = false;
    })
    .catch((err) => {
      users.value.loading = false;
      console.log(err);
    });
};
watch(currentPage, (newValue, oldValue) => {
  if (newValue != oldValue) {
    router
      .push({
        name: "PaginatedUsers",
        params: {
          page: currentPage.value,
        },
      })
      .catch((err) => {});
    getAllUsers(currentPage.value);
  }
});

const editUser = (id) => {
  router
    .push({
      name: "EditUser",
      params: {
        id: id,
      },
    })
    .catch((err) => {
      console.log(err);
    });
};

const deleteUser = (item) => {
  console.log("delete", item);
};

onMounted(() => {
  getAllUsers();
});
</script>

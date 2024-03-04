<template>
  <PageHeader title="Users" />
  <v-container>
    <v-row class="mb-3">
      <div class="v-col-12">
        <v-card>
          <v-card-title class="text-primary">Users</v-card-title>
          <v-table>
            <thead>
              <tr>
                <th class="text-left text-capitalize">Username</th>
                <th class="text-left text-capitalize">Email</th>
                <th class="text-right text-capitalize">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in users" :key="item.id">
                <td>{{ item.username }}</td>
                <td>{{ item.email }}</td>
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
        </v-card>
      </div>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PageHeader from "@/Components/Common/PageHeader.vue";
import { mdiPencil, mdiTrashCan } from "@mdi/js";
import { Link, router, usePage } from "@inertiajs/vue3";
defineOptions({ layout: AdminLayout });

// All users
const users = ref([]);
const getUsers = async () => {
  await axios.get("/admin/users/paginated").then((res) => {
    users.value = res.data.data;
  });
};
getUsers();

// Edit user
const editUser = (id) => {
  router.get("/admin/users/edit/" + id);
};
</script>

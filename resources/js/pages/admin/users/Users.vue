<template>
  <v-container>
    <PageHeader title="Users" />
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
      </div>
    </v-row>
  </v-container>
</template>

<script setup>
import PageHeader from "@/components/pageHeader.vue";
import { onMounted, ref } from "vue";
import { mdiPencil, mdiTrashCan } from "@mdi/js";
import { useRouter } from "vue-router";
const router = useRouter();
const users = ref({
  loading: false,
  data: [],
});
const getAllUsers = async () => {
  users.value.loading = true;
  await axios
    .get("/admin/user/all")
    .then((response) => {
      users.value.data = response.data;
      users.value.loading = false;
    })
    .catch((err) => {
      users.value.loading = false;
      console.log(err);
    });
};

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

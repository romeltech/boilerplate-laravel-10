<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import { onMounted, ref } from "vue";
import { mdiPencil } from "@mdi/js";
import { mdiTrashCan } from "@mdi/js";

const user = ref({
  loading: false,
  data: {},
});

const userData = ref({});

const getSingleUser = async () => {
  user.value.loading = true;
  await axios
    .get("/admin/user/single/" + route().params.id)
    .then((response) => {
      user.value.data = response.data;
      user.value.loading = false;
    })
    .catch((err) => {
      user.value.loading = false;
      console.log(err);
    });
};
onMounted(() => {
  getSingleUser();
});

const saveUser = async () => {
  let data = user.value.data;
  console.log("data", data);
  await axios
    .get("/admin/user/save", data)
    .then((response) => {
      user.value.data = response.data.user;
      user.value.loading = false;
    })
    .catch((err) => {
      user.value.loading = false;
      console.log(err);
    });
};
</script>

<template>
  <v-container>
    <PageHeader title="Edit User" />
    <v-row class="mb-3">
      <div class="v-col-12">
        <v-card :loading="user.loading">
          <v-card-title class="text-primary text-capitalize mb-3"
            >Edit {{ user.data.username && user.data.username }}</v-card-title
          >
          <v-card-text>
            <v-text-field
              v-model="user.data.username"
              class="mb-2"
              label="Username"
              variant="outlined"
              required
            >
            </v-text-field>
            <v-text-field
              v-model="user.data.email"
              class="mb-2"
              label="Email"
              variant="outlined"
              required
            >
            </v-text-field>
            <v-text-field
              v-model="user.data.phone_no"
              class="mb-2"
              label="Phone Number"
              variant="outlined"
              required
            >
            </v-text-field>

            <!-- :error-messages="" -->
          </v-card-text>
        </v-card>
      </div>
    </v-row>
  </v-container>
</template>

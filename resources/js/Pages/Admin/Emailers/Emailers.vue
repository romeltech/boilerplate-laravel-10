<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import { onMounted, ref } from "vue";
import { mdiPencil, mdiTrashCan } from "@mdi/js";
import { router } from "@inertiajs/vue3";
const emailers = ref({
  loading: false,
  data: [],
});
const getAllEmailers = async () => { 
  
   await axios
    .get("/api/emailers/all")
    .then((response) => {
       
       emailers.value.data = response.data.data;
      emailers.value.loading = false;
    })
    .catch((err) => {
      emailers.value.loading = false; 
    });
};

const editEmailer = (id) => {
  router.visit("/api/emailers/" + id, { method: "get" });
};

const deleteEmailer = (item) => {
  console.log("delete", item);
};

onMounted(() => {
  emailers.value.loading = true;
  getAllEmailers();
});
</script>

<template>
  <v-container>
    <PageHeader title="emailers" />
    <v-row class="mb-3">
      <div class="v-col-12">
        <v-card :loading="emailers.loading">
          <v-card-title class="text-primary text-capitalize">Emailer Designs</v-card-title>
          <v-table>
            <thead>
              <tr>
                <th class="text-left text-capitalize">Title</th>
                <th class="text-left text-capitalize">Link</th>
                <th class="text-left text-capitalize">Author</th>
                <th class="text-left text-capitalize">Status</th>
                <th class="text-right text-capitalize">Actions</th>
              </tr>
            </thead>
            <tbody v-if="emailers.data">
              <tr v-for="item in emailers.data" :key="item.id">
                <td>{{ item.title }}</td>
                <td>{{ item.link }}</td>
                <td>{{ item.author_id }}</td>
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
                      @click="() => editEmailer(item.id)"
                      :icon="mdiPencil"
                      class="mx-1"
                    />
                    
                    <v-icon
                      size="small" 
                      :icon="mdiTrashCan"
                      @click="() => deleteEmailer(item.id)"
                      class="mx-1"
                    />
                  </div>
                </td>
              </tr>
            </tbody>
          </v-table>
          <v-sheet v-if="emailers.data.length == 0" class="pa-3 text-center w-100"
            >No records found</v-sheet
          >
        </v-card>
      </div>
    </v-row>
  </v-container>
</template>

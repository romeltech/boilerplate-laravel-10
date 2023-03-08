<script setup>
import { mdiPencil } from "@mdi/js";
import { mdiTrashCan } from "@mdi/js";
const props = defineProps({
  data: {
    type: Array,
    default: [
      {
        id: 1,
        title: "test",
        user: {
          fullname: "mel",
        },
      },
      {
        id: 2,
        title: "test 2",
        user: {
          fullname: "romel",
        },
      },
    ],
  },
});
const editModel = (item) => {
  console.log("edit", item);
};
const deleteModel = (item) => {
  console.log("delete", item);
};
</script>

<template>
  <v-card>
    <v-card-title class="text-primary">Tickets</v-card-title>
    <v-table>
      <thead>
        <tr>
          <th class="text-left text-capitalize">title</th>
          <th class="text-left text-capitalize">user</th>
          <th class="text-right text-capitalize">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data" :key="item.id">
          <td>{{ item.title }}</td>
          <td>{{ item.user.fullname }}</td>
          <td>
            <div class="d-flex align-center justify-end">
              <v-icon
                size="small"
                @click="() => editModel(item.id)"
                :icon="mdiPencil"
                class="mx-1"
              />
              <v-icon
                size="small"
                @click="() => deleteModel(item.id)"
                :icon="mdiTrashCan"
                class="mx-1"
              />
            </div>
          </td>
        </tr>
      </tbody>
    </v-table>
  </v-card>
</template>

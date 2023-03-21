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
  header: {
    type: Array,
    default:[],
  }
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
          <th class="text-left text-capitalize" v-for="item in header" :key="item">{{item}}</th> 
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data" :key="item.id">
          <td>{{ item.id }}</td>
          <td>{{ item.title}}</td>
          <td>{{ item.path }}</td>
        </tr>
      </tbody>
    </v-table>
  </v-card>
</template>

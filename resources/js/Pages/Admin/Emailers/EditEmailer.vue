<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import { onMounted, ref } from "vue";
 
import Snackbar from "@/Components/Common/SnackBar.vue";
 

const loadingPage = ref(true);
const emailer = ref({
  loading: false,
  data: {},
});

const getSingleEmailer = async () => {
  loadingPage.value = true;
  await axios
    .get("/api/emailer/single/" + route().params.id)
    .then((response) => {
      emailer.value.data = response.data;
      loadingPage.value = false;
    })
    .catch((err) => {
      emailer.value.loading = false;
      loadingPage.value = false;
      console.log(err);
    });
};
const savedResponse = (resMsg) => {
  getSingleEmailer().then(() => {
    sbOptions.value = {
      status: true,
      type: "success",
      text: resMsg,
    };
  });
};
onMounted(() => {
  getSingleEmailer();
});

const currentForm = ref("account");
const openForm = async (comp) => {
  currentForm.value = comp;
};

const sbOptions = ref({
  status: true,
  type: "info",
  text: null,
});
</script>

<template>
  <v-container>
    <PageHeader title="Edit Emailer" />
    <v-row class="mb-3" :disabled="loadingPage">
      <div class="v-col-12 v-col-md-8">
        <div class="d-flex flex-wrap">
          
           
         
        </div>
      </div> 
    </v-row>
    <Snackbar :options="sbOptions" />
  </v-container>
</template>

<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import { onMounted, ref } from "vue";
import AccountForm from "@/Pages/Account/AccountForm.vue";
import ProfileForm from "@/Pages/Account/ProfileForm.vue";

const loadingPage = ref(true);
const user = ref({
  loading: false,
  data: {},
});

const getSingleUser = async () => {
  loadingPage.value = true;
  await axios
    .get("/admin/user/single/" + route().params.id)
    .then((response) => {
      user.value.data = response.data;
      loadingPage.value = false;
      console.log("getSingleUser", response.data);
    })
    .catch((err) => {
      user.value.loading = false;
      loadingPage.value = false;
      console.log(err);
    });
};
onMounted(() => {
  getSingleUser();
});

const currentForm = ref("account");
const openForm = async (comp) => {
  currentForm.value = comp;
};
</script>

<template>
  <v-container>
    <PageHeader title="Edit User" />
    <v-row class="mb-3" :disabled="loadingPage">
      <div class="v-col-12 v-col-md-8">
        <div class="d-flex">
          <v-btn
            :color="`${currentForm == 'account' ? 'primary' : 'grey-lighten-5'} `"
            size="large"
            class="mr-3"
            :loading="user.loading"
            @click="() => openForm('account')"
            >Account</v-btn
          >
          <v-btn
            :color="`${currentForm == 'profile' ? 'primary' : 'grey-lighten-5'} `"
            size="large"
            :loading="user.loading"
            @click="() => openForm('profile')"
            >profile</v-btn
          >
        </div>
      </div>

      <div class="v-col-12 v-col-md-8">
        <AccountForm v-show="currentForm == 'account'" :user="user.data" />
        <ProfileForm v-show="currentForm == 'profile'" :profile="user.data.profile" />
      </div>
    </v-row>
  </v-container>
</template>

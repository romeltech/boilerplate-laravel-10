<template>
  <v-container>
    <PageHeader title="Edit User" />
    <v-row class="mb-3" :disabled="loadingPage">
      <div class="v-col-12 v-col-md-8">
        <div class="d-flex flex-wrap">
          <v-btn
            :color="`${currentForm == 'profile' ? 'primary' : 'white'} `"
            size="large"
            class="mr-3"
            :loading="user.loading"
            @click="() => openForm('profile')"
            >profile</v-btn
          >
          <v-btn
            :color="`${currentForm == 'account' ? 'primary' : 'white'} `"
            size="large"
            class="mr-3"
            :loading="user.loading"
            @click="() => openForm('account')"
            >Account</v-btn
          >
          <v-btn
            :color="`${currentForm == 'change_password' ? 'primary' : 'white'} `"
            size="large"
            class="mr-3"
            :loading="user.loading"
            @click="() => openForm('change_password')"
            >Change Password</v-btn
          >
        </div>
      </div>

      <div class="v-col-12 v-col-md-8">
        <AccountForm
          v-show="currentForm == 'account'"
          :user="user.data"
          @saved="savedResponse"
        />
        <ProfileForm
          v-show="currentForm == 'profile'"
          :user="user.data"
          @saved="savedResponse"
        />
        <ChangePassword v-show="currentForm == 'change_password'" :user-id="1" />
      </div>
    </v-row>
    <Snackbar :options="sbOptions" />
  </v-container>
</template>

<script setup>
import { onMounted, ref } from "vue";
import PageHeader from "@/components/pageHeader.vue";
import AccountForm from "@/pages/account/AccountForm.vue";
import ProfileForm from "@/pages/account/ProfileForm.vue";
import Snackbar from "@/components/SnackBar.vue";
import ChangePassword from "@/pages/account/ChangePassword.vue";
import { useRoute } from "vue-router";
const route = useRoute();

const loadingPage = ref(true);
const user = ref({
  loading: false,
  data: {},
});

const getSingleUser = async () => {
  loadingPage.value = true;
  await axios
    .get("/admin/user/single/" + route.params.id)
    .then((response) => {
      user.value.data = response.data;
      loadingPage.value = false;
    })
    .catch((err) => {
      user.value.loading = false;
      loadingPage.value = false;
      console.log(err);
    });
};
const savedResponse = (resMsg) => {
  getSingleUser().then(() => {
    sbOptions.value = {
      status: true,
      type: "success",
      text: resMsg,
    };
  });
};
onMounted(() => {
  getSingleUser();
});

const currentForm = ref("profile");
const openForm = async (comp) => {
  currentForm.value = comp;
};

const sbOptions = ref({
  status: true,
  type: "info",
  text: null,
});
</script>

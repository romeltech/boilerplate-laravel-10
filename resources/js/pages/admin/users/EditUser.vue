<script setup>
import PageHeader from "@/components/pageHeader.vue";
import { onMounted, ref } from "vue";
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
    <PageHeader title="Edit User" />
    <v-row class="mb-3" :disabled="loadingPage">
      <div class="v-col-12 v-col-md-8">
        <div class="d-flex flex-wrap">
          <v-btn
            :color="`${currentForm == 'account' ? 'primary' : 'white'} `"
            size="large"
            class="mr-3"
            :loading="user.loading"
            @click="() => openForm('account')"
            >Account</v-btn
          >
          <v-btn
            :color="`${currentForm == 'profile' ? 'primary' : 'white'} `"
            size="large"
            class="mr-3"
            :loading="user.loading"
            @click="() => openForm('profile')"
            >profile</v-btn
          >

          <ChangePassword :user-id="1" />
        </div>
      </div>

      <div class="v-col-12 v-col-md-8">
        <AccountForm
          v-if="currentForm == 'account'"
          :user="user.data"
          @saved="savedResponse"
        />
        <ProfileForm
          v-if="currentForm == 'profile'"
          :profile="user.data.profile"
          @saved="savedResponse"
        />
      </div>
    </v-row>
    <Snackbar :options="sbOptions" />
  </v-container>
</template>

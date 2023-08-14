<template>
  <v-container>
    <AppPageHeader title="Account" />
    <v-row>
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
    <AppSnackBar :options="sbOptions" />
  </v-container>
</template>

<script setup>
import { ref } from "vue";
import AppPageHeader from "@/components/AppPageHeader.vue";
import AccountForm from "./AccountForm.vue";
import ProfileForm from "./ProfileForm.vue";
import ChangePassword from "./ChangePassword.vue";
import { useAuthStore } from "@/stores/auth";
import AppSnackBar from "@/components/AppSnackBar.vue";

const sbOptions = ref({
  status: false,
  type: "primary",
  text: null,
});

// user
const authStore = useAuthStore();
const user = ref({
  loading: false,
  data: Object.assign({}, authStore.user),
});

// tabs
const currentForm = ref("profile");
const openForm = async (comp) => {
  currentForm.value = comp;
};

// form response
const savedResponse = (res) => {
  sbOptions.value = {
    status: true,
    type: "success",
    text: res,
  };
};
</script>

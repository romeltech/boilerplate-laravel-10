<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/Form/PrimaryButton.vue";
// import TextInput from "@/Components/TextInput.vue";
import TextField from "@/Components/Form/TextField.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

// import { mdiAccount } from "@mdi/js";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  login: "",
  password: "",
  remember: false,
});

const loginErrorMessage = ref("");

const submit = () => {
  loginErrorMessage.value = "";
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
    onError: () => {
      if (form.errors.username) {
        loginErrorMessage.value = form.errors.username;
      }
      if (form.errors.email) {
        loginErrorMessage.value = form.errors.email;
      }
    },
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div class="text-h6 mb-3">Login</div>
      <TextField
        class="mb-2"
        id="username"
        type="text"
        label="Username/Email"
        v-model="form.login"
        required
        :error-messages="loginErrorMessage"
      />
      <TextField
        class="mb-2"
        id="password"
        type="password"
        label="Password"
        v-model="form.password"
        required
        autocomplete="current-password"
        :error-messages="form.errors.password"
      />
      <!-- <v-checkbox
        label="Remember me"
        color="primary"
        density="compact"
        v-model="form.remember"
        hide-details
      ></v-checkbox> -->
      <div class="d-flex align-center justify-end mb-6">
        <PrimaryButton
          style="height: 60px"
          class="w-100"
          :loading="form.processing"
        >
          Log in
        </PrimaryButton>
      </div>
      <v-alert
        v-if="form.errors.login"
        :icon="false"
        class="my-6"
        density="compact"
        type="error"
        variant="outlined"
      >
        {{ form.errors.login }}
      </v-alert>

      <!-- v-if="canResetPassword" -->
      <div class="text-center mt-5">
        <v-divider class="mb-5"></v-divider>
        <Link :href="route('password.request')" class="text-primary">
          Forgot your password?
        </Link>
      </div>
    </form>
  </GuestLayout>
</template>

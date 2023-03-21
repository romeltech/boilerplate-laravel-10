<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/Form/PrimaryButton.vue";
// import TextInput from "@/Components/TextInput.vue";
import TextField from "@/Components/Form/TextField.vue";
import { Head, Link, useForm } from "@inertiajs/vue3"; 

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
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
      <div class="text-h6 mb-6">Login</div>
      <TextField
        class="mb-3"
        id="email"
        type="email"
        label="Email"
        v-model="form.email"
        required
        :error-messages="form.errors.email"
      />
      <TextField
        class="mb-3"
        id="password"
        type="password"
        label="Password"
        v-model="form.password"
        required
        autocomplete="current-password"
        :error-messages="form.errors.password"
      />

      <!--
      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox name="remember" v-model:checked="form.remember" />
          <span class="ml-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div> -->

      <div class="d-flex align-center justify-end mt-4">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Forgot your password?
        </Link>

        <PrimaryButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

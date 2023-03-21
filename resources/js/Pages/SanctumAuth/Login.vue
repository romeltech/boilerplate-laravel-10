<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/Form/PrimaryButton.vue";
// import TextInput from "@/Components/TextInput.vue";
import TextField from "@/Components/Form/TextField.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import gagUserClient from '../Services/userClient';
import { ref } from "vue";
import { useAuthStore } from '@/Stores/useAuthStore';
const { setUser, setToken  } = useAuthStore();

const key = import.meta.env.VITE_APP_KEY;

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    url: key,
    remember: false,
});
const hasError = ref(false);
const loading = ref(false);;
const message = ref('');
const submit = () => {
    loading.value = true;
    gagUserClient.get("/sanctum/csrf-cookie").then((res) => {
        gagUserClient.post("api/sanctumlogin", form).then((response) => {
            if (response.data.status) { 
                setUser(response.data.user);
                setToken(response.data.token.toString());
                // localStorage.setItem("gag_users_token", response.data.token.toString());
                // localStorage.setItem("gag_users_profile", JSON.stringify(response.data.user));
                loading.value = false;
                router.visit('/d/dashboard', { method: "get" });
                //window.location.href = "/d/dashboard";
            } else {
                loading.value = false;
                hasError.value = true;
                message.value = response.data.message;
            }

        }).catch((err) => {
            console.log("Error: ", err);
        });
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
            <TextField class="mb-3" id="username" autofocus type="text" label="Username/Email" v-model="form.username" required
                :error-messages="form.errors.username" />
            <TextField class="mb-3" id="password" type="password" label="Password" v-model="form.password" required
                autocomplete="current-password" :error-messages="form.errors.password" />
            <div class="text-error">{{ hasError == true ? message : '' }}</div>
            <!--
                  <div class="block mt-4">
                    <label class="flex items-center">
                      <Checkbox name="remember" v-model:checked="form.remember" />
                      <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                  </div> -->

            <div class="d-flex align-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :loading="loading" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

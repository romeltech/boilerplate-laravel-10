<template>
    <v-container fluid class="bg-grey-lighten-4">
        <v-row class="h-screen align-center">
            <div class="v-col-12 v-col-md-3 mx-auto" max-widt="450px">
                <v-card class="elevation-3">
                    <v-card-title class="px-5 pb-0 primary--text"
                        >Login</v-card-title
                    >
                    <v-card-text class="py-5">
                        <!-- v-model="loginValid" -->
                        <v-form autocomplete="off" ref="form">
                            <v-text-field
                                v-model="credentials.login"
                                variant="outlined"
                                required
                                class="border-radius"
                                autocomplete="off"
                                label="Username or Email"
                            >
                            </v-text-field>
                            <!-- @enderror -->
                            <!-- error-messages="{{ old('username') }} do not match in our records"> -->
                            <!-- :rules="loginEmailrules" autofocus @error('username') value="{{ old('username') }}" error -->
                            <v-text-field
                                v-model="credentials.password"
                                variant="outlined"
                                required
                                autocomplete="off"
                                label="Password"
                                type="password"
                            >
                                <!-- :rules="loginPasswordrules" -->
                                <!-- @error('password') error error-messages="{{ $message }}" @enderror -->
                            </v-text-field>
                            <v-btn
                                @click="login"
                                width="100%"
                                color="primary"
                                height="55"
                                large
                                >Login</v-btn
                            >
                            <!-- :disabled="!loginValid" @click="loginValidate" -->
                            <!-- :class="`mb-3 ${
                                loginValid == true
                                    ? 'primary'
                                    : 'grey lighten-1'
                            }`" -->

                            <!-- <div class="d-flex justify-space-between align-center my-3">
                            <a class="primary--text" href="{{ route('password.request') }}">{{ __('Reset Password') }}</a>

                            <a class="primary--text" href="{{ route('player.registration.page') }}">{{ __('Register') }}</a>
                        </div> -->
                            <!-- @if ($errors->has('login_error'))
                        <v-alert type="error">
                            {{ $errors -> first() }}
                        </v-alert>
                        @endif -->
                        </v-form>
                    </v-card-text>
                </v-card>
            </div>
        </v-row>
    </v-container>
</template>

<script setup>
import { useRouter, useRoute } from "vue-router";
import { ref } from "vue";

const router = useRouter();
const credentials = ref({
    login: "",
    password: "",
});
const loadingLogin = ref(false);

const login = async () => {
    console.log("credentials", credentials.value);
    loadingLogin.value = true;
    let data = {
        username: credentials.value.login,
        password: credentials.value.password,
    };
    try {
        const res = await axios.post("/login", data);
        console.log("res", res);
        if (res) {
            router.push("/admin");
            loadingLogin.value = false;
        }
    } catch (err) {
        loadingLogin.value = false;
    }
};
</script>

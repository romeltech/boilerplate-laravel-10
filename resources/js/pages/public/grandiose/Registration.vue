<template>
  <GuestLayout>
    <v-card class="mt-8 pa-2 rounded-lg elevation-3" width="80%" max-width="450">
      <v-card-title class="px-5 pb-0 primary--text">Register to connect</v-card-title>
      <v-card-text class="py-5">
        <Form as="v-form" :validation-schema="validation" autocomplete="off">
          <Field
            name="First name"
            v-slot="{ field, errors }"
            v-model="credentials.first_name"
          >
            <v-text-field
              v-bind="field"
              :error-messages="errors"
              v-model="credentials.first_name"
              variant="outlined"
              required
              class="mb-3"
              autocomplete="off"
              label="First Name"
              density="compact"
            >
            </v-text-field>
          </Field>
          <Field
            name="Last name"
            v-slot="{ field, errors }"
            v-model="credentials.last_name"
          >
            <v-text-field
              v-bind="field"
              :error-messages="errors"
              v-model="credentials.last_name"
              variant="outlined"
              required
              class="mb-3"
              autocomplete="off"
              label="Last Name"
              density="compact"
            >
            </v-text-field>
          </Field>
          <Field name="Email" v-slot="{ field, errors }" v-model="credentials.email">
            <v-text-field
              v-bind="field"
              :error-messages="errors"
              v-model="credentials.email"
              variant="outlined"
              required
              class="mb-3"
              autocomplete="off"
              label="Email"
              density="compact"
            >
            </v-text-field>
          </Field>
          <Field
            name="Phone number"
            v-slot="{ field, errors }"
            v-model="credentials.phone"
          >
            <v-text-field
              v-bind="field"
              :error-messages="errors"
              v-model="credentials.phone"
              variant="outlined"
              required
              class="mb-3"
              autocomplete="off"
              label="Mobile Number"
              density="compact"
              type="number"
            >
            </v-text-field>
          </Field>
          <v-btn
            @click="register"
            :loading="loadingLogin"
            width="100%"
            color="primary"
            height="40"
            small
            >Register</v-btn
          >
        </Form>
      </v-card-text>
    </v-card>
  </GuestLayout>
</template>

<script setup>
import { Form, Field } from "vee-validate";
import * as yup from "yup";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { useRouter } from "vue-router";
import { ref } from "vue";
const router = useRouter();

const phoneRegExp = /^((\\+[1-9]{1,4}[ \\-]*)|(\\([0-9]{2,3}\\)[ \\-]*)|([0-9]{2,4})[ \\-]*)*?[0-9]{3,4}?[ \\-]*[0-9]{3,4}?$/;
let validation = yup.object({
  "First name": yup.string().max(50).required(),
  "Last name": yup.string().max(50).required(),
  Email: yup.string().max(50).email().required(),
  "Phone number": yup
    .string()
    .required()
    .matches(phoneRegExp, "Phone number is not valid")
    .min(9, "Too short")
    .max(16, "Too long"),
});

const credentials = ref({
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
});
const loadingLogin = ref(false);
const register = async () => {
  loadingLogin.value = true;
  await axios
    .post("/grandiose-registration", credentials.value)
    .then((res) => {
      window.location.href = "/grandiose-thank-you";
      //   router
      //     .push({
      //       name: "GrandioseThankYou",
      //     })
      //     .catch((err) => {
      //       console.log(err);
      //     });
    })
    .catch((err) => {
      loadingLogin.value = false;
      console.log("register err ", err);
    });
};
</script>

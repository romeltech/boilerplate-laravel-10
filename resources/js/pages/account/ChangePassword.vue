<template>
  <div>
    <v-card :loading="password.loading">
      <Form as="v-form" :validation-schema="validation">
        <v-card-title class="text-primary text-capitalize mb-3">
          Change password
        </v-card-title>
        <v-card-text class="pb-6">
          <Field
            name="password"
            v-slot="{ field, errors }"
            v-model="password.data.password"
          >
            <v-text-field
              v-model="password.data.password"
              v-bind="field"
              label="Password"
              type="password"
              variant="outlined"
              class="mb-2"
              :error-messages="errors"
            ></v-text-field>
          </Field>
          <Field
            name="password_confirmation"
            v-slot="{ field, errors }"
            v-model="password.data.password_confirmation"
          >
            <v-text-field
              v-model="password.data.password_confirmation"
              v-bind="field"
              label="Confirm Password"
              type="password"
              variant="outlined"
              class="mb-2"
              :error-messages="errors"
            ></v-text-field>
          </Field>
          <div class="d-flex align-center">
            <v-btn color="primary" size="large" @click="changePassword"> Save </v-btn>
          </div>
        </v-card-text>
      </Form>
    </v-card>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { Form, Field } from "vee-validate";
import * as yup from "yup";
const props = defineProps(["userId"]);
const snackbar = ref({
  status: false,
  type: "",
  text: "",
});
const password = ref({
  status: false,
  loading: false,
  data: {
    user_id: props.userId,
    password: "",
    password_confirmation: "",
  },
});
let validation = yup.object({
  password: yup.string().min(5).required(),
  password_confirmation: yup
    .string()
    .required()
    .oneOf([yup.ref("password")], "Passwords do not match"),
});
const changePassword = async () => {
  password.value.loading = true;
  await axios
    .post("/account/change-password", password.value.data)
    .then((response) => {
      password.value = {
        status: false,
        loading: false,
        data: {
          user_id: props.userId,
          password: "",
          password_confirmation: "",
        },
      };
      snackbar.value = {
        status: true,
        type: "success",
        text: response.data.message,
      };
    })
    .catch((err) => {
      password.value.loading = false;
      snackbar.value = {
        status: true,
        type: "error",
        text: "Error while updating password",
      };
      console.log(err.response.data);
    });
};
</script>

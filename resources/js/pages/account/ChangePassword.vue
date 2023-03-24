<template>
  <div>
    <v-dialog v-model="password.status" persistent max-width="600">
      <template v-slot:activator="{ props }">
        <v-btn color="white" size="large" v-bind="props"> Change password </v-btn>
      </template>
      <v-card :loading="password.loading">
        <Form as="v-form" :validation-schema="validation">
          <v-card-title class="text-title"> Change password </v-card-title>
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
              <v-spacer></v-spacer>
              <v-btn color="grey" variant="text" @click="password.status = false">
                Cancel
              </v-btn>
              <v-btn color="primary" @click="changePassword"> Change password </v-btn>
            </div>
          </v-card-text>
        </Form>
      </v-card>
    </v-dialog>
    <SnackBar :options="snackbar" />
  </div>
</template>

<script setup>
import SnackBar from "@/components/SnackBar.vue";
import { ref } from "vue";
import { Form, Field } from "vee-validate";
import * as yup from "yup";
const props = defineProps(["userId"]);
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

const snackbar = ref({
  status: false,
  type: "",
  text: "",
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

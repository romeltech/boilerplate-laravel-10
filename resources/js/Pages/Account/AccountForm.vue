<template>
  <v-card>
    <v-card-title class="text-primary text-capitalize mb-3"
      >Account Settings</v-card-title
    >
    <v-card-text>
      <Form as="v-form" :validation-schema="validation">
        <Field
          name="username"
          v-slot="{ field, errors }"
          v-model="userData.data.username"
        >
          <v-text-field
            v-model="userData.data.username"
            v-bind="field"
            label="Username"
            variant="outlined"
            class="mb-2"
            :error-messages="errors"
          />
        </Field>
        <Field name="email" v-slot="{ field, errors }" v-model="userData.data.email">
          <v-text-field
            v-model="userData.data.email"
            v-bind="field"
            label="Email"
            variant="outlined"
            class="mb-2"
            :error-messages="errors"
          />
        </Field>
        <Field
          name="phone_no"
          v-slot="{ field, errors }"
          v-model="userData.data.phone_no"
        >
          <v-text-field
            v-model="userData.data.phone_no"
            v-bind="field"
            type="number"
            label="Phone number"
            variant="outlined"
            class="mb-2"
            :error-messages="errors"
          />
        </Field>
        <v-btn color="primary" size="large" :loading="userData.loading" @click="saveUser"
          >Save</v-btn
        >
      </Form>
    </v-card-text>
  </v-card>
</template>
<script setup>
import { ref, watch } from "vue";
import * as yup from "yup";
import { Form, Field } from "vee-validate";

const props = defineProps(["user"]);

watch(
  () => props.user,
  (newVal) => {
    userData.value.data = newVal;
    console.log("userData.value.data", userData.value.data);
  }
);

const userData = ref({
  loading: false,
  data: props.user,
});

let validation = yup.object({
  username: yup.string().required(),
  email: yup.string().email(),
  phone_no: yup.number().required(),
});

const saveUser = async () => {
  let data = user.value.data;
  user.value.loading = true;
  await axios
    .get("/admin/user/save", data)
    .then((response) => {
      user.value.data = response.data.user;
      user.value.loading = false;
    })
    .catch((err) => {
      user.value.loading = false;
      console.log(err.response);
    });
};
</script>

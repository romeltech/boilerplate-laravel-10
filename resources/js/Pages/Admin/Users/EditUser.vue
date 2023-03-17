<script setup>
import PageHeader from "@/Components/Common/PageHeader.vue";
import { onMounted, ref } from "vue";
import * as yup from "yup";
import { Form, Field } from "vee-validate";

let validation = yup.object({
  username: yup.string().required(),
  phone_no: yup.number().required(),
  email: yup.string().email(),
});

const loadingPage = ref(true);
const user = ref({
  loading: false,
  data: {},
});

const getSingleUser = async () => {
  loadingPage.value = true;
  await axios
    .get("/admin/user/single/" + route().params.id)
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

onMounted(() => {
  getSingleUser();
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

const currentForm = ref("account");
const openForm = async (comp) => {
  currentForm.value = comp;
};
</script>

<template>
  <v-container>
    <PageHeader title="Edit User" />
    <v-row class="mb-3" :disabled="loadingPage">
      <div class="v-col-12 v-col-md-8">
        <div class="d-flex">
          <v-btn
            :color="`${currentForm == 'account' ? 'primary' : 'grey-lighten-5'} `"
            size="large"
            class="mr-3"
            :loading="user.loading"
            @click="() => openForm('account')"
            >Account</v-btn
          >
          <v-btn
            :color="`${currentForm == 'profile' ? 'primary' : 'grey-lighten-5'} `"
            size="large"
            :loading="user.loading"
            @click="() => openForm('profile')"
            >profile</v-btn
          >
        </div>
      </div>

      <div class="v-col-12 v-col-md-8">
        <v-card v-show="currentForm == 'account'" :loading="loadingPage">
          <v-card-title class="text-primary text-capitalize mb-3"
            >Account Settings</v-card-title
          >
          <v-card-text>
            <Form as="v-form" :validation-schema="validation">
              <Field
                name="username"
                v-slot="{ field, errors }"
                v-model="user.data.username"
              >
                <v-text-field
                  v-model="user.data.username"
                  v-bind="field"
                  label="Username"
                  variant="outlined"
                  class="mb-2"
                  :error-messages="errors"
                />
              </Field>
              <Field name="email" v-slot="{ field, errors }" v-model="user.data.email">
                <v-text-field
                  v-model="user.data.email"
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
                v-model="user.data.phone_no"
              >
                <v-text-field
                  v-model="user.data.phone_no"
                  v-bind="field"
                  type="number"
                  label="Phone number"
                  variant="outlined"
                  class="mb-2"
                  :error-messages="errors"
                />
              </Field>
              <v-btn
                color="primary"
                size="large"
                :loading="user.loading"
                @click="saveUser"
                >Save</v-btn
              >
            </Form>
          </v-card-text>
        </v-card>
        <v-card v-show="currentForm == 'profile'" :loading="loadingPage">
          <v-card-title class="text-primary text-capitalize mb-3"
            >Profile Settings</v-card-title
          >
          <v-card-text>
            <Form as="v-form" :validation-schema="validation">
              <Field
                name="full_name"
                v-slot="{ field, errors }"
                v-model="user.data.full_name"
              >
                <v-text-field
                  v-model="user.data.full_name"
                  v-bind="field"
                  label="Full name"
                  variant="outlined"
                  class="mb-2"
                  :error-messages="errors"
                />
              </Field>
              <Field name="email" v-slot="{ field, errors }" v-model="user.data.email">
                <v-text-field
                  v-model="user.data.email"
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
                v-model="user.data.phone_no"
              >
                <v-text-field
                  v-model="user.data.phone_no"
                  v-bind="field"
                  type="number"
                  label="Phone number"
                  variant="outlined"
                  class="mb-2"
                  :error-messages="errors"
                />
              </Field>
              <v-btn
                color="primary"
                size="large"
                :loading="user.loading"
                @click="saveUser"
                >Save</v-btn
              >
            </Form>
          </v-card-text>
        </v-card>
      </div>
    </v-row>
  </v-container>
</template>

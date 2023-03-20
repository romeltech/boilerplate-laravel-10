<template>
  <v-card>
    <v-card-title class="text-primary text-capitalize mb-3"
      >Profile Settings</v-card-title
    >
    <v-card-text>
      <Form as="v-form" :validation-schema="validation">
        <Field
          name="full_name"
          v-slot="{ field, errors }"
          v-model="profileData.data.full_name"
        >
          <v-text-field
            v-model="profileData.data.full_name"
            v-bind="field"
            label="Full name"
            variant="outlined"
            class="mb-2"
            :error-messages="errors"
          />
        </Field>
        <Field
          name="dob"
          as="v-text-field"
          v-slot="{ field, errors }"
          v-model="profileData.data.dob"
        >
          <v-text-field
            v-bind="field"
            type="date"
            label="Date of Birth"
            :model-value="profileData.data.dob"
            variant="outlined"
            class="mb-2"
            :error-messages="errors"
          />
        </Field>
        <Field
          name="nationality"
          v-slot="{ field, errors }"
          v-model="profileData.data.nationality"
        >
          <v-autocomplete
            v-model="profileData.data.nationality"
            v-bind="field"
            :items="nationalityList"
            item-title="name"
            item-value="name"
            label="Nationality"
            variant="outlined"
            class="mb-2"
            :error-messages="errors"
          ></v-autocomplete>
        </Field>
        <v-btn
          color="primary"
          size="large"
          :loading="profileData.loading"
          @click="saveProfile"
          >Save</v-btn
        >
      </Form>
    </v-card-text>
  </v-card>
</template>
<script setup>
import { ref, watch, onMounted } from "vue";
import * as yup from "yup";
import { Form, Field } from "vee-validate";
import nationalities from "@/Plugins/json/nationalities.json";

const nationalityList = ref(nationalities);
const props = defineProps(["profile"]);

watch(
  () => props.profile,
  (newVal) => {
    profileData.value.data = { ...profileData.value.data, ...newVal };
    console.log("profileData.data.value", newVal);
  }
);
onMounted(() => {
  profileData.value.data = { ...profileData.value.data, ...props.profile };
});

const profileData = ref({
  loading: false,
  data: {
    user_id: route().params.id,
    full_name: null,
    dob: null,
    nationality: null,
  },
});

let validation = yup.object({
  full_name: yup.string(),
  dob: yup.string(),
  nationality: yup.string(),
});

const saveProfile = async () => {
  let data = profileData.value.data;
  profileData.value.loading = true;
  await axios
    .get("/admin/user/profile/save", data)
    .then((response) => {
      console.log("saveProfile", response);
      profileData.value.data = response.data.user;
      profileData.value.loading = false;
    })
    .catch((err) => {
      profileData.value.loading = false;
      console.log(err.response);
    });
};
</script>

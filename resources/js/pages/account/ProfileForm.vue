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
        <Field name="dob" v-slot="{ field, errors }" v-model="profileData.data.dob">
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
import { Form, Field } from "vee-validate";
import * as yup from "yup";
import nationalities from "@/json/nationalities.json";
import { useRoute } from "vue-router";
import { clientApi } from "@/services/clientApi";
import { VAutocomplete } from "vuetify/components/VAutocomplete";

const route = useRoute();
const props = defineProps(["user"]);
console.log();

// profile
const emit = defineEmits(["saved"]);
const nationalityList = ref([]);
nationalityList.value = nationalities;
const profileData = ref({
  loading: false,
  data: {
    user_id: route.params.id,
    full_name: null,
    dob: null,
    nationality: null,
  },
});
profileData.value.data = Object.assign({}, props.user);
watch(
  () => props.user,
  (newVal) => {
    console.log("props.user", props.user);
    console.log("newVal", newVal);
    profileData.value.data = Object.assign({}, newVal);
    // profileData.value.data = { ...profileData.value.data, ...newVal };
  }
);
console.log("profileData.value.data", profileData.value.data);
const getProfile = async () => {
  await clientApi
    .get("/api/account/profile/" + props.user.id)
    .then((res) => {
      profileData.value.data = Object.assign({}, res.data);
    })
    .catch((err) => {
      profileData.value.loading = false;
      console.log("getProfile", err);
    });
};
getProfile();

// save profile
let validation = yup.object({
  full_name: yup.string(),
  dob: yup.string(),
  nationality: yup.string().notRequired(),
});
const saveProfile = async () => {
  profileData.value.loading = true;
  profileData.value.data = {
    ...profileData.value.data,
    ...{
      id: props.user.id,
    },
  };
  await clientApi
    .post("/api/account/profile/save", profileData.value.data)
    .then((response) => {
      profileData.value.loading = false;
      emit("saved", response.data.message);
    })
    .catch((err) => {
      profileData.value.loading = false;
      console.log(err.response.data);
    });
};
</script>

<template>
  <v-container>
    <PageHeader title="Studio" />
    <v-row>
      <div class="v-col-12">
        <!-- content -->
        <div>
          <div v-bind="getRootProps()">
            <input v-bind="getInputProps()" />
            <p v-if="isDragActive">Drop the files here ...</p>
            <p v-else>Drag 'n' drop some files here, or click to select files</p>
          </div>
          <div></div>
          <button @click="open">open</button>
        </div>
        <div class="preview-container dropzone-previews"></div>
        <!-- <div v-if="filesArray.length > 0">
          <div v-for="(file, index) in filesArray" :key="index">
            {{ file.path }}
            {{ file.dataURL }}
            <v-img :src="file.path"></v-img>
          </div>
        </div>
        <div class="dzone-preview"></div> -->
      </div>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, watch } from "vue";
import PageHeader from "@/components/PageHeader.vue";
import { useDropzone } from "vue3-dropzone";

const url = "/studio/upload"; // Your url on the server side
const filesArray = ref([]);
const saveFiles = (files) => {
  const formData = new FormData(); // pass data as a form
  for (var x = 0; x < files.length; x++) {
    // append files as array to the form, feel free to change the array name
    formData.append("images[]", files[x]);
  }

  // post the formData to your backend where storage is processed. In the backend, you will need to loop through the array and save each file through the loop.

  axios
    .post(url, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then((response) => {
      console.info(response.data);
    })
    .catch((err) => {
      console.error(err);
    });
};
const dzOnDrop = (acceptFiles, rejectReasons) => {
  filesArray.value = acceptFiles;
  console.log("onDrop ", filesArray.value[0]);
  //   console.log("acceptFiles", acceptFiles);
  //   console.log("rejectReasons", rejectReasons);
};
const thumbnail = (file, dataURL) => {
  console.log("dpThumbnail file", file);
  console.log("dpThumbnail dataURL", dataURL);
};
// const dropzoneOptions = {
//   onDrop: dpOnDrop,
//   thumbnail: dpThumbnail,
// };

const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone({
  onDrop: dzOnDrop,
});
// const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone(
//   dropzoneOptions
// );

watch(filesArray, () => {
  console.log("watch filesArray", filesArray.value);
});

watch(isDragActive, () => {
  console.log("getInputProps", getInputProps);
  console.log("watch isDragActive", isDragActive.value, rest);
});
</script>

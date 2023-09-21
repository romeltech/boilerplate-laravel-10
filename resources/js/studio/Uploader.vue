<template>
  <v-container>
    <AppPageHeader title="Studio" />
    <v-row>
      <div class="v-col-12">
        <!-- content -->
        <div id="uploader"></div>
      </div>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, watch } from "vue";
import AppPageHeader from "@/components/AppPageHeader.vue";
import { Dropzone } from "dropzone";

const dropzone = new Dropzone("#uploader", { url: "/studio/upload" });

// let melDropZone = new Dropzone({
//   paramName: "file", // The name that will be used to transfer the file
//   maxFilesize: 2, // MB
//   accept: function (file, done) {
//     if (file.name == "justinbieber.jpg") {
//       done("Naha, you don't.");
//     } else {
//       done();
//     }
//   },
// });

// const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone({ onDrop });
// const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone(
//   dropzoneOptions
// );

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
const dpOnDrop = (acceptFiles, rejectReasons) => {
  filesArray.value = acceptFiles;
  console.log("onDrop ", filesArray.value[0].dataURL);
  //   console.log("acceptFiles", acceptFiles);
  //   console.log("rejectReasons", rejectReasons);
};
const dpThumbnail = (file, dataURL) => {
  console.log("dpThumbnail file", file);
  console.log("dpThumbnail dataURL", dataURL);
};
const dropzoneOptions = {
  onDrop: dpOnDrop,
  thumbnail: dpThumbnail,
};

watch(filesArray, () => {
  console.log("watch filesArray", filesArray.value);
});

watch(isDragActive, () => {
  console.log("watch isDragActive", isDragActive.value, rest);
});
</script>

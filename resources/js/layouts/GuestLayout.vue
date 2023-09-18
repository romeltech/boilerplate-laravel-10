<template>
  <div
    class="h-screen d-flex flex-column justify-start align-center"
    style="background-color: #000000"
  >
    <div>
      <div class="gag-guest-bg" :style="`background-image: url('${bgUrl}')`"></div>
    </div>
    <div class="gag-guest-bg-fill"></div>

    <div
      class="mx-auto px-3 text-center"
      style="z-index: 1; max-width: 320px; width: 100%; margin-top: 50px"
    >
      <v-img :src="`${baseUrl}/assets/images/grandiose-white.png`"></v-img>
      <div class="text-subtitle-1 text-white">{{ appName }}</div>
    </div>
    <slot />
  </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
const appName = ref(import.meta.env.VITE_APP_NAME);
const baseUrl = window.location.origin;
const bgCurrent = ref(1);
const bgUrl = baseUrl + "/assets/images/login-slider/slider-3.jpg";
// const bgItems = ref([
//   {
//     id: 1,
//     src: baseUrl + "/assets/images/login-slider/slider-1.jpg",
//   },
//   {
//     id: 2,
//     src: baseUrl + "/assets/images/login-slider/slider-2.jpg",
//   },
//   {
//     id: 3,
//     src: baseUrl + "/assets/images/login-slider/slider-3.jpg",
//   },
//   {
//     id: 4,
//     src: baseUrl + "/assets/images/login-slider/slider-4.jpg",
//   },
//   {
//     id: 5,
//     src: baseUrl + "/assets/images/login-slider/slider-5.jpg",
//   },
//   {
//     id: 6,
//     src: baseUrl + "/assets/images/login-slider/slider-6.jpg",
//   },
//   {
//     id: 7,
//     src: baseUrl + "/assets/images/login-slider/slider-7.jpg",
//   },
//   {
//     id: 8,
//     src: baseUrl + "/assets/images/login-slider/slider-8.jpg",
//   },
// ]);

// const bgUpdate = () => {
//   if (bgCurrent.value == 8) {
//     bgCurrent.value = 1;
//   } else {
//     bgCurrent.value = bgCurrent.value + 1;
//   }
// };
// onMounted(() => {
//   setInterval(() => {
//     console.log("slider interval");
//     bgUpdate();
//   }, 10000);
// });
</script>

<style scoped>
.gag-guest-bg {
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: absolute;
  top: 0;
  left: 0;
  right: auto;
  bottom: auto;
  width: 100%;
  height: 100%;
  -webkit-animation: fadeIn 10s ease-in-out;
  animation: fadeIn 10s ease-in-out;
}
.gag-guest-bg-fill::before {
  content: "";
  background-color: rgba(0, 0, 0, 0.4);
  height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
}
@-webkit-keyframes fadeIn {
  0% {
    display: none;
    opacity: 0.2;
  }
  5% {
    display: block;
    opacity: 1;
  }
  95% {
    display: block;
    opacity: 1;
  }
  100% {
    display: block;
    opacity: 0.2;
  }
}
@keyframes fadeIn {
  0% {
    display: none;
    opacity: 0.2;
  }
  5% {
    display: block;
    opacity: 1;
  }
  95% {
    display: block;
    opacity: 1;
  }
  100% {
    display: block;
    opacity: 0.2;
  }
}
</style>

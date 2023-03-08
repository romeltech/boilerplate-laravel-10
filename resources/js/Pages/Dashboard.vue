<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AppHeader from "@/Components/Common/AppHeader.vue";
</script>

<template>
  <AuthenticatedLayout>
    <AppHeader :title="'Dashboard'" />
    <div class="py-12">
      <div class="">
        <div class="">
          <div class="p-6 text-gray-900">You're logged in!</div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

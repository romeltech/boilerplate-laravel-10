<template>
  <v-container>
    <v-row>
      <div class="v-col-12 v-col-md-6 mx-auto mt-16">
        <v-alert
          color="error"
          variant="tonal"
          :title="'Unauthorized'"
          :text="'You do not have the right permission to access this page.'"
        >
        </v-alert>
      </div>
    </v-row>
  </v-container>
</template>

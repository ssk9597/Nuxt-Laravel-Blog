<template>
  <h2 class="title">{{ title }}</h2>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';

export default defineComponent({
  props: {
    title: {
      type: String,
      required: true,
    },
  },
});
</script>

<style lang="scss" scopes>
.title {
  text-align: center;
  padding-bottom: 20px;
}
</style>
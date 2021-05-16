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

<style lang="scss" scoped>
.title {
  display: inline-block;
  padding-bottom: 5px;
  margin-bottom: 30px;
  border-bottom: 3px solid #7bc3d1;
}
</style>
<template>
  <div v-if="errors" class="alert-red">
    <p>{{ errors }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';

export default defineComponent({
  props: {
    errors: {
      type: Object,
    },
  },
});
</script>

<style lang="scss" scoped>
.alert-red {
  padding: 5px 10px;
  background: #ffebee;
  margin-bottom: 10px;
  font-size: 12px;
}
</style>
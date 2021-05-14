<template>
  <div v-if="errors" class="alert-red">
    <p v-if="errors.name">{{ errors.name[0] }}</p>
    <p v-if="errors.email">{{ errors.email[0] }}</p>
    <p v-if="errors.password">{{ errors.password[0] }}</p>
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
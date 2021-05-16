<template>
  <div>
    <label class="label">
      <span v-if="check" class="label-check">{{ check }}</span>
      <span class="label-name">{{ name }}</span>
    </label>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';

export default defineComponent({
  props: {
    check: {
      type: String,
    },
    name: {
      type: String,
      required: true,
    },
  },
});
</script>

<style lang="scss" scoped>
.label {
  &-check {
    background-color: #ee4056;
    color: #fff;
    padding: 3px 10px;
    border-radius: 10%;
    font-size: 0.75rem;
    font-weight: 600;
  }
  &-name {
    font-size: 0.8rem;
    padding: 5px;
  }
}
</style>
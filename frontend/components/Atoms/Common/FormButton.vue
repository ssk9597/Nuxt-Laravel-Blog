<template>
  <button class="button" type="submit">{{ name }}</button>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';

export default defineComponent({
  props: {
    name: {
      type: String,
      required: true,
    },
  },
});
</script>

<style lang="scss" scoped>
.button {
  margin-top: 20px;
  width: 100%;
  height: 40px;
  color: #fff;
  background: #40c7c1;
  text-decoration: none;
  border: none;
  outline: none;
  border-radius: 8px;
  cursor: pointer;
  appearance: none;
  transition: 0.2s;

  &:hover {
    background: #78cec8;
  }
}
</style>
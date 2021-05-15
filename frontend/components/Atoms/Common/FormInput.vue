<template>
  <ValidationProvider class="input" :name="name" :rules="rules" v-slot="{ errors }">
    <input
      class="input-area"
      :type="type"
      :placeholder="placeholder"
      :value="value"
      @input="$emit('input', $event.target.value)"
    />
    <p class="input-error">{{ errors[0] }}</p>
  </ValidationProvider>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';

export default defineComponent({
  props: {
    name: {
      type: String,
      required: true,
    },
    rules: {
      type: String,
      required: true,
    },
    type: {
      type: String,
      default: 'text',
    },
    placeholder: {
      type: String,
      required: true,
    },
    value: {
      type: String,
      required: true,
    },
    errors: {
      type: Array,
    },
  },
});
</script>

<style lang="scss" scoped>
.input {
  padding-top: 10px;
  padding-bottom: 15px;
  display: block;

  &-area {
    box-sizing: border-box;
    width: 100%;
    padding: 10px;
    font-size: 14px;
    color: #303030;
    border: solid 1px #eee;
    border-radius: 6px;
    outline: 0;
    transition: 0.3s;
  }

  &-error {
    padding-top: 5px;
    font-size: 12px;
    color: #ee4056;
    font-weight: 600;
  }
}
</style>
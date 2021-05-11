<template></template>

<script lang="ts">
import { defineComponent, ref, computed, useContext } from '@nuxtjs/composition-api';

export default defineComponent({
  middleware: 'login_redirect',
  setup() {},
});
</script>

<style>
</style>
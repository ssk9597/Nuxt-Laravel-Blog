<template>
  <div>
    <Login />
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';
// components
import Login from '@/components/Pages/Login';

export default defineComponent({
  components: { Login },
});
</script>
<template>
  <div>
    <Register />
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';
// components
import Register from '@/components/Pages/Register';

export default defineComponent({
  components: { Register },
});
</script>
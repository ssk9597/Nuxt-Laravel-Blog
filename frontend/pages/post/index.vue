<template>
  <div>
    <Post />
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';
// components
import Post from '@/components/Pages/Post';

export default defineComponent({
  components: { Post },
});
</script>
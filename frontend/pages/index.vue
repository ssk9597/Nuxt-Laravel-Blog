<template>
  <div class="container">
    <FirstView :title="'ポートフォリオ'" :image="require('@/assets/images/background.jpg')" />
    <About />
    <div v-for="post in posts" :key="post.id">
      <nuxt-link :to="post.url">
        <h2>{{ post.title }}</h2>
        <div v-html="post.content"></div>
      </nuxt-link>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed, useContext, onMounted } from '@nuxtjs/composition-api';

// components
import FirstView from '@/components/Atoms/FirstView';
import About from '@/components/Atoms/About';

export default defineComponent({
  components: {
    FirstView,
    About,
  },
  setup() {
    // axios
    const { $axios } = useContext();
    // data
    const posts = ref<string>('');

    onMounted(async () => {
      const res = await $axios.get('/posts/index');
      posts.value = res.data;
      console.log(posts.value);
    });

    return {
      posts,
    };
  },
});
</script>

<style>
</style>

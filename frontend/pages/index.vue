<template>
  <div class="container">
    <FirstView :title="'ポートフォリオ'" :image="require('@/assets/images/background.jpg')" />
    <About />
    <Poftfolio :posts="posts" />
    <Footer />
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed, useContext, onMounted } from '@nuxtjs/composition-api';

// components
import FirstView from '@/components/Organisms/FirstView';
import About from '@/components/Organisms/About';
import Poftfolio from '@/components/Organisms/Poftfolio';
import Footer from '@/components/Organisms/Footer';

export default defineComponent({
  components: {
    FirstView,
    About,
    Poftfolio,
    Footer,
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

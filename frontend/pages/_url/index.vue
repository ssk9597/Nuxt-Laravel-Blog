<template>
  <div v-if="isEdit">
    <h2>詳細ページ</h2>
    <h3>{{ post.title }}</h3>
    <p v-html="post.content"></p>
    <button @click="editContent">編集する</button>
  </div>
</template>

<script lang="ts">
import {
  defineComponent,
  ref,
  computed,
  useContext,
  useRoute,
  onMounted,
} from '@nuxtjs/composition-api';

// cookie
import $cookie from 'cookie-universal-nuxt';

export default defineComponent({
  setup(props, context) {
    // axios
    const { $axios, store } = useContext();
    // route
    const route = useRoute();

    // data
    const post = ref<string>('');
    const isEdit = ref<Boolean>(true);

    // mounted
    onMounted(async () => {
      const url = computed((): String => route.value.params.url);
      const res = await $axios.get(`/posts/show/${url.value}`);
      post.value = res.data;
      console.log(post.value);
    });

    // methods
    const editContent = () => {
      isEdit.value = !isEdit.value;
    };

    return {
      // data
      post,
      isEdit,
      // methods
      editContent,
    };
  },
});
</script>

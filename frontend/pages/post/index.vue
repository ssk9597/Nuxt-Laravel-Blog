<template>
  <div>
    <client-only>
      <div class="post-container">
        <input class="post-form" :placeholder="titlePlaceholder" type="text" v-model="title" />
        <input class="post-form" :placeholder="urlPlaceholder" type="text" v-model="url" />

        <vue-editor class="post-content" v-model="content" />
        <button class="post-btn" @click="sendContent">投稿を保存する</button>
      </div>
    </client-only>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed, useContext } from '@nuxtjs/composition-api';
import { VueEditor } from 'vue2-editor';

export default defineComponent({
  // middleware: 'login_redirect',
  components: { VueEditor },
  setup(props, context) {
    // axios
    const { $axios } = useContext();
    // router
    const router = context.root.$router;
    // data
    const title = ref<string>('');
    const url = ref<string>('');
    const titlePlaceholder = ref<string>('ここにタイトルを入力してください');
    const urlPlaceholder = ref<string>('ここにディレクトリを入力してください');
    const content = ref<string>('');
    const errors = ref<string>('');

    //methods
    const sendContent = async () => {
      try {
        const res = await $axios.post('/posts/store', {
          title: title.value,
          url: url.value,
          content: content.value,
        });
        console.log(res);
        // router.push('/');
      } catch (err) {
        errors.value = err.response.data.errors;
      }
    };

    return {
      // data
      title,
      url,
      titlePlaceholder,
      urlPlaceholder,
      content,
      errors,
      // methods
      sendContent,
    };
  },
});
</script>

<style lang="scss" scoped>
.post-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 30px;
}
.post-form {
  box-sizing: border-box;
  display: block;
  max-width: 600px;
  width: 100%;
  height: 30px;
  padding: 0 10px;
  margin: 10px 0;
  font-size: 12px;
  color: #333;
  border: solid 1px #ccc;
  border-radius: 6px;
  outline: 0;
  transition: 0.3s;
  &:focus {
    border: 1px solid #00b5ad;
  }
}

.post-content {
  margin-top: 20px;
  max-width: 600px;
  width: 100%;
}

.post-btn {
  max-width: 300px;
  width: 100%;
  display: inline-block;
  margin-top: 30px;
  font-size: 1.25rem;
  padding: 0.5rem 0;
  color: #00b5ad;
  background: #fff;
  text-decoration: none;
  user-select: none;
  border: 1px #00b5ad solid;
  border-radius: 20px;
  transition: 0.4s ease;
  cursor: pointer;
  &:hover {
    color: #fff;
    background: #00b5ad;
  }
}
</style>

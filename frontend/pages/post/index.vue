<template>
  <div>
    <div v-if="errors" class="post-alert-red">
      <p v-if="errors.title">{{ errors.title[0] }}</p>
      <p v-if="errors.url">{{ errors.url[0] }}</p>
      <p v-if="errors.content">{{ errors.content[0] }}</p>
    </div>
    <ValidationObserver v-slot="{ invalid }">
      <div class="post-container">
        <ValidationProvider class="post-form" name="タイトル" rules="required" v-slot="{ errors }">
          <input class="post-input" :placeholder="titlePlaceholder" type="text" v-model="title" />
          <p class="post-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <ValidationProvider
          class="post-form"
          name="URL"
          rules="required|alpha_dash"
          v-slot="{ errors }"
        >
          <input class="post-input" :placeholder="urlPlaceholder" type="text" v-model="url" />
          <p class="post-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <ValidationProvider name="本文" rules="required" v-slot="{ errors }">
          <vue-editor class="post-content" v-model="content" />
          <p class="post-input-error">{{ errors[0] }}</p>
        </ValidationProvider>
        <button class="post-btn" :disabled="invalid" @click="sendContent">投稿を保存する</button>
      </div>
    </ValidationObserver>
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
.post-alert-red {
  max-width: 600px;
  width: 100%;
  margin: 20px auto;
  padding: 5px 10px;
  background: #ffebee;
  margin-bottom: 10px;
  font-size: 12px;
}
.post-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 30px;
}
.post-form {
  max-width: 600px;
  width: 100%;
  display: block;
  margin: 10px 0;
}
.post-input {
  box-sizing: border-box;
  width: 100%;
  height: 30px;
  padding: 0 10px;
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
.post-input-error {
  padding-top: 5px;
  font-size: 12px;
  color: #ee4056;
  font-weight: 600;
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

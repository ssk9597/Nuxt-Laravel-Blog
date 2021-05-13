<template>
  <div>
    <div v-if="isEdit">
      <h2>詳細ページ</h2>
      <h3>{{ post.title }}</h3>
      <p v-html="post.content"></p>
      <button v-if="isAuth" @click="edit">編集する</button>
      <button v-if="isAuth" @click="destroy(post.id)">削除する</button>
    </div>
    <div v-else>
      <client-only>
        <button v-if="isAuth" @click="edit">戻る</button>
        <div v-if="errors" class="post-alert-red">
          <p v-if="errors.title">{{ errors.title[0] }}</p>
          <p v-if="errors.url">{{ errors.url[0] }}</p>
          <p v-if="errors.content">{{ errors.content[0] }}</p>
        </div>
        <ValidationObserver v-slot="{ invalid }">
          <div class="post-container">
            <ValidationProvider
              class="post-form"
              name="タイトル"
              rules="required"
              v-slot="{ errors }"
            >
              <input class="post-input" type="text" v-model="title" />
              <p class="post-input-error">{{ errors[0] }}</p>
            </ValidationProvider>
            <ValidationProvider
              class="post-form"
              name="URL"
              rules="required|alpha_dash"
              v-slot="{ errors }"
            >
              <input class="post-input" type="text" v-model="url" />
              <p class="post-input-error">{{ errors[0] }}</p>
            </ValidationProvider>
            <ValidationProvider name="本文" rules="required" v-slot="{ errors }">
              <div class="post-contents">
                <editor-content class="post-content" :editor="editor" />
                <hr />
                <button class="post-content-btn" @click="addImage">写真を追加する</button>
              </div>
              <p class="post-input-error">{{ errors[0] }}</p>
            </ValidationProvider>
            <button class="post-btn" :disabled="invalid" @click="updateContent">
              投稿を保存する
            </button>
          </div>
        </ValidationObserver>
      </client-only>
    </div>
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
  onBeforeUnmount,
} from '@nuxtjs/composition-api';

// tiptap
import { Editor, EditorContent } from '@tiptap/vue-2';
import StarterKit from '@tiptap/starter-kit';
import Highlight from '@tiptap/extension-highlight';
import Typography from '@tiptap/extension-typography';
import Image from '@tiptap/extension-image';
import Dropcursor from '@tiptap/extension-dropcursor';

export default defineComponent({
  components: { EditorContent },
  setup(props, context) {
    // axios
    const { $axios, store } = useContext();
    // route
    const route = useRoute();
    // router
    const router = context.root.$router;

    // data
    const post = ref<string>('');
    const isEdit = ref<Boolean>(true);
    const isAuth = ref<Boolean>(store.state.authenticated);
    const title = ref<string>('');
    const url = ref<string>('');
    const editor = ref<object>();
    const content = ref<string>('');
    const errors = ref<string>('');

    // mounted
    onMounted(async () => {
      const uri = computed((): String => route.value.params.url);
      const res = await $axios.get(`/posts/show/${uri.value}`);
      post.value = res.data;
      // 値を入れる
      title.value = post.value.title;
      url.value = post.value.url;
      editor.value.commands.setContent(post.value.content);
    });

    // mounted
    onMounted(() => {
      editor.value = new Editor({
        content: 'テキストを入力してください',
        extensions: [StarterKit, Highlight, Typography, Image, Dropcursor],
      });
    });

    // methods
    const edit = () => {
      isEdit.value = !isEdit.value;
    };
    const destroy = async (id: Number) => {
      console.log(id);
      await $axios.post(`/posts/${id}/destroy`);
      router.push('/');
    };
    const addImage = async () => {
      const url = window.prompt('URL');

      if (url) {
        editor.value.chain().focus().setImage({ src: url }).run();
      }
    };
    const updateContent = async () => {
      try {
        const uri = computed((): String => route.value.params.url);
        content.value = editor.value.getHTML();
        const res = await $axios.post(`/posts/${uri.value}/update`, {
          title: title.value,
          url: url.value,
          content: content.value,
        });
        router.push('/');
      } catch (err) {
        errors.value = err.response.data.errors;
      }
    };

    return {
      // data
      post,
      isEdit,
      isAuth,
      title,
      url,
      editor,
      content,
      errors,
      // methods
      edit,
      destroy,
      addImage,
      updateContent,
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
.post-contents {
  margin-top: 20px;
  padding: 10px 10px;
  width: 600px;
  border: 1px solid #ccc;
  border-radius: 6px;
}
.post-content {
  width: 580px;
  margin-bottom: 10px;
  &-btn {
    margin-top: 5px;
    display: inline-block;
    padding: 0.5em 1.8em;
    font-size: 0.8rem;
    color: #fff;
    background: #00b5ad;
    border: 1px #fff solid;
    text-decoration: none;
    user-select: none;
    border-radius: 20px;
    transition: 0.4s ease;
    cursor: pointer;
    &:hover {
      color: #00b5ad;
      background: #fff;
      border: 1px #00b5ad solid;
    }
  }
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

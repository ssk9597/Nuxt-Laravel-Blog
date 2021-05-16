<template>
  <div>
    <client-only>
      <FormError :errors="errors" />
      <ValidationObserver v-slot="{ invalid }">
        <div class="post-container">
          <FormInput
            :name="'タイトル'"
            :rules="'required'"
            :type="'text'"
            :placeholder="titlePlaceholder"
            v-model="title"
          />
          <FormInput
            :name="'URL'"
            :rules="'required|alpha_dash'"
            :type="'text'"
            :placeholder="urlPlaceholder"
            v-model="url"
          />
          <ValidationProvider name="本文" rules="required" v-slot="{ errors }">
            <div class="post-contents">
              <editor-content class="post-content" :editor="editor" />
              <hr />
              <button class="post-content-btn" @click="addImage">写真を追加する</button>
            </div>
            <p class="post-input-error">{{ errors[0] }}</p>
          </ValidationProvider>
          <button class="post-btn" :disabled="invalid" @click="sendContent">投稿を保存する</button>
        </div>
      </ValidationObserver>
    </client-only>
  </div>
</template>

<script lang="ts">
import {
  defineComponent,
  ref,
  computed,
  useContext,
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

//components
import FormError from '@/components/Atoms/Common/FormError';
import FormInput from '@/components/Atoms/Post/FormInput';

export default defineComponent({
  middleware: 'login_redirect',
  components: {
    EditorContent,
    FormError,
    FormInput,
  },
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
    const editor = ref<object>();
    const content = ref<string>('');
    const errors = ref<string>('');

    // mounted
    onMounted(() => {
      editor.value = new Editor({
        content: 'テキストを入力してください',
        extensions: [StarterKit, Highlight, Typography, Image, Dropcursor],
      });
    });

    //methods
    const addImage = async () => {
      const url = window.prompt('URL');

      if (url) {
        editor.value.chain().focus().setImage({ src: url }).run();
      }
    };
    const sendContent = async () => {
      try {
        content.value = editor.value.getHTML();
        const res = await $axios.post('/posts/store', {
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
      title,
      url,
      titlePlaceholder,
      urlPlaceholder,
      editor,
      content,
      errors,
      // methods
      addImage,
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

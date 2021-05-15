<template>
  <div class="login-container">
    <ValidationObserver v-slot="{ invalid }">
      <form class="login-wrapper" @submit.prevent="loginUser()">
        <FormTitle :title="'ログイン'" />
        <FormError :errors="errors" />
        <!-- メールアドレス -->
        <FormLabel :name="'メールアドレス'" />
        <FormInput
          :name="'メールアドレス'"
          :rules="'required|email'"
          :type="'email'"
          :placeholder="'例）taro@example.com'"
          v-model="email"
        />
        <!-- パスワード -->
        <FormLabel :name="'パスワード'" />
        <FormInput
          :name="'パスワード'"
          :rules="'required|min:8|alpha_dash'"
          :type="'password'"
          :placeholder="'例）taroTanaka'"
          v-model="password"
        />
        <!-- 新規追加 -->
        <FormButton :name="'ログイン'" :disabled="invalid" />
      </form>
    </ValidationObserver>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, useContext } from '@nuxtjs/composition-api';
//components
import FormError from '@/components/Atoms/Login/FormError';
import FormTitle from '@/components/Atoms/Common/FormTitle';
import FormLabel from '@/components/Atoms/Common/FormLabel';
import FormInput from '@/components/Atoms/Common/FormInput';
import FormButton from '@/components/Atoms/Common/FormButton';

export default defineComponent({
  components: {
    FormError,
    FormTitle,
    FormLabel,
    FormInput,
    FormButton,
  },
  setup(props, context) {
    // axios
    const { $axios, store } = useContext();
    // router
    const router = context.root.$router;
    // data
    const email = ref<string>('');
    const password = ref<string>('');
    const errors = ref<string>('');

    // methods
    const loginUser = async () => {
      try {
        // ログイン
        const res = await $axios.post('/users/login', {
          email: email.value,
          password: password.value,
        });

        // error_message
        errors.value = res.data.message;

        // token
        await $axios.setToken(res.data.token, 'Bearer');

        // ログイン成功
        await store.commit('updateAuthenticated');

        // errorがない時TOPページへ移動する
        if (!errors.value) {
          router.push('/post');
        }
      } catch (err) {
        errors.value = err.response.data.errors;
      }
    };

    return {
      // data
      email,
      password,
      errors,
      // methods
      loginUser,
    };
  },
});
</script>

<style lang="scss" scoped>
.login {
  &-container {
    position: relative;
    height: 100vh;
    width: 100%;
    background-color: #eeeeee;
  }

  &-wrapper {
    position: absolute;
    top: 50%;
    right: 50%;
    transform: translateX(50%) translateY(-50%);
    max-width: 400px;
    width: 100%;
    background-color: #fff;
    border-radius: 10px;
    padding: 50px 50px;
  }
}
</style>

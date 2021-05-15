<template>
  <div class="register-container">
    <ValidationObserver v-slot="{ invalid }">
      <form class="register-wrapper" @submit.prevent="registerUser()">
        <FormTitle :title="'新規登録'" />
        <FormError :errors="errors" />
        <!-- 姓 -->
        <FormLabel :check="'必須'" :name="'姓'" />
        <FormInput :name="'姓'" :rules="'required'" :placeholder="'例）田中'" v-model="lastName" />
        <!-- 名 -->
        <FormLabel :check="'必須'" :name="'名'" />
        <FormInput :name="'名'" :rules="'required'" :placeholder="'例）太郎'" v-model="firstName" />
        <!-- メールアドレス -->
        <FormLabel :check="'必須'" :name="'メールアドレス'" />
        <FormInput
          :name="'メールアドレス'"
          :rules="'required|email'"
          :type="'email'"
          :placeholder="'例）taro@example.com'"
          v-model="email"
        />
        <!-- パスワード -->
        <FormLabel :check="'必須'" :name="'パスワード'" />
        <FormInput
          :name="'パスワード'"
          :rules="'required|min:8|alpha_dash'"
          :type="'password'"
          :placeholder="'例）taroTanaka'"
          v-model="password"
        />
        <!-- 新規追加 -->
        <button class="register-button" type="submit" :disabled="invalid">新規登録</button>
      </form>
    </ValidationObserver>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, computed, useContext } from '@nuxtjs/composition-api';
// components
import FormTitle from '@/components/Atoms/Common/FormTitle';
import FormError from '@/components/Atoms/Common/FormError';
import FormLabel from '@/components/Atoms/Common/FormLabel';
import FormInput from '@/components/Atoms/Common/FormInput';

export default defineComponent({
  components: { FormTitle, FormError, FormLabel, FormInput },
  setup(props, context) {
    // axios
    const { $axios, store } = useContext();
    // router
    const router = context.root.$router;
    // data
    const lastName = ref<string>('');
    const firstName = ref<string>('');
    const email = ref<string>('');
    const password = ref<string>('');
    const errors = ref<string>('');

    // computed
    const name = computed((): string => {
      return `${lastName.value} ${firstName.value}`;
    });

    // methods
    const registerUser = async () => {
      try {
        // 新規登録
        await $axios.post('/users/register', {
          name: name.value,
          email: email.value,
          password: password.value,
        });

        // ログイン
        const res = await $axios.post('/users/login', {
          email: email.value,
          password: password.value,
        });

        // token
        await $axios.setToken(res.data.token, 'Bearer');

        // ログイン成功
        await store.commit('updateAuthenticated');

        // ルーティング処理
        router.push('/');
      } catch (err) {
        errors.value = err.response.data.errors;
      }
    };

    return {
      // data
      lastName,
      firstName,
      email,
      password,
      errors,
      // computed
      name,
      // methods
      registerUser,
    };
  },
});
</script>

<style lang="scss" scoped>
.register {
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

  &-button {
    margin-top: 20px;
    width: 100%;
    height: 40px;
    color: #fff;
    background: #40c7c1;
    text-decoration: none;
    border: none;
    outline: none;
    border-radius: 8px;
    cursor: pointer;
    appearance: none;
    transition: 0.2s;

    &:hover {
      background: #78cec8;
    }
  }
}
</style>

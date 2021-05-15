<template>
  <div v-if="errors" class="alert-red">
    <!-- 新規登録 -->
    <p v-if="errors.name">{{ errors.name[0] }}</p>
    <p v-if="errors.email">{{ errors.email[0] }}</p>
    <p v-if="errors.password">{{ errors.password[0] }}</p>
    <!-- 投稿 -->
    <p v-if="errors.title">{{ errors.title[0] }}</p>
    <p v-if="errors.url">{{ errors.url[0] }}</p>
    <p v-if="errors.content">{{ errors.content[0] }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';

export default defineComponent({
  props: {
    errors: {
      type: Object,
    },
  },
});
</script>

<style lang="scss" scoped>
.alert-red {
  padding: 5px 10px;
  background: #ffebee;
  margin-bottom: 10px;
  font-size: 12px;
}
</style>
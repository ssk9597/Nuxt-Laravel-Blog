<template>
  <div class="portfolio">
    <HeadingH2 class="portfolio-title" :title="'Portfolio me'" />
    <Card class="portfolio-card" :posts="posts" :image="image" />
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';
import HeadingH2 from '@/components/Atoms/HeadingH2';
import Card from '@/components/Atoms/Card';

export default defineComponent({
  components: {
    HeadingH2,
    Card,
  },
  props: {
    posts: {
      type: Array,
    },
    image: {
      type: String,
      default: require('@/assets/images/test.jpg'),
    },
  },
});
</script>

<style lang="scss" scoped>
.portfolio {
  position: relative;
  &-title {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%);
  }

  &-card {
    padding-top: 80px;
  }
}
</style>
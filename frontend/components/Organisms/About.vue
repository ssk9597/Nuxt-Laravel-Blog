<template>
  <div class="about">
    <HeadingH2 :title="'About me'" />
    <img class="about-img" :src="require('@/assets/images/profile.png')" />
    <p class="about-text">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br />
      Duis sed dapibus leo nec ornare diam. <br />
      Sed commodo nibh ante facilisis bibendum dolor feugiat at.
    </p>
    <br />
    <p class="about-text">
      Duis sed dapibus leo nec ornare diam commodo nibh. <br />
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br />
      Duis sed dapibus leo nec ornare diam. <br />
      Sed commodo nibh ante facilisis bibendum dolor feugiat at. <br />
      Duis sed dapibus leo nec ornare.
    </p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from '@nuxtjs/composition-api';
import HeadingH2 from '@/components/Atoms/HeadingH2';
export default defineComponent({
  components: {
    HeadingH2,
  },
});
</script>

<style lang="scss" scoped>
.about {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 80px 0;

  &-title {
    display: inline-block;
    padding-bottom: 5px;
    margin-bottom: 30px;
    border-bottom: 3px solid #7bc3d1;
  }

  &-img {
    width: 200px;
    padding-bottom: 20px;
  }

  &-text {
    padding: 0 20px;
  }
}
</style>
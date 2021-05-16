<template>
  <div class="first-view" :style="{ backgroundImage: `url(${image})` }">
    <div class="first-view-inner">
      <p class="first-view-ttl">
        {{ title }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    image: {
      type: String,
      default: require('@/assets/images/background.jpg'),
    },
    title: {
      type: String,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
.first-view {
  height: 300px;
  background-position: center;
  background-size: cover;

  &-inner {
    position: relative;
    max-width: 1230px;
    height: 100%;
    margin: 0 auto;
  }

  &-ttl {
    position: absolute;
    top: 50%;
    padding: 15px;
    background: rgba(0, 0, 0, 0.75);
    color: #fff;
    font-size: 1.25rem;
    transform: translateY(-50%);
  }
}
//560px以上はタブレット
@media screen and (min-width: 560px) {
  .first-view {
    height: 50vh;

    &-inner {
      position: relative;
      max-width: 1230px;
      height: 100%;
      margin: 0 auto;
    }

    &-ttl {
      padding: 40px;
      font-size: calc(3.704vw - 8.444px);
    }
  }
}

//960px以上はPC
@media screen and (min-width: 960px) {
  .first-view {
    height: 60vh;

    &-inner {
      position: relative;
      max-width: 1230px;
      height: 100%;
      margin: 0 auto;
    }

    &-ttl {
      padding: 40px;
      font-size: calc(3.704vw - 8.444px);
    }
  }
}
</style>
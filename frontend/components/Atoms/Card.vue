<template>
  <div class="card-wrapper">
    <div class="container" v-for="post in posts" :key="post.id">
      <nuxt-link :to="post.url" class="bl-card">
        <figure class="bl-card-imgWrapper">
          <img :src="image" alt="" />
        </figure>
        <div class="bl-card-body">
          <h3 class="bl-card-ttl">{{ post.title }}</h3>
        </div>
      </nuxt-link>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    posts: {
      type: Array,
      required: true,
    },
    image: {
      type: String,
      default: require('@/assets/images/test.jpg'),
    },
  },
};
</script>

<style lang="scss" scoped>
.card-wrapper {
  margin-bottom: -40px;
}

.container {
  margin-bottom: 40px;
}

.bl-card {
  display: block;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
  color: currentColor;
  text-decoration: none;
  transition: 0.25s;

  &:focus,
  &:hover {
    opacity: 0.75;
  }

  &-imgWrapper {
    position: relative;
    padding-top: 56.25%;
    overflow: hidden;

    & img {
      position: absolute;
      top: 50%;
      width: 100%;
      transform: translateY(-50%);
    }
  }

  &-body {
    padding: 15px;

    &*:last-child {
      margin-bottom: 0;
    }
  }

  &-ttl {
    margin-bottom: 5px;
    font-size: 1.125rem;
    font-weight: bold;
    transition: 0.25s;
  }
}

// //560px以上はタブレット
@media screen and (min-width: 560px) {
  .card-wrapper {
    display: flex;
    flex-wrap: wrap;
  }

  .container {
    flex-basis: calc((100% - 4%) / 2);
    margin-right: 4%;

    &:nth-of-type(2n) {
      margin-right: 0%;
    }
  }

  .bl-card {
    &-ttl {
      font-size: 1.5rem;
    }
  }
}

// //960px以上はPC
@media screen and (min-width: 960px) {
  //3カラム
  .container {
    flex-basis: calc((100% - 8%) / 3);

    &:nth-of-type(2n) {
      margin-right: 4%;
    }

    &:nth-of-type(3n) {
      margin-right: 0%;
    }
  }

  .bl-card {
    &-ttl {
      font-size: 1.75rem;
    }
  }
}
</style>
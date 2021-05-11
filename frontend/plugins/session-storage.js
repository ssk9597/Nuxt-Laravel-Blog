import createPersistedState from 'vuex-persistedstate';

export default ({ store }) => {
  window.onNuxtReady(() => {
    createPersistedState({
      key: 'nuxt-laravel-blog',
      paths: ['authenticated'],
      storage: window.sessionStorage,
    })(store);
  });
};

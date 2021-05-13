import createPersistedState from 'vuex-persistedstate';
import * as Cookies from 'js-cookie';
import cookie from 'cookie';

export default ({ store, req, isDev }) => {
  createPersistedState({
    key: 'nuxt-laravel-blog',
    paths: ['authenticated'],
    storage: {
      getItem: (key) =>
        process.client ? Cookies.getJSON(key) : cookie.parse(req.headers.cookie || '')[key],
      setItem: (key, value) => Cookies.set(key, value, { expires: 1, secure: !isDev }),
      removeItem: (key) => Cookies.remove(key),
    },
  })(store);
};

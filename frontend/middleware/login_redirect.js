import $cookies from 'cookie-universal-nuxt';

export default function ({ redirect, app }) {
  const login = app.$cookies.get('nuxt-laravel-blog').authenticated;
  console.log(login);

  if (!login) {
    redirect('/login');
  }
}

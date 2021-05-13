export default function ({ redirect, app }) {
  const login = app.$cookies.get('nuxt-laravel-blog');

  // cookie情報が入っていないときはログインページにリダイレクトされる
  if (!login) {
    redirect('/login');
  }

  // cookie情報が入っていてもfalseの場合はログインページにリダイレクトされる
  if (!login.authenticated) {
    redirect('/login');
  }
}

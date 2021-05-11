export default function ({ store, redirect }) {
  const login = store.state.auth.authenticated;
  if (!login) {
    redirect('/login');
  }
}

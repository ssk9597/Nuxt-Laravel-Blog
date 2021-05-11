export default function ({ store, redirect }) {
  const login = sessionStorage.getItem('authenticated');
  if (!login) {
    redirect('/login');
  }
}

export const state = () => ({
  // ログイン状態
  authenticated: false,
});

export const mutations = {
  initAuthenticated(state) {
    state.authenticated = false;
  },
  updateAuthenticated(state) {
    state.authenticated = !state.authenticated;
  },
};

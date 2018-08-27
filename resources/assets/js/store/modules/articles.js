// initial state
const state = {
  all: []
}

// getters
const getters = {}

// actions
const actions = {
  getAllArticles({ commit }) {
    axios
      .get("/articles")
      .then(response => (commit('setArticles', response.data.data)));
  }
}

// mutations
const mutations = {
  setArticles (state, articles) {
    state.all = articles
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

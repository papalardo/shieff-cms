// initial state
const state = {
  all: []
}

// getters
const getters = {}

// actions
const actions = {
  getAllUsers ({ commit }) {
    axios
      .get("/users")
      .then(response => (commit('setUsers', response.data.data)));
  }
}

// mutations
const mutations = {
  setUsers (state, users) {
    state.all = users
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

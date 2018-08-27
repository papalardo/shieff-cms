// initial state
const state = {
  all: [],
  show: {}
}

// getters
const getters = {}

// actions
const actions = {
  all({ commit }) {
    axios.get("/products")
      .then(response => (commit('setProducts', response.data.data)));
  },
  show({ commit }, id) {
    axios.get("/products/" + id)
      .then(response => (commit('setProduct', response.data.data)));
  },
  async delete({ commit }, product) {
    await axios.delete("/products/" + product.id);
    commit('deleteProduct', product);
  }
}

// mutations
const mutations = {
  setProducts (state, products) {
    state.all = products
  },
  setProduct (state, product) {
    state.show = product
  },
  deleteProduct (state, product) {
    state.all.splice(state.all.findIndex(e => e.id == product.id), 1);
  },
  updateProduct (state, product) {
    let index = state.all.findIndex(e => e.id == product.id);
    state.all[index] = product;
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

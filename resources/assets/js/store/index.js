import Vue from 'vue'
import Vuex from 'vuex'
import users from './modules/users'
import articles from './modules/articles'
import products from './modules/products'
import createLogger from 'vuex/dist/logger'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    users,
    articles,
    products
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})

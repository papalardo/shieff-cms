<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <router-link :to="{ name: 'ProductsCreate' }"> Novo </router-link>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-4" v-for="article in articles">
          <b-card v-bind:header="article.name">
            {{ article.description }}
            <router-link :to="{ name: 'ProductsEdit', params: { id: article.id }}"> Editar </router-link>
            <a @click="destroy(article)"> Deletar </a>
          </b-card>
        </div><!--/.col-->
      </div><!--/.row-->
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'ProductsList',
  created () {
    this.$store.dispatch('products/all');
  },
  computed: mapState({
    articles: state => state.products.all
  }),
  methods: {
    async destroy (product) {
     await this.$store.dispatch('products/delete', product);
      console.log('after dispatch')
    }
  },
  
}
</script>

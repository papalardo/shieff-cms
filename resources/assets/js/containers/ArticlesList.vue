<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-6 col-md-4" v-for="article in articles">
        <b-card v-bind:header="article.title">
          {{ article.content }}
        </b-card>
      </div><!--/.col-->
    </div><!--/.row-->
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'ArticlesList',
  computed: mapState({
    articles: state => state.articles.all
  }),
  methods: {},
  created () {
    this.$store.dispatch('articles/getAllArticles')
  }
}
</script>

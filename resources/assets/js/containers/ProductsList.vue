<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <b-button type="button" variant="primary" @click="myModal = true">Launch demo modal</b-button>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-4" v-for="article in articles">
          <b-card v-bind:header="article.name">
            {{ article.description }}
          </b-card>
        </div><!--/.col-->
      </div><!--/.row-->
    </div>
    <b-modal title="Modal title" v-model="myModal" @ok="myModal = false">
       <b-card>
          <div slot="header">
            <strong>Normal</strong> Form
          </div>
          <b-form-fieldset
            label="Email"
            description="Please enter your email.">
            <b-form-input type="email" placeholder="Enter Email.."></b-form-input>
          </b-form-fieldset>
          <b-form-fieldset
            label="Password"
            description="Please enter your password.">
            <b-form-input type="email" placeholder="Enter Password.."></b-form-input>
          </b-form-fieldset>
          <div slot="footer">
            <b-button type="submit" size="sm" variant="primary"><i class="fa fa-dot-circle-o"></i> Submit</b-button>
            <b-button type="reset" size="sm" variant="danger"><i class="fa fa-ban"></i> Reset</b-button>
          </div>
        </b-card>
      </b-modal>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'ArticlesList',
  data () {
    return {
      myModal: false
    }
  },
  computed: mapState({
    articles: state => state.products.all
  }),
  methods: {},
  created () {
    this.$store.dispatch('products/getAll')
  }
}
</script>

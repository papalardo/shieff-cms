<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12">
          <b-card>
            <div slot="header">
              <strong>Novo</strong> produto
            </div>
            <b-form-fieldset
              label="Nome">
              <b-form-input type="text" v-model="model.name" placeholder="Enter Email.."></b-form-input>
            </b-form-fieldset>
            <b-form-fieldset
              label="Descrição">
              <b-form-input type="text" v-model="model.description" placeholder="Enter Email.."></b-form-input>
            </b-form-fieldset>
            <b-form-fieldset
              label="Preço">
              <b-form-input type="number" step="0.01" v-model="model.price" placeholder="Enter Email.."></b-form-input>
            </b-form-fieldset>
            <div slot="footer">
              <b-button type="submit" size="sm" variant="primary" @click="update">
                <i class="fa fa-dot-circle-o"></i> Submit</b-button>
              <b-button type="reset" size="sm" variant="danger"><i class="fa fa-ban"></i> Reset</b-button>
            </div>
          </b-card>
        </div>
      </div><!--/.row-->
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'ProductsEdit',
  data () {
    return {
      model: {
        name: '',
        description: '',
        price: 0,
        category_id: 1
      }
    }
  },
  created () {
    this.fetch();
  },
  methods: {
    async fetch () {
      try {
        let res = await axios.get('products/' + this.$route.params.id);
        this.model = res.data.data;
      } catch (e) {
        console.log(e);
      }
    },
    async update () {
      try {
        this.$store.commit(deleteProduct, this.model)
        let res = await axios.put('products/' + this.$route.params.id, this.model);
        this.$route.push('products');
      } catch (e) {
        console.log(e)
      }
    }
  }
}
</script>

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
              <b-form-input type="text" v-model="model.name" placeholder="Digite o nome.."></b-form-input>
            </b-form-fieldset>
            <b-form-fieldset
              label="Descrição">
              <b-form-input type="text" v-model="model.description" placeholder="Digite a descrição.."></b-form-input>
            </b-form-fieldset>
            <b-form-fieldset
              label="Preço">
              <b-form-input type="number" v-model="model.price" placeholder="Digite o preço.." @keyup.enter="create"></b-form-input>
            </b-form-fieldset>
            <div slot="footer">
              <b-button type="submit" size="sm" variant="primary" @click="create">
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
  name: 'ProductsCreate',
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
  methods: {
    async create () {
      try {
        let res = await axios.post('products', this.model);
        console.log(res);
      } catch (e) {
        console.log(e)
      }
    }
  },
}
</script>

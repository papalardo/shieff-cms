<template>
<div class="animated fadeIn">
  <div class="row">
    <div class="col-12">
      <b-card header="<i class='fa fa-align-justify'></i> Users Management">
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Roles</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users">
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.roles }}</td>
              <td>
                <span class="badge badge-success">Active</span>
              </td>
            </tr>
          </tbody>
        </table>
      </b-card>
    </div><!--/.col-->
  </div><!--/.row-->
</div>

</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  name: 'UserList',
  computed: mapState({
    users: state => state.users.all
  }),
  methods: {},
  created () {
    this.$store.dispatch('users/getAllUsers')
  }
}
</script>

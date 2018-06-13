<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1 class="float-left">Edit Employee</h1>
                                    <router-link :to="{ name: 'employees.index'}" class="btn btn-primary float-right">Back</router-link>
                                </div>

                            </div>

                            <div class="card-body">
                                <form v-if="!loading" v-on:submit.prevent="updateEmployee(employee.id)" id="edit_employee" name="edit-employee" enctype="multipart/form-data">
                                    <employee-form :serverErrors="serverErrors" :employee="employee"></employee-form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </admin-component>
</template>
<script>
  import EmployeeForm from "./EmployeeForm";
  export default {
      components: {EmployeeForm},
      $_veeValidate: {
      validator: 'new' // give me a new validator each time.
    },

    data () {
      return {
        loading: true,
        loadingText: '',
        loadingSpinner: '',
        employee: {},
        serverErrors: []
      }
    },

    mounted () {
        this.getEmployee(this.$route.params.id)
    },

    methods: {
      /**
       * Get current employee being edited.
       * @param id
       */
      getEmployee (id) {
        window.axios.get(this.API_ROUTE + 'employees/' + id).then(response => {
          this.employee = response.data.employee
          this.loading = false
        })
      },

      /**
       * Update the current employee.
       * @param id
       */
      updateEmployee (id) {
        this.loadingSpinner = 'loading-socket'
        this.loadingText = 'Working..'
        this.loading = true

        this.$validator.validateAll().then((result) => {
          if (result) {
            window.axios.patch(this.API_ROUTE + 'employees/' + id, this.employee ).then(response => {
              this.$router.push({
                name: 'employees.index',
                params: {
                  flash: {
                    message: 'Successfully updated ' + response.data.employee.title + '!', type: 'success'
                  }
                }
              })
            }).catch(error => {
              if (error.response.data.errors) {
                this.serverErrors = error.response.data.errors
              }
              flash(error.response.data.message, 'error')
            })

            return
          }
          this.loading = false
        })
      }
    }
  }
</script>
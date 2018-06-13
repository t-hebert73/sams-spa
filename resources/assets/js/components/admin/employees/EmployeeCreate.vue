<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1 class="float-left">Create A Employee</h1>
                                    <router-link :to="{ name: 'employees.index'}" class="btn btn-primary float-right">Back</router-link>
                                </div>

                            </div>

                            <div class="card-body">
                                <form v-if="!loading" v-on:submit.prevent="createEmployee()" enctype="multipart/form-data">
                                    <employee-form :serverErrors="serverErrors" :employee="employee" :createEmployee="createMenuItem"></employee-form>
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
  import EmployeeForm from './EmployeeForm'
  export default {
    components: {EmployeeForm},
    $_veeValidate: {
      validator: 'new' // give me a new validator each time.
    },

    data () {
      return {
        loading: false,
        loadingText: '',
        loadingSpinner: '',
        employee: {
          name: '',
        },
        createMenuItem: true,
        serverErrors: {}
      }
    },

    mounted () {

    },

    methods: {
      /**
       * Create new employee.
       */
      createEmployee () {
        this.loadingText = 'Working..'
        this.loadingSpinner = 'loading-socket'
        this.loading = true

        this.$validator.validateAll().then((result) => {

          if (result) {
            window.axios.post(this.API_ROUTE + 'employees', this.employee ).then(response => {
              flash('Successfully created ' + response.data.employee.name + '!', 'success')
              this.$router.push({
                name: 'employees.index',
                params: {
                  flash: {
                    message: 'Successfully created ' + response.data.employee.name + '!', type: 'success'
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
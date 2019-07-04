<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1 class="float-left">Create A Service Category</h1>
                                    <router-link :to="{ name: 'service-categories.index'}" class="btn btn-primary float-right">Back</router-link>
                                </div>

                            </div>

                            <div class="card-body">
                                <form v-if="!loading" v-on:submit.prevent="createServiceCategory()" enctype="multipart/form-data">
                                    <serviceCategory-form :serverErrors="serverErrors" :serviceCategory="serviceCategory"></serviceCategory-form>
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
  import ServiceCategoryForm from './ServiceCategoryForm'
  export default {
    components: {ServiceCategoryForm},
    $_veeValidate: {
      validator: 'new' // give me a new validator each time.
    },

    data () {
      return {
        loading: false,
        loadingText: '',
        loadingSpinner: '',
        serviceCategory: {
          name: '',
        },
        serverErrors: {}
      }
    },

    mounted () {

    },

    methods: {
      /**
       * Create new serviceCategory.
       */
      createServiceCategory () {
        this.loadingText = 'Working..'
        this.loadingSpinner = 'loading-socket'
        this.loading = true

        this.$validator.validateAll().then((result) => {

          if (result) {
            window.axios.post(this.API_ROUTE + 'service-categories', this.serviceCategory ).then(response => {
              flash('Successfully created ' + response.data.serviceCategory.name + '!', 'success')
              this.$router.push({
                name: 'service-categories.index',
                params: {
                  flash: {
                    message: 'Successfully created ' + response.data.serviceCategory.name + '!', type: 'success'
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
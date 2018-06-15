<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1 class="float-left">Edit Service Category</h1>
                                    <router-link :to="{ name: 'service-categories.index'}" class="btn btn-primary float-right">Back</router-link>
                                </div>

                            </div>

                            <div class="card-body">
                                <form v-if="!loading" v-on:submit.prevent="updateServiceCategory(serviceCategory.id)" id="edit_serviceCategory" name="edit-serviceCategory" enctype="multipart/form-data">
                                    <service-category-form :serverErrors="serverErrors" :serviceCategory="serviceCategory"></service-category-form>
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
  import ServiceCategoryForm from "./ServiceCategoryForm";
  export default {
      components: {ServiceCategoryForm},
      $_veeValidate: {
      validator: 'new' // give me a new validator each time.
    },

    data () {
      return {
        loading: true,
        loadingText: '',
        loadingSpinner: '',
        serviceCategory: {},
        serverErrors: []
      }
    },

    mounted () {
        this.getServiceCategory(this.$route.params.id)
    },

    methods: {
      /**
       * Get current serviceCategory being edited.
       * @param id
       */
      getServiceCategory (id) {
        window.axios.get(this.API_ROUTE + 'service-categories/' + id).then(response => {
          this.serviceCategory = response.data.serviceCategory
          this.loading = false
        })
      },

      /**
       * Update the current serviceCategory.
       * @param id
       */
      updateServiceCategory (id) {
        this.loadingSpinner = 'loading-socket'
        this.loadingText = 'Working..'
        this.loading = true

        this.$validator.validateAll().then((result) => {
          if (result) {
            window.axios.patch(this.API_ROUTE + 'service-categories/' + id, this.serviceCategory ).then(response => {
              this.$router.push({
                name: 'service-categories.index',
                params: {
                  flash: {
                    message: 'Successfully updated ' + response.data.serviceCategory.name + '!', type: 'success'
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
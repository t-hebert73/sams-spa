<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>Service Category Management</h1>

                                    <div class="card-text">
                                        <p>Below are all the service categories in the system. Add more or modify/remove the existing
                                            ones.</p>

                                        <div class="actions">
                                            <a href="#" @click.prevent="createServiceCategory()" class="btn btn-primary mr-2">Create Service Category</a>

                                            <!-- <router-link class="btn btn-secondary" :to="{name: 'menu-editor.index' }">Menu Editor</router-link>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="serviceCategories">
                                    <table class="table table-striped table-hover table-bordered table-branded mb-0">
                                        <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th width="200px;">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-bind:class="['serviceCategory hover-pointer', 'read-service-category-'+serviceCategory.id]"
                                            @click="showServiceCategory($event, serviceCategory.id)" v-for="(serviceCategory, i) in serviceCategories">
                                            <td class="serviceCategory-num">{{ serviceCategory.id }}</td>
                                            <td class="serviceCategory-name">{{ serviceCategory.name }}</td>
                                            <td>
                                                <a href="#" @click.prevent="modifyServiceCategory(serviceCategory.id)"
                                                   v-bind:class="['btn btn-info', 'edit-serviceCategory-'+serviceCategory.id]">Edit</a>
                                                <a href="#" @click.prevent="deleteServiceCategory(serviceCategory.id)"
                                                   v-bind:class="['btn btn-danger', 'delete-serviceCategory-'+serviceCategory.id]">Delete</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </admin-component>
</template>

<script>
  export default {
    data () {
      return {
        params: {
          title: ''
        },
        serviceCategories: [],
        serviceCategory: {
          id: '',
          name: ''
        },
        loading: false
      }
    },

    mounted () {

      this.getServiceCategories()

    },

    methods: {

      /**
       * Show a specified serviceCategory.
       *
       * @param id
       */
      showServiceCategory (event, id) {
        // only if you didn't click a link within
/*        if (!$(event.target).is('a')) {
          this.$router.push({
            name: 'serviceCategories.show',
            params: {
              id: id
            }
          })
        }*/
      },

      /**
       * Get all serviceCategories.
       */
      getServiceCategories (apiRoute) {
        this.clearServiceCategories()
        apiRoute = apiRoute || this.API_ROUTE + 'service-categories'

        window.axios.get(apiRoute).then(response => {
          this.serviceCategories = response.data.serviceCategories
          this.loading = false
        }).catch(error => {
          flash('Error loading serviceCategories. Reason: ' + error.response.data.message, 'error')
        })
      },

      /**
       * Clear all currently shown serviceCategories.
       */
      clearServiceCategories: function () {
        this.serviceCategories = []
        this.loading = true
      },

      /**
       * Route to create serviceCategory
       */
      createServiceCategory () {
        this.$router.push({
          name: 'service-categories.create'
        })
      },

      /**
       * Delete selected serviceCategory.
       * @param id
       */
      deleteServiceCategory (id) {
        let serviceCategory = {}

        for (let i = 0; i < this.serviceCategories.length; i++) {
          if (this.serviceCategories[i].id === id) {
            serviceCategory = this.serviceCategories[i]
          }
        }

        this.$swal({
          title: 'Are you sure you want to delete ' + serviceCategory.name + '?',
          text: 'Deleting a service category is permanent',
          type: 'warning',
          showCancelButton: true,
        }).then((result) => {

          if (result.value) {
            window.axios.delete(this.API_ROUTE + 'service-categories/' + id).then(response => {
              this.getServiceCategories()
              flash('Successfully deleted ' + response.data.serviceCategory.name + '.', 'success')
            })
          }
        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      },

      /**
       * Route to edit serviceCategory
       * @param id
       */
      modifyServiceCategory (id) {
        this.$router.push({
          name: 'service-categories.edit',
          params: {
            id: id
          }
        })
      }
    }
  }
</script>
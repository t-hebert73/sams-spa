<template>
    <div class="component-container c-serviceCategory-show">
        <admin-component :flash="$attrs.flash">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">

                            <div v-if="loading" class="loading-spinner c-loading min-body-height medium">
                                <loading-component></loading-component>
                            </div>

                            <div v-if="!loading" class="card-body">
                                <div class="card-title">
                                    <h1 class="float-left">{{ serviceCategory.title }} ServiceCategory</h1>
                                    <router-link :to="{ name: 'serviceCategories.index'}" class="btn btn-primary float-right ml-3">
                                        Back
                                    </router-link>
                                    <router-link :to="{ name: 'serviceCategories.edit', params: {id: serviceCategory.id} }"
                                                 class="btn btn-success float-right">Edit
                                    </router-link>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b-card-group deck>
                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>ServiceCategory ID</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value big">
                                                        {{ serviceCategory.id }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Type</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ serviceCategory.type }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-secondary">
                                                    <h4>Key</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ serviceCategory.key }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Is Enabled</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ serviceCategory.isEnabled }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-secondary">
                                                    <h4>Created</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <div class="card-text data-value">
                                                        <div>{{ moment(serviceCategory.created.date).format('MMM Do YYYY') }}</div>
                                                        <div>By: {{ serviceCategory.createdUser.name }}</div>
                                                    </div>
                                                </b-card-body>
                                            </b-card>

                                        </b-card-group>

                                        <b-card no-body align="center" class="mt-4">
                                            <b-card-header class="brand-primary">
                                                <h4>Title</h4>
                                            </b-card-header>
                                            <b-card-body>
                                                <p class="card-text data-value">
                                                    {{ serviceCategory.title }}
                                                </p>
                                            </b-card-body>
                                        </b-card>

                                        <b-card no-body align="center" class="mt-4">
                                            <b-card-header class="brand-secondary">
                                                <h4>Content</h4>
                                            </b-card-header>
                                            <b-card-body>
                                                <p class="card-text data-value" v-html="serviceCategory.content"></p>
                                            </b-card-body>
                                        </b-card>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </admin-component>
    </div>
</template>

<script>
  export default {
    $_veeValidate: {
      validator: 'new' // give me a new validator each time.
    },

    data () {
      return {
        loading: true,
        userPermissions: {
          viewServiceCategories: this.$ls.get('permissions').viewServiceCategories
        },
        serviceCategory: {}
      }
    },

    mounted () {
      if (!this.userPermissions.viewServiceCategories) {
        this.$router.push({
          name: 'admin.dashboard',
          params: {
            flash: {
              message: 'You do not have permission to view serviceCategories.', type: 'error'
            }
          }
        })
      } else {
        this.getServiceCategory(this.$route.params.id)
      }
    },

    methods: {
      /**
       * Get the specified serviceCategory.
       *
       * @param id
       */
      getServiceCategory (id) {
        window.axios.get(this.API_ROUTE + 'serviceCategories/' + id).then(response => {
          this.serviceCategory = response.data.serviceCategory
          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      }
    }
  }
</script>
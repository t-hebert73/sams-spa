<template>
    <div class="component-container c-page-show">
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
                                    <h1 class="float-left">{{ page.title }} Page</h1>
                                    <router-link :to="{ name: 'pages.index'}" class="btn btn-primary float-right ml-3">
                                        Back
                                    </router-link>
                                    <router-link :to="{ name: 'pages.edit', params: {id: page.id} }"
                                                 class="btn btn-success float-right">Edit
                                    </router-link>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b-card-group deck>
                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Page ID</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value big">
                                                        {{ page.id }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Type</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ page.type }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-secondary">
                                                    <h4>Key</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ page.key }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Is Enabled</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ page.isEnabled }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-secondary">
                                                    <h4>Created</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <div class="card-text data-value">
                                                        <div>{{ moment(page.created.date).format('MMM Do YYYY') }}</div>
                                                        <div>By: {{ page.createdUser.name }}</div>
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
                                                    {{ page.title }}
                                                </p>
                                            </b-card-body>
                                        </b-card>

                                        <b-card no-body align="center" class="mt-4">
                                            <b-card-header class="brand-secondary">
                                                <h4>Content</h4>
                                            </b-card-header>
                                            <b-card-body>
                                                <p class="card-text data-value" v-html="page.content"></p>
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
          viewPages: this.$ls.get('permissions').viewPages
        },
        page: {}
      }
    },

    mounted () {
      if (!this.userPermissions.viewPages) {
        this.$router.push({
          name: 'admin.dashboard',
          params: {
            flash: {
              message: 'You do not have permission to view pages.', type: 'error'
            }
          }
        })
      } else {
        this.getPage(this.$route.params.id)
      }
    },

    methods: {
      /**
       * Get the specified page.
       *
       * @param id
       */
      getPage (id) {
        window.axios.get(this.API_ROUTE + 'pages/' + id).then(response => {
          this.page = response.data.page
          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      }
    }
  }
</script>
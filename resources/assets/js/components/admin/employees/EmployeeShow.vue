<template>
    <div class="component-container c-employee-show">
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
                                    <h1 class="float-left">{{ employee.title }} Employee</h1>
                                    <router-link :to="{ name: 'employees.index'}" class="btn btn-primary float-right ml-3">
                                        Back
                                    </router-link>
                                    <router-link :to="{ name: 'employees.edit', params: {id: employee.id} }"
                                                 class="btn btn-success float-right">Edit
                                    </router-link>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b-card-group deck>
                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Employee ID</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value big">
                                                        {{ employee.id }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Type</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ employee.type }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-secondary">
                                                    <h4>Key</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ employee.key }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Is Enabled</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ employee.isEnabled }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-secondary">
                                                    <h4>Created</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <div class="card-text data-value">
                                                        <div>{{ moment(employee.created.date).format('MMM Do YYYY') }}</div>
                                                        <div>By: {{ employee.createdUser.name }}</div>
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
                                                    {{ employee.title }}
                                                </p>
                                            </b-card-body>
                                        </b-card>

                                        <b-card no-body align="center" class="mt-4">
                                            <b-card-header class="brand-secondary">
                                                <h4>Content</h4>
                                            </b-card-header>
                                            <b-card-body>
                                                <p class="card-text data-value" v-html="employee.content"></p>
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
          viewEmployees: this.$ls.get('permissions').viewEmployees
        },
        employee: {}
      }
    },

    mounted () {
      if (!this.userPermissions.viewEmployees) {
        this.$router.push({
          name: 'admin.dashboard',
          params: {
            flash: {
              message: 'You do not have permission to view employees.', type: 'error'
            }
          }
        })
      } else {
        this.getEmployee(this.$route.params.id)
      }
    },

    methods: {
      /**
       * Get the specified employee.
       *
       * @param id
       */
      getEmployee (id) {
        window.axios.get(this.API_ROUTE + 'employees/' + id).then(response => {
          this.employee = response.data.employee
          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      }
    }
  }
</script>
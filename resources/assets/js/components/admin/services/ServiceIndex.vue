<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>Services</h1>

                                    <div class="card-text">
                                        <p>Choose a service group to add/edit services.</p>
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-bind:class="['employee hover-pointer', 'read-employee-'+employee.id]"
                                            @click="showEmployeeServices($event, employee.id)" v-for="(employee, i) in employees">
                                            <td class="employee-id">{{ employee.id }}</td>
                                            <td class="employee-name">{{ employee.name }}</td>
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
    name: 'service-index',

    data () {
      return {
        employees: {}
      }
    },

    mounted() {
      this.getEmployees()
    },

    methods: {
      /**
       * Get all employees.
       */
      getEmployees (apiRoute) {
        apiRoute = apiRoute || this.API_ROUTE + 'employees'

        window.axios.get(apiRoute).then(response => {
          this.employees = response.data.employees
          this.loading = false
        }).catch(error => {
          flash('Error loading employees. Reason: ' + error.response.data.message, 'error')
        })
      },

      /**
       * Show a specified serviceCategory.
       *
       * @param id
       */
      showEmployeeServices (event, id) {
        this.$router.push({
          name: 'services.employee.show',
          params: {
            id: id
          }
        })
      },

    }
  }
</script>
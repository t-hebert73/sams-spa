<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>Service Group Management</h1>

                                    <div class="card-text">
                                        <p>Below are all the service groups in the system. Add more or modify/remove the existing
                                            ones.</p>

                                        <div class="actions">
                                            <a href="#" @click.prevent="createEmployee()" class="btn btn-primary mr-2">Create
                                            Service Group</a>

                                            <!-- <router-link class="btn btn-secondary" :to="{name: 'menu-editor.index' }">Menu Editor</router-link>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="employees">
                                    <table class="table table-striped table-bordered table-branded mb-0">
                                        <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th width="200px;">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-bind:class="['employee hover-pointer', 'read-employee-'+employee.id]"
                                            @click="showEmployee($event, employee.id)" v-for="(employee, i) in employees">
                                            <td class="employee-num">{{ employee.id }}</td>
                                            <td class="employee-name">{{ employee.name }}</td>
                                            <td>
                                                <a href="#" @click.prevent="modifyEmployee(employee.id)"
                                                   v-bind:class="['btn btn-info', 'edit-employee-'+employee.id]">Edit</a>
                                                <a href="#" @click.prevent="deleteEmployee(employee.id)"
                                                   v-bind:class="['btn btn-danger', 'delete-employee-'+employee.id]">Delete</a>
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
        employees: [],
        employee: {
          id: '',
          name: ''
        },
        loading: false
      }
    },

    mounted () {

      this.getEmployees()

    },

    methods: {

      /**
       * Show a specified employee.
       *
       * @param id
       */
      showEmployee (event, id) {
        // only if you didn't click a link within
/*        if (!$(event.target).is('a')) {
          this.$router.push({
            name: 'employees.show',
            params: {
              id: id
            }
          })
        }*/
      },

      /**
       * Get all employees.
       */
      getEmployees (apiRoute) {
        this.clearEmployees()
        apiRoute = apiRoute || this.API_ROUTE + 'employees'

        window.axios.get(apiRoute).then(response => {
          this.employees = response.data.employees
          this.loading = false
        }).catch(error => {
          flash('Error loading employees. Reason: ' + error.response.data.message, 'error')
        })
      },

      /**
       * Clear all currently shown employees.
       */
      clearEmployees: function () {
        this.employees = []
        this.loading = true
      },

      /**
       * Route to create employee
       */
      createEmployee () {
        this.$router.push({
          name: 'employees.create'
        })
      },

      /**
       * Delete selected employee.
       * @param id
       */
      deleteEmployee (id) {
        let employee = {}

        for (let i = 0; i < this.employees.length; i++) {
          if (this.employees[i].id === id) {
            employee = this.employees[i]
          }
        }

        this.$swal({
          title: 'Are you sure you want to delete ' + employee.title + '?',
          text: 'Deleting a employee is permanent',
          type: 'warning',
          showCancelButton: true,
        }).then((result) => {

          if (result.value) {
            window.axios.delete(this.API_ROUTE + 'employees/' + id).then(response => {
              this.getEmployees()
              flash('Successfully deleted ' + response.data.employee.title + '.', 'success')
            })
          }
        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      },

      /**
       * Route to edit employee
       * @param id
       */
      modifyEmployee (id) {
        this.$router.push({
          name: 'employees.edit',
          params: {
            id: id
          }
        })
      }
    }
  }
</script>
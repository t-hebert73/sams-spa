<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>{{ employee.name }}'s Services</h1>

                                    <div class="card-text">
                                        <p>Edit Services for this employee.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="service-category" v-for="(serviceCategory, i) in serviceCategories">

                                    <div class="service-category-text">
                                        <b-form-checkbox
                                                :attrs="{ id: 'employee_service_category_' + serviceCategory.id , name: 'employee_service_category_' + serviceCategory.id }"
                                                v-model="employeeServiceCategories[i]">
                                            {{ serviceCategory.name }}
                                        </b-form-checkbox>
                                    </div>

                                    <div v-if="employeeServiceCategories[i]" class="service-category-services">
                                        <p>Add some services with prices under this category.</p>
                                    </div>

                                </div>


                                <div class="mt-3">
                                    <b-button @click="saveEmployeeServices" variant="primary">Save</b-button>
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
    name: 'service-employee-show',

    data () {
      return {
        employee: {
          name: ''
        },
        serviceCategories: {},
        employeeServiceCategories: []
      }
    },

    mounted () {
      this.getEmployee(this.$route.params.id)
    },

    methods: {

      /**
       * Grab the employee. Then get the service categories.
       *
       * @param id
       */
      getEmployee(id) {
        window.axios.get(this.API_ROUTE + 'employees/' + id).then(response => {
          this.employee = response.data.employee
          this.getServiceCategories()

          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      },

      /**
       * Grabs the service categories and sets employeeServiceCategories true values in the proper index matching the service categories
       */
      getServiceCategories() {
        window.axios.get(this.API_ROUTE + 'service-categories').then(response => {
          this.serviceCategories = response.data.serviceCategories

          for(let i = 0; i < this.employee.service_categories.length; i++) {
            for(let j = 0; j < this.serviceCategories.length; j++) {

              if(this.employee.service_categories[i].name === this.serviceCategories[j].name) {
                this.employeeServiceCategories[j] = true
              }
            }
          }

          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      },

      /**
       * Saves the employees services
       */
      saveEmployeeServices() {

        window.axios.post(this.API_ROUTE + 'services', {
          employeeId: this.employee.id,
          allServiceCategories: this.serviceCategories,
          employeeServices: this.employeeServiceCategories
        }).then(response => {
          flash(response.data.message, 'success')

          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })

      }
    }
  }
</script>

<style lang="scss">
    .service-category{
        border: 1px solid black;
        padding: 15px;
        margin-bottom: -1px;

        .service-category-text{

            label{
                font-size: 1.2rem;
                margin-top: -4px;
            }

        }
    }
</style>
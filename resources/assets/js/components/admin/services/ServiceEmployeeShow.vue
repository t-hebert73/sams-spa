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
                                        <p>Edit Services for this service group.</p>
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
                                                v-model="employeeServiceCategories[i]"
                                                v-on:change="categoryToggled($event, serviceCategory.name )">
                                            {{ serviceCategory.name }}
                                        </b-form-checkbox>
                                    </div>

                                    <div v-if="employeeServiceCategories[i]" class="service-category-services">
                                        <p>Add some services with prices under this category.</p>

                                        <div v-for="(service, j) in employeeServices">

                                            <div v-if="service.category === serviceCategory.name" class="mb-4">

                                                <b-form-group>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <b-form-input type="text" placeholder="Service Name" v-model="service.name"></b-form-input>
                                                        </div>

                                                        <div class="col-5 price-row">
                                                            <span>$</span> <b-form-input type="text" placeholder="Service Price" v-model="service.price"></b-form-input>
                                                        </div>

                                                        <div class="col-1">
                                                            <div class="remove-employee-service hover-pointer" @click="removeEmployeeService(j, service.id)"><i class="fa fa-times-circle" aria-hidden="true"></i></div>
                                                        </div>
                                                    </div>

                                                </b-form-group>

                                            </div>

                                        </div>

                                        <div class="add-service">
                                            <a class="btn btn-primary" href="#" @click.prevent="addEmployeeService(serviceCategory.name)">Add Another Service</a>
                                        </div>
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
        employeeServiceCategories: [],
        employeeServices: [],
      }
    },

    mounted () {
      this.getEmployee(this.$route.params.id)
    },

    methods: {

      /**
       * @param category
       */
      addEmployeeService(category) {
        this.employeeServices.push({
          name: '',
          price: '',
          category: category,
          id: ''
        })
      },

      /**
       * @param index
       * @param id
       */
      removeEmployeeService(index, id) {

        if(id) {
          this.$swal({
            title: 'Are you sure you want to delete ' + this.employeeServices[index].name + '?',
            text: 'Deleting a service is permanent',
            type: 'warning',
            showCancelButton: true,
          }).then((result) => {

            if (result.value) {
              window.axios.delete(this.API_ROUTE + 'employee-services/' + id).then(response => {
                flash('Successfully deleted ' + response.data.service.name + '.', 'success')
                this.employeeServices.splice(index, 1)
              })
            }
          }).catch(error => {
            flash(error.response.data.message, 'error')
          })
        } else {
          this.employeeServices.splice(index, 1)
        }

      },

      /**
       * If category has been enabled and there isn't already a service in that category then create a blank one
       *
       * @param checked
       * @param category
       */
      categoryToggled(checked, category) {
        if(checked) {

          this.addToEmployeeServices(category)

        }
      },

      addToEmployeeServices(category) {
        let hasNone = true
        for(let i = 0; i < this.employeeServices.length; i++) {
          if(this.employeeServices[i].category === category) {
            hasNone = false
          }
        }

        if(hasNone) {
          this.addEmployeeService(category)
        }
      },

      /**
       * Grab the employee. Then get the service categories.
       *
       * @param id
       */
      getEmployee(id) {
        window.axios.get(this.API_ROUTE + 'employees/' + id).then(response => {
          this.employee = response.data.employee
          this.getEmployeeServices()
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

                this.addToEmployeeServices(this.serviceCategories[j].name)
              }
            }
          }

          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      },

      getEmployeeServices() {
        window.axios.get(this.API_ROUTE + 'employee-services/' + this.employee.id ).then(response => {

          if(response.data.employeeServices) {
            for(let i = 0; i < response.data.employeeServices.length; i++) {
              this.employeeServices.push({
                name: response.data.employeeServices[i].name,
                price: response.data.employeeServices[i].price,
                category: response.data.employeeServices[i].service_category.name,
                id: response.data.employeeServices[i].id
              })
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
          employeeServiceCategories: this.employeeServiceCategories,
          employeeServices: this.employeeServices
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

    @import '../../../../sass/variables';

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

        .form-control{
            width: 90%;
        }

        .price-row{
            .form-control{
                display: inline-block;
            }
        }

        .remove-employee-service{

            .fa{
                color: $brand-danger;
                font-size: 2.5rem;
            }
        }
    }
</style>
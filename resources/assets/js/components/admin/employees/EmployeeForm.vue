<template>
    <div class="row c-employee-form">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <fieldset>
                <legend>Service Group Information</legend>

                <b-form-group>
                    <label for="employee_name">Name: </label>
                    <b-form-input id="employee_name" v-validate="{ required: true }" v-model="employee.name"></b-form-input>

                    <form-error v-if="serverErrors.employee_name" :errors="serverErrors">{{ serverErrors.employee_name[0] }}</form-error>
                    <span class="form-text text-danger" v-show="errors.has('employee_name')">{{ errors.first('employee_name') }}</span>
                </b-form-group>

            </fieldset>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
            <b-button :type="'submit'" :variant="'primary'">Submit</b-button>
        </div>
    </div>
</template>

<script>
  export default {
    inject: {
      $validator: '$validator',
    },

    props: {
      employee: {
        is_enabled: 0,
        createMenuItem: true,
      },
      createEmployee: false,
      serverErrors: {},
    },

    data () {
      return {
        removing: false,
        removingText: '',
        removingSpinner: '',
      }
    },

    mounted () {
      if (this.createEmployee) {
        //this.employee.createMenuItem = true
      }
    },

    methods: {
      showCreateMenuItem () {
        return (this.createEmployee)
      },

      /**
       * Returns a formatted string to be used for HTML element IDs.
       *
       * @param $element
       *
       * @returns {string}
       */
      formatElementId ($element) {
        return $element.toLowerCase().replace(' ', '_')
      },
    },
  }
</script>
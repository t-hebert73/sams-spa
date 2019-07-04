<template>
    <div class="row c-serviceCategory-form">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <fieldset>
                <legend>Service Category Information</legend>

                <b-form-group>
                    <label for="service_category_name">Name: </label>
                    <b-form-input id="service_category_name" v-validate="{ required: true }" v-model="serviceCategory.name"></b-form-input>

                    <form-error v-if="serverErrors.service_category_name" :errors="serverErrors">{{ serverErrors.service_category_name[0] }}</form-error>
                    <span class="form-text text-danger" v-show="errors.has('service_category_name')">{{ errors.first('service_category_name') }}</span>
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
      serviceCategory: {},
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
    },

    methods: {
    },
  }
</script>
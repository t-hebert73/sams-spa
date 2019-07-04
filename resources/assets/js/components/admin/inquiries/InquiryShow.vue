<template>
    <admin-component>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">

                            <div v-if="!loading" class="card-body">
                                <div class="card-title">
                                    <h1 class="float-left">Inquiry</h1>
                                   <!-- <router-link :to="{ name: 'inquiries.index'}" class="btn btn-primary float-right">Back</router-link>-->
                                    <div class="clearfix"></div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b-card-group deck>
                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Inquiry ID</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value big">
                                                        {{ inquiry.id }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Name</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ inquiry.name }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Email</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <p class="card-text data-value">
                                                        {{ inquiry.email }}
                                                    </p>
                                                </b-card-body>
                                            </b-card>

                                            <b-card no-body align="center">
                                                <b-card-header class="brand-primary">
                                                    <h4>Created</h4>
                                                </b-card-header>
                                                <b-card-body>
                                                    <div class="card-text data-value">
                                                        <div>{{ inquiry.created_at }}</div>
                                                    </div>
                                                </b-card-body>
                                            </b-card>

                                        </b-card-group>

                                        <b-card no-body align="center" class="mt-4">
                                            <b-card-header class="brand-primary">
                                                <h4>Message</h4>
                                            </b-card-header>
                                            <b-card-body>
                                                <p class="card-text data-value" v-html="inquiry.message"></p>
                                            </b-card-body>
                                        </b-card>

                                    </div>
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
    name: 'inquiry-show',

    data () {
      return {
        loading: true,
        inquiry: {}
      }
    },

    mounted() {
      this.getInquiry(this.$route.params.id)
    },

    methods: {
      /**
       * Get the specified inquiry.
       *
       * @param id
       */
      getInquiry (id) {
        window.axios.get(this.API_ROUTE + 'inquiries/' + id).then(response => {
          this.inquiry = response.data.inquiry
          this.loading = false

        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      },
    }
  }
</script>

<style scoped>

</style>
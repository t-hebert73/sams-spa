<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1 class="float-left">Create A Page</h1>
                                    <router-link :to="{ name: 'pages.index'}" class="btn btn-primary float-right">Back</router-link>
                                </div>

                            </div>

                            <div class="card-body">
                                <form v-if="!loading" v-on:submit.prevent="createPage()" enctype="multipart/form-data">
                                    <page-form :serverErrors="serverErrors" :page="page" :createPage="createMenuItem"></page-form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </admin-component>
</template>

<script>
  import PageForm from './PageForm'
  export default {
    components: {PageForm},
    $_veeValidate: {
      validator: 'new' // give me a new validator each time.
    },

    data () {
      return {
        loading: false,
        loadingText: '',
        loadingSpinner: '',
        page: {
          type: 'Generic',
          is_enabled: 1,
          photos: {},
          uploadedImages: [],
          createMenuItem: true
        },
        createMenuItem: true,
        serverErrors: {}
      }
    },

    mounted () {

    },

    methods: {
      /**
       * Create new page.
       */
      createPage () {
        this.loadingText = 'Working..'
        this.loadingSpinner = 'loading-socket'
        this.loading = true

        this.$validator.validateAll().then((result) => {

          if (result) {
            window.axios.post(this.API_ROUTE + 'pages', {
              title: this.page.title,
              content: this.page.content,
              type: this.page.type,
              pageKey: this.page.pageKey,
              perma_link: this.page.perma_link,
              meta_title: this.page.meta_title,
              meta_keywords: this.page.meta_keywords,
              meta_desc: this.page.meta_desc,
              is_enabled: this.page.is_enabled,
              createMenuItem: this.page.createMenuItem,
              uploadedImages: this.page.uploadedImages,

            }).then(response => {
              this.$router.push({
                name: 'pages.index',
                params: {
                  flash: {
                    message: 'Successfully created ' + response.data.page.title + '!', type: 'success'
                  }
                }
              })
            }).catch(error => {
              if (error.response.data.errors) {
                this.serverErrors = error.response.data.errors
              }
              flash(error.response.data.message, 'error')
            })

            return
          }
          this.loading = false
        })
      }
    }
  }
</script>
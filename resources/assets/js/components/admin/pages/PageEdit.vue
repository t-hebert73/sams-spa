<template>
    <admin-component :flash="$attrs.flash">
        <div class="container-fluid min-body-height mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="card-title">
                                <h1 class="float-left">Edit Page</h1>
                                <router-link :to="{ name: 'pages.index'}" class="btn btn-primary float-right">Back</router-link>
                            </div>

                            <div v-if="loading" class="loading-spinner c-loading min-body-height medium">
                                <loading-component :text="loadingText" :spinner="loadingSpinner"></loading-component>
                            </div>

                            <form v-if="!loading" v-on:submit.prevent="updatePage(page.id)" id="edit_page" name="edit-page" enctype="multipart/form-data">
                                <page-form :serverErrors="serverErrors" :page="page"></page-form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-component>
</template>
<script>
  export default {
    $_veeValidate: {
      validator: 'new' // give me a new validator each time.
    },

    data () {
      return {
        userPermissions: {
          modifyPages: this.$ls.get('permissions').modifyPages
        },
        loading: true,
        loadingText: '',
        loadingSpinner: '',
        page: {
          photos: {}
        },
        serverErrors: []
      }
    },

    mounted () {
      if (!this.userPermissions.modifyPages) {
        this.$router.push({
          name: 'pages.index',
          params: {
            flash: {
              message: 'You do not have permission to modify pages.', type: 'error'
            }
          }
        })
      } else {
        this.getPage(this.$route.params.id)
      }
    },

    methods: {
      /**
       * Get current page being edited.
       * @param id
       */
      getPage (id) {
        window.axios.get(this.API_ROUTE + 'pages/' + id).then(response => {
          this.page = response.data.page
          this.page.uploadedImages = []
          this.page.deletedImages = []
          this.loading = false
        })
      },

      /**
       * Update the current page.
       * @param id
       */
      updatePage (id) {
        this.loadingSpinner = 'loading-socket'
        this.loadingText = 'Working..'
        this.loading = true

        this.$validator.validateAll().then((result) => {
          if (result) {
            window.axios.patch(this.API_ROUTE + 'pages/' + id, {
              title: this.page.title,
              content: this.page.content,
              type: this.page.type,
              pageKey: this.page.pageKey,
              permaLink: this.page.permaLink,
              metaTitle: this.page.metaTitle,
              metaKeywords: this.page.metaKeywords,
              metaDesc: this.page.metaDesc,
              isEnabled: this.page.isEnabled,
              photos: this.page.photos,
              uploadedImages: this.page.uploadedImages,
              deletedImages: this.page.deletedImages

            }).then(response => {
              this.$router.push({
                name: 'pages.index',
                params: {
                  flash: {
                    message: 'Successfully updated ' + response.data.page.title + '!', type: 'success'
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
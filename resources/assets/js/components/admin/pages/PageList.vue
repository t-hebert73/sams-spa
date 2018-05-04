<template>
    <admin-component :flash="$attrs.flash">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>Page Management</h1>

                                    <div class="card-text">
                                        <p>Below are all the pages in the system. Add more or modify/remove the existing
                                            ones.</p>

                                        <p>After creating pages check out the menu editor to add the page to a menu.</p>

                                        <div class="actions">
                                            <a href="#" @click.prevent="createPage()" class="btn btn-primary mr-2">Create
                                            Page</a>

                                            <!-- <router-link class="btn btn-secondary" :to="{name: 'menu-editor.index' }">Menu Editor</router-link>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="pages">
                                    <table class="table table-striped table-bordered table-branded mb-0">
                                        <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Permalink</th>
                                            <th>Status</th>
                                            <th width="200px;">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-bind:class="['page hover-pointer', 'read-page-'+page.id]"
                                            @click="showPage($event, page.id)" v-for="(page, i) in pages">
                                            <td class="page-num">{{ page.id }}</td>
                                            <td class="page-title">{{ page.title }}</td>
                                            <td class="page-type">{{ page.type }}</td>
                                            <td class="page-permalink">{{ page.perma_link }}</td>
                                            <td class="page-status">{{ page.is_enabled }}</td>
                                            <td>
                                                <a href="#" @click.prevent="modifyPage(page.id)"
                                                   v-bind:class="['btn btn-info', 'edit-page-'+page.id]">Edit</a>
                                                <a href="#" @click.prevent="deletePage(page.id)"
                                                   v-bind:class="['btn btn-danger', 'delete-page-'+page.id]">Delete</a>
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
        pages: [],
        page: {
          id: '',
          title: '',
          type: '',
          is_enabled: false
        },
        loading: false
      }
    },

    mounted () {

      this.getPages()

    },

    methods: {

      /**
       * Show a specified page.
       *
       * @param id
       */
      showPage (event, id) {
        // only if you didn't click a link within
/*        if (!$(event.target).is('a')) {
          this.$router.push({
            name: 'pages.show',
            params: {
              id: id
            }
          })
        }*/
      },

      /**
       * Get all pages.
       */
      getPages (apiRoute) {
        this.clearPages()
        apiRoute = apiRoute || this.API_ROUTE + 'pages'

        window.axios.get(apiRoute).then(response => {
          this.pages = response.data.pages
          this.loading = false
        }).catch(error => {
          flash('Error loading pages. Reason: ' + error.response.data.message, 'error')
        })
      },

      /**
       * Clear all currently shown pages.
       */
      clearPages: function () {
        this.pages = []
        this.loading = true
      },

      /**
       * Route to create page
       */
      createPage () {
        this.$router.push({
          name: 'pages.create'
        })
      },

      /**
       * Delete selected page.
       * @param id
       */
      deletePage (id) {
        let page = {}

        for (let i = 0; i < this.pages.length; i++) {
          if (this.pages[i].id === id) {
            page = this.pages[i]
          }
        }

        this.$swal({
          title: 'Are you sure you want to delete ' + page.title + '?',
          text: 'Deleting a page is permanent',
          type: 'warning',
          showCancelButton: true,
        }).then((result) => {

          if (result.value) {
            window.axios.delete(this.API_ROUTE + 'pages/' + id).then(response => {
              this.getPages()
              flash('Successfully deleted ' + response.data.page.title + '.', 'success')
            })
          }
        }).catch(error => {
          flash(error.response.data.message, 'error')
        })
      },

      /**
       * Route to edit page
       * @param id
       */
      modifyPage (id) {
        this.$router.push({
          name: 'pages.edit',
          params: {
            id: id
          }
        })
      }
    }
  }
</script>
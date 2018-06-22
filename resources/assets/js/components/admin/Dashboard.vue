<template>
    <admin-component>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="container-fluid min-body-height mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>Recent Inquiries</h1>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="pages">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-centered">
                                            <thead>
                                            <tr>
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Message</th>
                                                <th scope="col">Source</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="hover-pointer" v-for="(inquiry, i) in inquiries" @click="showInquiry($event, inquiry.id)"  :id="i + '_inquiry'">
                                                <b-popover :target="i + '_inquiry'"
                                                           :placement="'top-left'"
                                                           title="More Information"
                                                           triggers="hover"
                                                           :content="`Click to view more information about the inquiry.`">
                                                </b-popover>
                                                <td> {{ inquiry.id }}</td>
                                                <td> {{ inquiry.name }}</td>
                                                <td> {{ inquiry.email }}</td>
                                                <td> {{ truncateString(inquiry.message) }}</td>
                                                <td> {{ inquiry.source }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
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
  import AdminHeader from './layouts/AdminHeader'

  export default {
    name: 'dashboard',
    components: {AdminHeader},

    data () {
      return {
        inquiries: {}
      }
    },

    mounted() {
      window.axios.get(this.API_ROUTE + 'inquiries').then(response => {
        this.inquiries = response.data.inquiries
        this.loading = false
      }).catch(error => {
        flash('Error loading pages. Reason: ' + error.response.data.message, 'error')
      })
    },

    methods: {

      /**
       *
       * @param string
       * @returns {string}
       */
      truncateString(string) {
        var length = 100;

        let formattedString = string

        if(string.length > length) {
          formattedString = string.substring(0,length) + '...'
        }

        return formattedString
      },

      /**
       * Show a specified inquiry.
       *
       * @param id
       */
      showInquiry (event, id) {
        // only if you didn't click a link within
        if (!$(event.target).is('a')) {
          this.$router.push({
            name: 'inquiries.show',
            params: {
              id: id
            }
          })
        }
      },
    }
  }
</script>

<style scoped>

</style>
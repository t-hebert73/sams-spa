<template>
    <header>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Alesco
            Salon</a>

            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" @click.prevent="logout()">Sign
                    out</a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
  export default {
    name: 'admin-header',

    methods: {
      /**
       * Log out the user.
       */
      logout () {
        window.axios.post('/logout').then(response => {
          this.$ls.remove('user')
          this.$ls.remove('accessToken')
          this.$router.push({
            name: 'website.home',
            params: {
              flash: {
                message: 'Successfully logged out.', type: 'info'
              }
            }
          })
          // emit loggedIn (set to false) event so the nav knows to change
          this.$bus.$emit('loggedIn', false)
        }).catch(error => {

        })
      }
    }
  }
</script>

<style scoped>

</style>
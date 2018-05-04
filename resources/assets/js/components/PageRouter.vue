<template>
    <div>
        <component :is="pageTemplateComponent"></component>
    </div>
</template>

<script>
  export default {
    name: 'page-router',
    data () {
      return {
        pageTemplateComponent: 'home-page'
      }
    },

    mounted () {

      this.getPage(this.$router.currentRoute.fullPath)
    },

    watch: {
      '$route': function (route) {
        console.log('route change in page router')
      }
    },

    /**
     * Watch for route changes */
    beforeRouteUpdate (to, from, next) {

      // route changes
      next()
      // check lang of new route & set locale
      let newRoute = to.fullPath
      this.getPage(newRoute)
    },

    methods: {
      getPage (route) {

        if (route == '/') {
          this.pageTemplateComponent = 'home-page'
        } else if (route == '/about') {
          this.pageTemplateComponent = 'about-page'
        } else if (route == '/contact') {
          this.pageTemplateComponent = 'contact-page'
        } else if (route == '/services') {
          this.pageTemplateComponent = 'service-page'
        } else if (route == '/gallery') {
          this.pageTemplateComponent = 'gallery-page'
        }
      }
    }
  }
</script>
<template>
    <div>
        <main-header></main-header>
        <component :is="pageTemplateComponent"></component>
        <main-footer></main-footer>
    </div>
</template>

<script>
    export default {
        name: "page-router",

        data() {
            return {
                pageTemplateComponent: 'home-page'
            }
        },

        mounted() {
            this.getPage(this.$router.currentRoute.fullPath)
        },

        /**
         * Watch for route changes */
        beforeRouteUpdate(to, from, next) {
            // route changes
            next()
            // check lang of new route & set locale
            let newRoute = to.fullPath
            this.getPage(newRoute)
        },

        methods: {
            getPage(route) {
                if (route == '/') {
                    this.pageTemplateComponent = 'home-page'
                } else if (route == '/about') {
                    this.pageTemplateComponent = 'about-page'
                } else if (route == '/contact') {
                    this.pageTemplateComponent = 'contact-page'
                }
            }
        }
    }
</script>
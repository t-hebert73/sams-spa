<template>
    <div>
        <component :is="pageTemplateComponent" :pageData="pageData"></component>
    </div>
</template>

<script>
    export default {
        name: 'page-router',
        data() {
            return {
                pageTemplateComponent: 'home-page',
                pagePermaLink: this.$router.currentRoute.fullPath,
                pageComponent: '',
                pageData: {
                    page: {},
                    objects: {}
                },
            }
        },

        mounted() {

            this.getPage(this.$router.currentRoute.fullPath)
        },

        watch: {
            '$route': function (route) {
                console.log('route change in page router')
            }
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
            getPage(apiRoute) {

                let self = this
                self.pageComponent = ''

                apiRoute = (apiRoute) ? self.API_ROUTE + 'routing?pageUrl=' + apiRoute : self.API_ROUTE + 'routing?pageUrl=' + self.pagePermaLink

                // Remove Additional params
                let qmCount = (apiRoute.match(/\?/g) || []).length;
                if(qmCount > 1){
                    apiRoute = apiRoute.substring(0, apiRoute.lastIndexOf('?'))
                }

                window.axios.get(apiRoute).then(response => {
                    this.pageData.objects = response.data.pageData.objects
                    this.pageData.parentPage = response.data.pageData.parentPage
                    self.assignPageComponent(response.data.pageData.page)

                }).catch(error => {
                    flash('Error loading page. Reason: ' + error.response.data.message, 'error')
                })


/*                if (route == '/') {
                    this.pageTemplateComponent = 'home-page'
                } else if (route == '/about') {
                    this.pageTemplateComponent = 'about-page'
                } else if (route == '/contact') {
                    this.pageTemplateComponent = 'contact-page'
                } else if (route == '/services') {
                    this.pageTemplateComponent = 'service-page'
                } else if (route == '/gallery') {
                    this.pageTemplateComponent = 'gallery-page'
                }*/
            },

            /**
             * Determine a passed pages relevant page component
             *
             * @param page
             */
            assignPageComponent(page) {
                if (page) {
                    this.pageData.page = page
                    switch (page.type) {
                        case 'Home':
                            this.pageTemplateComponent = 'home-page'
                            break
                        case 'About':
                            this.pageTemplateComponent = 'about-page'
                            break
                        case 'Services':
                            this.pageTemplateComponent = 'service-page'
                            break
                        case 'Contact':
                            this.pageTemplateComponent = 'contact-page'
                            break
                        case 'Sitemap':
                            this.pageTemplateComponent = 'sitemap-page'
                            break
                        default:
                            this.pageTemplateComponent = 'generic-page'
                    }
                } else {
                    this.pageTemplateComponent = 'page-not-found'
                }

                this.loading = false
            },
        }
    }
</script>
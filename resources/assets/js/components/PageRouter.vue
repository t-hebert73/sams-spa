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
                pageMetaTitle: null
            }
        },

        mounted() {

            this.getPage(this.$router.currentRoute.fullPath)
        },

        watch: {
            '$route': function (route) {
                //console.log('route change in page router')
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
            getPage(url) {

                let self = this
                self.pageComponent = ''

                let apiRoute = (url) ? self.API_ROUTE + 'routing?pageUrl=' + url : self.API_ROUTE + 'routing?pageUrl=' + self.pagePermaLink

                // Remove Additional params
                let qmCount = (apiRoute.match(/\?/g) || []).length;
                if(qmCount > 1){
                    apiRoute = apiRoute.substring(0, apiRoute.lastIndexOf('?'))
                }

                let title = 'Alesco Salon & Aesthetics'
                window.axios.get(apiRoute).then(response => {
                    this.pageData.objects = response.data.pageData.objects
                    this.pageData.parentPage = response.data.pageData.parentPage
                    self.assignPageComponent(response.data.pageData.page)
                    self.trackPageView(url)

                }).catch(error => {
                    flash('Error loading page. Reason: ' + error.response.data.message, 'error')
                    self.trackPageView(url)
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

            trackPageView(pageUrl) {

                let gaPage = {
                    page: pageUrl,
                    title: this.pageMetaTitle,
                    location: window.location.href
                }
                this.$ga.page(gaPage)
            },

            /**
             * Determine a passed pages relevant page component
             *
             * @param page
             */
            assignPageComponent(page) {
                if (page) {
                    this.pageData.page = page
                    this.pageMetaTitle = 'Alesco Salon & Aesthetics'
                    switch (page.type) {
                        case 'Home':
                            this.pageTemplateComponent = 'home-page'
                            this.pageMetaTitle = 'Alesco Salon & Aesthetics'
                            break
                        case 'About':
                            this.pageTemplateComponent = 'about-page'
                            this.pageMetaTitle = 'About | Alesco Salon & Aesthetics'
                            break
                        case 'Services':
                            this.pageTemplateComponent = 'service-page'
                            this.pageMetaTitle = 'Services | Alesco Salon & Aesthetics'
                            break
                        case 'Contact':
                            this.pageTemplateComponent = 'contact-page'
                            this.pageMetaTitle = 'Contact | Alesco Salon & Aesthetics'
                            break
                        case 'Sitemap':
                            this.pageTemplateComponent = 'sitemap-page'
                            this.pageMetaTitle = 'Sitemap | Alesco Salon & Aesthetics'
                            break
                        case 'Gallery':
                            this.pageTemplateComponent = 'gallery-page'
                            this.pageMetaTitle = 'Gallery | Alesco Salon & Aesthetics'
                            break
                        default:
                            this.pageMetaTitle = this.pageData.page.title + ' | Alesco Salon & Aesthetics'
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
<template>
    <div>

        <div class="container-fluid main-area medium">

            <div class="page-content left-bar mt-3" v-html="pageData.page.content"></div>

            <div class="employees mt-5" v-if="employees.length && !loadingEmployees">

                <div class="employee" v-for="(employee, i) in employees">

                    <h2>{{ employee.person.name }}'s Services</h2>

                    <div class="categories" v-if="employee.categories.length">

                        <div v-masonry transition-duration="0.3s" item-selector=".item">

                            <div v-masonry-tile class="item category"
                                 v-for="(category, i) in employee.categories">

                                <div class="category-name" v-if="category.services"> {{ category.name }}</div>

                                <div class="services" v-if="category.services">

                                    <div class="service" v-for="(service, i) in category.services">

                                            <span class="service-name">
                                                {{ service.name }}
                                            </span>

                                        <span class="service-cost" v-if="service.cost">
                                                ${{ service.cost }}
                                            </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'service-page',

    props: {
      pageData: {}
    },

    data () {
      return {
        loadingEmployees: true,
        employees: {}
      }
    },

    mounted () {
      window.axios.get(this.API_ROUTE + 'available-services').then(response => {
        this.employees = response.data.employees
        this.loadingEmployees = false
      }).catch(error => {
        flash('Error loading pages. Reason: ' + error.response.data.message, 'error')
      })
    }
  }
</script>

<style lang="scss" scoped>

    @import "../../../sass/responsive.scss";

    .main-area {
        width: 75%;
        margin: 0 auto 200px;

        @media #{$small} {
            width: 100%;
        }

        @media #{$mobile} {
            width: 100%;
        }

        .employee {
            width: 50%;
            display: inline-block;
            vertical-align: top;
            padding: 0 15px;

            @media #{$mobile} {
                width: 100%;
            }

            h2 {
                font-size: 2.5rem;
            }

            .categories {
                width: 100%;

                .category {
                    padding-right: 15px;
                    width: 50%;

                    .category-name {
                        font-size: 1rem;
                    }
                }

                .service {
                    display: flex;
                    margin-bottom: 5px;

                    span {
                        font-size: .7rem;
                        flex-grow: 1;
                        line-height: 1.3rem;

                        &.service-cost {
                            text-align: right;
                            border-bottom: 1px dotted gray;
                        }
                    }

                }
            }
        }

    }
</style>
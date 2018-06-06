<template>
    <div>

        <div class="container-fluid main-area medium">
            <div class="row-fluid">
                <div class="col-12">

                    <div class="page-content left-bar mt-3" v-html="pageData.page.content"></div>

                    <div class="employees mt-5" v-if="employees.length">

                        <div class="employee" v-for="(employee, i) in employees">

                            <h2>{{ employee.person.name }}'s Services</h2>

                            <div class="categories" v-if="employee.categories.length">

                                <div v-masonry transition-duration="0.3s" item-selector=".item">

                                    <div v-masonry-tile class="item category" v-for="(category, i) in employee.categories">

                                        <div class="category-name"> {{ category.category }}</div>

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
        </div>
    </div>
</template>

<script>
    export default {
        name: "service-page",

        props: {
            pageData: {}
        },

        data() {
            return {
                employees: [
                    {
                        person: {
                            name: 'Jeannie'
                        },

                        categories: [
                            {
                                category: 'Designer Cut and Style',
                                services: [
                                    {
                                        name: 'Female Design',
                                        cost: '50+'
                                    },
                                    {
                                        name: 'Child Design (10 and under)',
                                        cost: '34+'
                                    }
                                ]
                            },
                            {
                                category: 'Designer Chemical',
                                services: [
                                    {
                                        name: 'Colour',
                                        cost: '70+'
                                    },
                                    {
                                        name: '',
                                        cost: '80+'
                                    },
                                    {
                                        name: '',
                                        cost: '90+'
                                    },
                                    {
                                        name: 'Refresher',
                                        cost: '17+'
                                    }
                                ]
                            }
                        ]

                    },

                    {
                        person: {
                            name: 'Kerri Lynn'
                        },

                        categories: [
                            {
                                category: 'Designer Cut and Style',
                                services: [
                                    {
                                        name: 'Female Design',
                                        cost: '50+'
                                    },
                                    {
                                        name: 'Child Design (10 and under)',
                                        cost: '34+'
                                    }
                                ]
                            },
                            {
                                category: 'Designer Chemical',
                                services: [
                                    {
                                        name: 'Colour',
                                        cost: '70+'
                                    },
                                    {
                                        name: '',
                                        cost: '80+'
                                    },
                                    {
                                        name: '',
                                        cost: '90+'
                                    },
                                    {
                                        name: 'Refresher',
                                        cost: '17+'
                                    }
                                ]
                            }
                        ]

                    },

                    {
                        person: {
                            name: 'Veronica'
                        },

                        categories: [
                            {
                                category: 'Designer Cut and Style',
                                services: [
                                    {
                                        name: 'Female Design',
                                        cost: '50+'
                                    },
                                    {
                                        name: 'Child Design (10 and under)',
                                        cost: '34+'
                                    }
                                ]
                            },
                            {
                                category: 'Designer Chemical',
                                services: [
                                    {
                                        name: 'Colour',
                                        cost: '70+'
                                    },
                                    {
                                        name: '',
                                        cost: '80+'
                                    },
                                    {
                                        name: '',
                                        cost: '90+'
                                    },
                                    {
                                        name: 'Refresher',
                                        cost: '17+'
                                    }
                                ]
                            }
                        ]

                    },

                    {
                        person: {
                            name: 'Sam'
                        },

                        categories: [
                            {
                                category: 'Skin Care',
                                services: [
                                    {
                                        name: '30 Minutes',
                                        cost: '35'
                                    },
                                    {
                                        name: '60 Minutes',
                                        cost: '65'
                                    },
                                    {
                                        name: '90 Minutes',
                                        cost: '95'
                                    },
                                    {
                                        name: 'Add a plant peel to any facial for',
                                        cost: '15'
                                    }
                                ]
                            },
                            {
                                category: 'Nail Services',
                                services: [
                                    {
                                        name: 'Shape and Polish',
                                        cost: '15'
                                    },
                                    {
                                        name: 'Manicure',
                                        cost: '22'
                                    },
                                    {
                                        name: 'Spa Manicure',
                                        cost: '32'
                                    },
                                    {
                                        name: 'Pedicure',
                                        cost: '40'
                                    },
                                    {
                                        name: 'Spa Pedicure',
                                        cost: ''
                                    },
                                    {
                                        name: 'Gel Manicure',
                                        cost: '40'
                                    },
                                    {
                                        name: 'Gel Pedicure',
                                        cost: '60'
                                    },
                                    {
                                        name: 'Gel Application',
                                        cost: '20'
                                    }
                                ]
                            },
                            {
                                category: 'Hair Removal',
                                services: [
                                    {
                                        name: 'Eyebrow Design',
                                        cost: '15'
                                    },
                                    {
                                        name: 'Eyebrow Cleanup',
                                        cost: '12'
                                    },
                                    {
                                        name: 'Lip',
                                        cost: '10'
                                    },
                                    {
                                        name: 'Chin',
                                        cost: '10'
                                    }
                                ]
                            }
                        ]

                    }
                ]
            }
        }
    }
</script>

<style lang="scss" scoped>

    .main-area {
        margin-bottom: 200px;

        .employee {
            width: 25%;
            display: inline-block;
            vertical-align: top;
            padding-right: 10px;

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
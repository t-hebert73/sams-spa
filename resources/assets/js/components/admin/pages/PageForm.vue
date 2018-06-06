<template>
    <div class="row c-page-form">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <b-card no-body>
                <b-tabs pills card vertical>
                    <b-tab title="Content" active>
                        <fieldset>
                            <legend>Page Information</legend>

                            <b-form-group>
                                <label for="page_title">Title: </label>
                                <b-form-input id="page_title" v-validate="{ required: true }" v-model="page.title"></b-form-input>

                                <form-error v-if="serverErrors.page_title" :errors="serverErrors">{{ serverErrors.page_title[0] }}</form-error>
                                <span class="form-text text-danger" v-show="errors.has('page_title')">{{ errors.first('page_title') }}</span>
                            </b-form-group>

                            <b-form-group>
                                <label for="page_content">Content: </label>
                                <vue-editor id="page_content" v-model="page.content"></vue-editor>

                                <form-error v-if="serverErrors.page_content" :errors="serverErrors">{{ serverErrors.page_content[0] }}</form-error>
                                <span class="form-text text-danger" v-show="errors.has('page_content')">{{ errors.first('page_content') }}</span>
                            </b-form-group>

                            <b-form-group>
                                <label for="page_type">Type: </label>

                                <b-form-select v-model="page.type" id="page_type">
                                    <option value="Generic">Generic</option>
                                    <option value="Contact">Contact</option>
                                    <option value="Home">Home</option>
                                    <option value="Services">Services</option>
                                </b-form-select>

                                <form-error v-if="serverErrors.page_type" :errors="serverErrors">{{ serverErrors.page_type[0] }}</form-error>
                                <span class="form-text text-danger" v-show="errors.has('page_type')">{{ errors.first('page_type') }}</span>
                            </b-form-group>

                            <b-form-group>
                                <label for="page_key">Key: </label>
                                <b-form-input id="page_key" v-model="page.page_key"></b-form-input>

                                <b-popover :target="'page_key'"
                                           :placement="'left'"
                                           title="Field Information"
                                           triggers="focus"
                                           :content="`This field is used for developers to allow linking to this page dynamically. Leave alone/blank if you don't know how this works.`">
                                </b-popover>

                                <form-error v-if="serverErrors.page_key" :errors="serverErrors">{{ serverErrors.page_key[0] }}</form-error>
                                <span class="form-text text-danger" v-show="errors.has('page_key')">{{ errors.first('page_key') }}</span>
                            </b-form-group>

                            <b-form-group>
                                <label for="page_perma_link">Permalink: </label>
                                <b-form-input id="page_perma_link" v-model="page.perma_link"></b-form-input>

                                <form-error v-if="serverErrors.page_perma_link" :errors="serverErrors">{{ serverErrors.page_perma_link[0] }}</form-error>
                                <span class="form-text text-danger" v-show="errors.has('page_perma_link')">{{ errors.first('page_perma_link') }}</span>
                            </b-form-group>

                            <b-form-group>
                                <label for="page_is_enabled">Status: </label>

                                <b-form-select v-model="page.is_enabled" id="page_is_enabled">
                                    <option v-bind:value="1">True</option>
                                    <option v-bind:value="0">False</option>
                                </b-form-select>
                            </b-form-group>

                            <b-form-group v-if="showCreateMenuItem()">
                                <label for="page_create_menu_item">Create Menu Item? </label>

                                <b-form-select v-model="page.createMenuItem" id="page_create_menu_item">
                                    <option value="1" v-bind:value="true">True</option>
                                    <option value="0" v-bind:value="false">False</option>
                                </b-form-select>
                            </b-form-group>

                        </fieldset>
                    </b-tab>

                    <b-tab title="SEO" :button-id="'page_seo_tab'">

                        <b-popover placement="left" target="page_seo_tab" triggers="hover" title="Search Engine Optimization">
                            Edit these values to better optimize your page for seo purposes.
                        </b-popover>

                        <b-form-group>
                            <label for="page_meta_title">Meta Title:</label>

                            <b-input id="page_meta_title" v-model="page.meta_title"></b-input>
                        </b-form-group>

                        <b-form-group>
                            <label for="page_meta_keywords">Meta Keywords:</label>

                            <b-input id="page_meta_keywords" v-model="page.meta_keywords"></b-input>
                        </b-form-group>

                        <b-form-group>
                            <label for="page_meta_desc">Meta Description:</label>

                            <b-input id="page_meta_desc" v-model="page.meta_desc"></b-input>
                        </b-form-group>

                    </b-tab>

                    <b-tab title="Featured Images">
<!--                        <photo-uploader :identifier="'page_' + page.id"
                                        :items.sync="page.photos"
                                        :uploadedItems.sync="page.uploadedImages"
                                        :deletedItems.sync="page.deletedImages">
                        </photo-uploader>-->
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
            <b-button :type="'submit'" :variant="'primary'">Submit</b-button>
        </div>
    </div>
</template>

<script>
  export default {
    inject: {
      $validator: '$validator',
    },

    props: {
      page: {
        is_enabled: 0,
        createMenuItem: true,
      },
      createPage: false,
      serverErrors: {},
    },

    data () {
      return {
        removing: false,
        removingText: '',
        removingSpinner: '',
      }
    },

    mounted () {
      if (this.createPage) {
        //this.page.createMenuItem = true
      }
    },

    methods: {
      showCreateMenuItem () {
        return (this.createPage)
      },

      /**
       * Returns a formatted string to be used for HTML element IDs.
       *
       * @param $element
       *
       * @returns {string}
       */
      formatElementId ($element) {
        return $element.toLowerCase().replace(' ', '_')
      },
    },
  }
</script>
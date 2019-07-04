<template>
    <div class="container">
        <div class="row justify-content-center main-area">
            <div class="col-md-12">
                <div class="mt-5">
                    <h1 class="page-title">{{ pageData.page.title }}</h1>

                    <div class="page-content left-bar mt-3 mb-5" v-html="pageData.page.content"></div>

                    <div class="page-content left-bar mt-3">
                        <div class="address-info">
                            <div>Alesco Salon & Aesthetics</div>
                            <div>133 Front Street N</div>
                            <div>L2V 0A3</div>
                        </div>

                        <div class="social-media">
                            <a href="https://www.facebook.com/alescosalonandaesthetics/" target="_blank">
                                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                            </a>

                            <a href="https://www.instagram.com/explore/locations/890235954441523/alesco-salon-aesthetics/?hl=en" target="_blank">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </div>

                        <span>&nbsp;</span>
                        <div>905-227-6060</div>
                        <div>

<!--                            <b-modal id="contact_modal" title="Contact Alesco Salon" centered :hide-footer="true">

                                <div v-if="alert.message" class="alert alert-success" role="alert">
                                    {{ alert.message }}
                                </div>

                                <div class="alert alert-danger" v-if="serverErrors.message">
                                    <li v-for="(error, i) in serverErrors">
                                        {{ error[0] }}
                                    </li>
                                </div>

                                <b-form @submit.prevent="submitForm" v-if="!loading">
                                    <b-form-group id="user_name_group"
                                                  label="Name:"
                                                  label-for="user_name">
                                        <b-form-input id="user_name"
                                                      type="text"
                                                      v-model="user.name"
                                                      required
                                                      placeholder="">
                                        </b-form-input>
                                    </b-form-group>

                                    <b-form-group id="user_email_group"
                                                  label="Email:"
                                                  label-for="user_email">
                                        <b-form-input id="user_email"
                                                      type="email"
                                                      v-model="user.email"
                                                      required
                                                      placeholder="">
                                        </b-form-input>
                                    </b-form-group>

                                    <b-form-group id="user_message_group"
                                                  label="Message:"
                                                  label-for="user_message">
                                        <b-form-textarea id="user_message"
                                                         v-model="user.message"
                                                         rows="5">
                                        </b-form-textarea>
                                    </b-form-group>

                                    <b-button type="submit" variant="primary">Send</b-button>
                                </b-form>

                            </b-modal>

                            <b-btn variant="primary" v-b-modal.contact_modal>alescosalon@bellnet.ca</b-btn>-->


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'contact-page',

    props: {
      pageData: {}
    },

    data () {
      return {
        loading: false,
        user: {
          name: '',
          email: '',
          message: '',
          source: ''
        },
        alert: {
          message: '',
        },
        serverErrors: {},
      }
    },

    methods: {
      submitForm() {

        let self = this

        this.loading = true

        this.user.source = this.guessDeviceSource()


        window.axios.post(this.API_ROUTE + 'form-submissions/contact', this.user).then(response => {

          this.serverErrors.message = null
          this.alert.message = response.data.message

          self.user.name = ''
          self.user.email = ''
          self.user.message = ''

          setTimeout(function () {
            self.alert.message = ''
          }, 2000)

          this.loading = false

        }).catch(error => {
          if (error.response.data.errors) {
            this.serverErrors = error.response.data.errors
          }
          flash(error.response.data.message, 'error')
          this.loading = false
        })

        return

      },

      /**
       * Attempts to determine the device size based on screen width
       *
       * @returns {string}
       */
      guessDeviceSource () {
        // determine device source
        let width = $(window).width()

        let deviceSource = ''

        switch (true) {
          case (width < 768):
            deviceSource = 'mobile'
            break
          case (width < 980):
            deviceSource = 'tablet'
            break
          default:
            deviceSource = 'desktop'
            break
        }

        return deviceSource
      }
    }
  }
</script>

<style lang="scss" scoped>

    @import "../../../sass/responsive.scss";

    .main-area {

        @media #{$ltDesktop} {
            margin-bottom: 200px;
        }

        .social-media {
            .fa {
                font-size: 2rem;
                padding-right: 5px;
                color: black;

                &:hover {
                    opacity: 0.8;
                }
            }
        }
    }
</style>

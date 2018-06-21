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
                        <div>alescosalon@bellnet.ca</div>
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
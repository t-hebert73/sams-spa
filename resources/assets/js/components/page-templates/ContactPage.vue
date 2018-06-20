<template>
    <div class="container">
        <div class="row justify-content-center main-area">
            <div class="col-md-12">
                <div class="mt-5">
                    <h1 class="page-title">{{ pageData.page.title }}</h1>

                    <div class="page-content left-bar mt-3 mb-5" v-html="pageData.page.content"></div>

                    <div class="page-content left-bar mt-3">
                        <div>Alesco Salon & Aesthetics</div>
                        <div>133 Front Street N</div>
                        <div>L2V 0A3</div>
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

    }
</style>
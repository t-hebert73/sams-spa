<template>
    <div class="container">
        <div class="row justify-content-center main-area">

            <div class="page-content mt-3" v-html="pageData.page.content"></div>

            <div class="col-8 mt-5 mb-5">
                <img class="alesco-logo" src="/images/alesco-logo.png">
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'home-page',
    props: {
      pageData: {}
    },

    mounted () {

    }
  }
</script>

<style lang="scss" scoped>

</style>
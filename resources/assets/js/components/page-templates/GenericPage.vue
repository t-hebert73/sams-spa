<template>
    <div class="container">
        <div class="row justify-content-center main-area">
            <div class="col-md-12">
                <div class="mt-5">
                    <h1 class="page-title">{{ pageData.page.title }}</h1>

                    <div class="page-content left-bar mt-3" v-html="pageData.page.content"></div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "generic-page",

        props: {
            pageData: {}
        }
    }
</script>

<style lang="scss" scoped>

    .main-area{
        margin-bottom: 200px;
    }
</style>
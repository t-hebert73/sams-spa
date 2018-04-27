<template>
    <footer>
        <div class="container">
            <div class="row justify-content-center">
                &copy;2018 Alesco Salon. All Rights Reserved
            </div>
        </div>

        <div class="bottom-swirl"></div>

        <!-- temporary todo: remove -->
        <b-modal id="sign_in" centered hide-footer>
            <div slot="modal-title">Sign In</div>
            <auth-combo></auth-combo>
        </b-modal>

        <a class="tmp-login hover-pointer" v-b-modal.sign_in title="Secret log in portal"><span>Sign in</span></a>
    </footer>
</template>

<script>
    import AuthCombo from '../widgets/auth/AuthCombo'
    export default {
        name: "main-footer",
      components: {AuthCombo}
    }
</script>

<style lang="scss" scoped>

    footer{
        margin-bottom: 25px;
    }

    .tmp-login {
        background-color: transparent;
        position: fixed;
        bottom: 0;
        left: 0;
        min-height: 35px;

    &:hover {
         background-color: red;

    span {
        color: white;
    }
    }

    span {
        padding: 5px 30px;
        color: transparent;
        display: block;
    }
    }
</style>
<template>
    <div class="container">
        <div class="row justify-content-center main-area">
            <div class="col-md-12">
                <div class="mt-5">
                    <h1 class="page-title">Login</h1>

                    <sign-in :showSignup="false"></sign-in>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
  import SignIn from '../widgets/auth/SignIn'
  export default {
    name: 'login-page',
    components: {SignIn}
  }
</script>

<style scoped>

</style>
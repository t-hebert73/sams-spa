<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.dashboard'}" class="nav-link"
                                 v-b-tooltip.html.left title="View Stats">
                        <i class="fa fa-pie-chart"></i>
                        <span class="hidden-xs-down link-text">Dashboard</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'pages.index'}" class="nav-link" v-b-tooltip.html.right title="View & Manage Pages">
                        <i class="fa fa-file-text"></i>
                        <span class="hidden-xs-down link-text">Pages</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span data-feather="shopping-cart"></span>
                        Prices
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</template>

<script>
  export default {
    name: 'admin-sidebar'
  }
</script>

<style scoped>

</style>
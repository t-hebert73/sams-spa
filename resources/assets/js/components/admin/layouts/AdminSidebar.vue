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
                    <router-link :to="{ name: 'employees.index'}" class="nav-link" v-b-tooltip.html.right title="View & Manage Service Groups">
                        <i class="fa fa-list-ul"></i>
                        <span class="hidden-xs-down link-text">Service Groups</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{ name: 'service-categories.index'}" class="nav-link" v-b-tooltip.html.right title="View & Manage Service Categories">
                        <i class="fa fa-list"></i>
                        <span class="hidden-xs-down link-text">Service Categories</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{ name: 'services.index'}" class="nav-link" v-b-tooltip.html.right title="View & Manage Services">
                        <i class="fa fa-usd"></i>
                        <span class="hidden-xs-down link-text">Services</span>
                    </router-link>
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
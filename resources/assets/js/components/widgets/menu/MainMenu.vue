<template>
    <div class="main-menu-container">
        <b-navbar toggleable="md">

            <b-navbar-toggle target="nav_collapse">Menu </b-navbar-toggle>

            <b-collapse is-nav id="nav_collapse">
                <b-navbar-nav>
                    <b-nav>
                        <li class="nav-item">
                            <router-link :to="{ path: '/'}" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ path: '/about'}" class="nav-link">About</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ path: '/services'}" class="nav-link">Services</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ path: '/gallery'}" class="nav-link">Gallery</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ path: '/contact'}" class="nav-link">Contact</router-link>
                        </li>
                    </b-nav>
                </b-navbar-nav>
            </b-collapse>


        </b-navbar>

    </div>
</template>

<script>
    export default {
        name: "main-menu"
    }
</script>
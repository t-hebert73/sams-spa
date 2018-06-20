<template>
    <div class="main-menu-container">
        <b-navbar toggleable="md">

            <b-navbar-toggle target="nav_collapse">Menu </b-navbar-toggle>

            <b-collapse is-nav id="nav_collapse">
                <b-navbar-nav>
                    <b-nav>
                        <b-nav-item :to="{ path: '/'}">Home</b-nav-item>
                        <b-nav-item :to="{ path: '/about'}">About</b-nav-item>
                        <b-nav-item :to="{ path: '/services'}">Services</b-nav-item>
                        <b-nav-item :to="{ path: '/gallery'}">Gallery</b-nav-item>
                        <b-nav-item :to="{ path: '/contact'}">Contact</b-nav-item>
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
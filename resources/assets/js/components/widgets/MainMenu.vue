<template>
    <div class="mt-3">
        <b-nav>
            <b-nav-item :to="{ path: '/'}">Home</b-nav-item>
            <b-nav-item :to="{ path: '/about'}">About</b-nav-item>
            <b-nav-item :to="{ path: '/services'}">Services</b-nav-item>
            <b-nav-item :to="{ path: '/gallery'}">Gallery</b-nav-item>
            <b-nav-item :to="{ path: '/contact'}">Contact</b-nav-item>
        </b-nav>
    </div>
</template>

<script>
    export default {
        name: "main-menu"
    }
</script>
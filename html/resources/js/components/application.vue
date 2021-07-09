<template>
    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand">SiteForYou</span>
            <router-link
                to="/logout"
                class="btn btn-outline-success my-2 my-sm-0">Logout</router-link>
        </nav>
        <div class="card">
            <div class="card-body">
                <h1>Welcome!</h1>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            if (!User.loggedIn()) {
                this.$router.push('/login');
            }
        },
    }
</script>

<style>
    .navbar {
        display: flex;
        justify-content: space-between;
    }
    .card {
        margin-top: 10%;
    }
</style>

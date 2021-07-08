<template>
    <h1>Welcome!</h1>
</template>

<script>
    export default {
        created() {
            if (!User.loggedIn()) {
                this.$router.push('/login');
            }
            console.log(User.loggedIn());
        },
    }
</script>

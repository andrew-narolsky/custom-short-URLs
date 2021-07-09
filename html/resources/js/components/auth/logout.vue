<template>

</template>

<script>
    export default {
        created() {
            AppStorage.clear();
            Toast.fire({
                icon: 'success',
                title: 'Logout successfully'
            });
            this.$router.push('/');
        }
    }
</script>

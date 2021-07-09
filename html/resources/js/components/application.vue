<template>
    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand">SiteForYou</span>
            <router-link
                to="/logout"
                class="btn btn-outline-success my-2 my-sm-0">Logout</router-link>
        </nav>
        <div class="card">
            <div class="card-header">
                <h2>Welcome! Make your first short link</h2>
            </div>
            <div class="card-body">
                <form @submit.prevent="makeLink">
                    <div class="form-group">
                        <label>Email address</label>
                        <input
                            @focus="error = ''"
                            v-model="form.link"
                            :class = "(error) ? 'is-invalid' : ''"
                            class="form-control form-control-lg" type="text" placeholder="Enter your link">
                        <small class="text-danger" v-if="error">{{ error }}</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
        data: () => ({
            form: {
                link: ''
            },
            error: '',
        }),
        methods: {
            makeLink() {
                if (!this.link) {
                    this.error = 'The field link is required';
                    Toast.fire({
                        icon: 'error',
                        title: 'The field link is required'
                    });
                    return false;
                }
                axios.post('/api/make-link', this.form)
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        this.error = 'Error. Try later';
                        Toast.fire({
                            icon: 'error',
                            title: 'Error. Try later'
                        });
                    }
                );
            }
        }
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

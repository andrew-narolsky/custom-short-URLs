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
        <div class="card">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:20%">ID</th>
                        <th style="width:40%;">Link</th>
                        <th style="width:40%;">Short link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="link in links" :key="link.id">
                        <td>{{ link.id }}</td>
                        <td>{{ link.link }}</td>
                        <td>
                            <a :href="link.short_link">{{ link.short_link }}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            if (!User.loggedIn()) {
                this.$router.push('/login');
            }
            this.getLinks();
        },
        data: () => ({
            links: {},
            form: {
                link: ''
            },
            error: '',
        }),
        methods: {
            makeLink() {
                if (!this.form.link) {
                    this.error = 'The field link is required';
                    Toast.fire({
                        icon: 'error',
                        title: 'The field link is required'
                    });
                    return false;
                }
                const config = {
                    headers: { Authorization: 'Bearer' + AppStorage.getToken() }
                };
                axios.post('/api/make-link', this.form, config)
                    .then(response => {
                        if (response.status === 200 && !response.data.code) {
                            Swal.fire(
                                'Good job!',
                                'You make short link!',
                                'success'
                            );
                            this.form.link = '';
                        } else {
                            this.error = response.data.code;
                            Toast.fire({
                                icon: 'error',
                                title: response.data.code
                            });
                        }
                    })
                    .catch(error => {
                        this.error = 'Error. Try later';
                        Toast.fire({
                            icon: 'error',
                            title: 'Error. Try later'
                        });
                    }
                );
            },
            getLinks() {
                const config = {
                    headers: { Authorization: 'Bearer' + AppStorage.getToken() }
                };
                axios.get('/api/links', config)
                    .then(response => {
                        this.links = response.data;
                    })
                    .catch(error => {
                        console.log(error);
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
        margin-top: 50px;
    }
</style>

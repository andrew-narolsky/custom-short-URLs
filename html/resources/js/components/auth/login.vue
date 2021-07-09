<template>
    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label>Email address</label>
                        <input
                            v-model="form.email"
                            :class = "(errors.email) ? 'is-invalid' : ''"
                            class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email">
                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input
                            v-model="form.password"
                            :class = "(errors.password) ? 'is-invalid' : ''"
                            class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password">
                        <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
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
            if (User.loggedIn()) {
                this.$router.push('/');
            }
        },
        data: () => ({
            form: {
                email: 'qwerty@i.ua',
                password: 'password'
            },
            errors: {}
        }),
        methods: {
            login() {
                axios.post('/api/auth/login', this.form)
                    .then(response => {
                        User.responseAfterLogin(response);
                        Toast.fire({
                            icon: 'success',
                            title: 'Signed in successfully'
                        });
                        this.$router.push('/');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        Toast.fire({
                            icon: 'error',
                            title: 'Invalid email or password'
                        });
                    }
                );
            }
        }
    }
</script>

<style>
    .card {
        margin-top: 10%;
    }
</style>

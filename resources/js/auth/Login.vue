<template>
    <div class="container mt-3">
        <h3>Sign in</h3>

        <form @submit.prevent="handleLogin">
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    v-model="form.email"
                    id="email"
                    name="email"
                    type="email"
                    class="form-control"

                    :class="{'is-invalid': form.errors.has('email')}"

                    @keydown="form.errors.clear('email')">

                <span
                    v-text="form.errors.get('email')"
                    v-if="form.errors.has('email')"
                    class="text-danger">

                </span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    v-model="form.password"
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"

                    :class="{'is-invalid': form.errors.has('password')}"

                    @keydown="form.errors.clear('password')">

                <span
                    v-text="form.errors.get('password')"
                    v-if="form.errors.has('password')"
                    class="text-danger">

                </span>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <div class="mt-2">
                <router-link tag="a" to="/register" exact>
                    Don't have an account?
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    props: [],

    data() {
        return {
            form: new Form({
                email: '',
                password: '',
            })
        }
    },

    methods: {
        handleLogin(){
            axios.get('/sanctum/csrf-cookie').then(() => {
                this.form.post('/login').then(() => {
                    this.$emit('checkUser')
                    this.$router.push({name: 'Home'})
                })
                .catch(error => {
                    console.log(error);
                })
            });
        },
    },
}
</script>

<style scoped>

</style>

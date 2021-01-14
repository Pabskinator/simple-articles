<template>
    <div class="container mt-3">
        <h3>Register</h3>

        <form @submit.prevent="handleRegister">
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    v-model="form.name"
                    id="name"
                    name="name"
                    type="text"
                    class="form-control"

                    :class="{'is-invalid': form.errors.has('name')}"

                    @keydown="form.errors.clear('name')">

                <span
                    v-text="form.errors.get('name')"
                    v-if="form.errors.has('name')"
                    class="text-danger">

                </span>
            </div>

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

            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <input
                    v-model="form.password_confirmation"
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control"

                    :class="{'is-invalid': form.errors.has('password_confirmation')}"

                    @keydown="form.errors.clear('password_confirmation')">

                <span
                    v-text="form.errors.get('password_confirmation')"
                    v-if="form.errors.has('password_confirmation')"
                    class="text-danger">

                </span>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>

            <div class="mt-2">
                <router-link tag="a" to="/login" exact>
                    Already registered?
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
                name: '',
                email: '',
                password:'',
                password_confirmation:''
            })
        }
    },

    methods: {
        handleRegister(){
            this.form.post('/register').then(() => {
                this.$router.push({name: 'Login'})
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
}
</script>

<style scoped>

</style>

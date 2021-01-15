<template>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <router-link class="navbar-brand" tag="a" to="/" exact>
            Articles
        </router-link>

        <button
            type="button"
            class="navbar-toggler"

            data-toggle="collapse"
            data-target="#navbarSupportedContent"

            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mr-auto">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" tag="a" to="/" exact>
                            Home
                        </router-link>
                    </li>

                    <li class="nav-item" v-if="user">
                        <router-link class="nav-link" tag="a" to="/my_articles">
                            My Articles
                        </router-link>
                    </li>
                </ul>
            </div>

            <div v-if="!user" class="ml-auto">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" tag="a" to="/login">
                            Login
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" tag="a" to="/register">
                            Register
                        </router-link>
                    </li>
                </ul>
            </div>

            <div v-else class="ml-auto">
                <div class="dropdown">
                    <button
                        type="button"
                        id="dropdownMenuButton"
                        class="btn btn-link dropdown-toggle p-0 text-secondary"

                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">

                        {{ user.name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="dropdownMenuButton">
                        <span class="dropdown-item" @click="logout">Logout</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    props: {
        user: {
            default: null
        }
    },

    data() {
        return {}
    },

    methods: {
        logout(){
            axios.post('/logout').then(() => {
                this.$emit('checkUser')
                this.$router.push({name: 'Home'}).catch(()=>{});
            })
        }
    },
}

</script>

<style scoped>

</style>

<template>
    <div id="app">
        <Navbar :user="user" @checkUser="getUser"></Navbar>

        <router-view @checkUser="getUser"></router-view>
    </div>
</template>

<script>
import Navbar from "../components/Navbar";

export default {
    components: {
        Navbar
    },

    data() {
        return {
            user: ''
        }
    },

    mounted() {
        this.getUser()
    },

    methods: {
        getUser(){
            axios.get('/api/check_user').then(response => {
                this.user = response.data
            })
        }
    },
}

</script>

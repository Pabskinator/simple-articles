<template>
    <div class="container-fluid mt-3">
        <div v-if="!articles.length">
            <h1>No Articles Found!</h1>
        </div>
        <div v-else class="card my-2" v-for="article in articles" :key="article.id">
            <div class="card-body">
                <h5 class="card-title">
                    <router-link tag="a" :to="{path: '/articles/' + article.id}">
                        {{ article.title }}
                    </router-link>
                </h5>
                <div class="card-subtitle mb-2 text-muted">
                    <h6>Author: {{ article.author.name }}</h6>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [],

    data() {
        return {
            articles: []
        }
    },

    mounted() {
        this.getArticles();
    },

    methods: {
        getArticles(){
            axios.get('/api/articles').then(response => {
                this.articles = response.data.articles;
            })
        }
    },
}
</script>

<style scoped>

</style>

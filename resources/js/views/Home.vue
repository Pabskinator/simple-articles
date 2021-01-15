<template>
    <div class="container-fluid mt-3">
        <Filters @filteredArticles="filteredArticles"></Filters>

        <div v-if="!articles.length">
            <h1>No results found!</h1>
        </div>

        <div v-else>
            <div class="card my-2" v-for="article in articles" :key="article.id">
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
    </div>
</template>

<script>
import Filters from "../components/Filters";

export default {
    props: [],

    components: {Filters},

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
        },

        filteredArticles(filter){
            filter.mod = 'home';
            axios.post('api/filtered_articles', filter).then(response => {
                this.articles = response.data.articles
            })
        }
    },
}
</script>

<style scoped>

</style>

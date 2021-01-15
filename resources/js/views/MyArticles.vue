<template>
    <div class="container-fluid mt-3">
        <button class="btn btn-success mb-3" @click="toggleModal('show')">Add Article</button>

        <Filters @filteredArticles="filteredArticles"></Filters>

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
                    <h6>{{ article.excerpt }}</h6>
                </div>
            </div>
        </div>

        <article-form-modal ref="article_modal" :article="null" @getData="refreshData">

        </article-form-modal>
    </div>
</template>

<script>
import ArticleFormModal from "../components/ArticleFormModal";
import Filters from "../components/Filters";

export default {
    props: [],

    components: {ArticleFormModal, Filters},

    data() {
        return {
            articles: [],
        }
    },

    mounted() {
        this.getArticles();
    },

    methods: {
        getArticles(){
            axios.get('/api/my_articles').then(response => {
                this.articles = response.data.articles;
            })
        },

        toggleModal(mod){
            let element = this.$refs.article_modal.$el
            mod === 'show' ? $(element).modal('show') : $(element).modal('hide')
        },

        filteredArticles(filter){
            filter.mod = 'user';
            axios.post('api/filtered_articles', filter).then(response => {
                this.articles = response.data.articles
            })
        },

        refreshData(){
            this.getArticles();
            this.toggleModal('hide');
        },
    },
}
</script>

<style scoped>

</style>

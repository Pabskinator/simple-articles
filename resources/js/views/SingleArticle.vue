<template>
    <div class="container-fluid mt-3">
        <button class="btn btn-light" @click="goBack">
            <i class="fa fa-arrow-alt-circle-left"></i>
            Back
        </button>

        <div class="card my-2">
            <div class="card-body">
                <h2 class="card-title">
                    {{ article.title }}
                </h2>

                <h6 class="card-subtitle mb-2 text-muted">
                    {{ article.excerpt }}
                </h6>

                <p class="card-text mt-3">
                    {{ article.body }}
                </p>
            </div>
            <div class="card-footer text-muted d-flex align-items-center justify-content-between">
                <div>
                    <h6>
                        Posted By: {{ article.author.name }}
                    </h6>
                </div>
                <div>
                    <button
                        v-if="article.can.update"
                        class="btn btn-primary"

                        @click="getEditableDetails()">

                        <i class="fa fa-pen-alt"></i>
                        Edit
                    </button>

                    <button
                        v-if="article.can.delete"
                        class="btn btn-danger"

                        @click="deleteArticle">

                        <i class="fa fa-trash"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>

        <article-form-modal ref="article_modal" :article="editable_article_data" @getData="refreshData">

        </article-form-modal>
    </div>
</template>

<script>
import { alertMixin } from "../mixins/alertMixins";
import ArticleFormModal from "../components/ArticleFormModal";

export default {
    mixins: [alertMixin],

    components: {ArticleFormModal},

    data() {
        return {
            article: '',
            editable_article_data: '',
        }
    },

    mounted() {
        this.getArticleDetails(this.$route.params.id);
    },

    methods: {
        getArticleDetails(id){
            axios.get('/api/articles/' + id).then(response => {
                this.article = response.data.data
            });
        },

        getEditableDetails(){
            axios.get('/api/articles/' + this.$route.params.id + '/edit').then(response => {
                this.editable_article_data = response.data.data
                this.toggleModal('show')
            });
        },

        deleteArticle(){
            axios.delete('/api/articles/' + this.$route.params.id).then(() => {
                this.showToast('', 'You have successfully deleted an article!', 'error')
                this.$router.push({name: 'MyArticles'})
            })
        },

        toggleModal(mod){
            let element = this.$refs.article_modal.$el
            mod === 'show' ? $(element).modal('show') : $(element).modal('hide')
        },

        refreshData(data){
            this.getArticleDetails(data)
            this.toggleModal('hide')
        },

        goBack() {
            this.$router.back();
        },
    },
}
</script>

<style scoped>

</style>

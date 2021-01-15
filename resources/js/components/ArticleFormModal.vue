<template>
    <!-- Modal -->
    <div
        tabindex="-1"
        role="dialog"
        id="exampleModal"
        class="modal fade"

        aria-hidden="true"
        aria-labelledby="exampleModalLabel">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form @submit.prevent="handleEvent">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ modalTitle }} Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input
                                    v-model="form.title"
                                    id="title"
                                    name="title"
                                    type="text"
                                    class="form-control"

                                    :class="{'is-invalid': form.errors.has('title')}"

                                    @keydown="form.errors.clear('title')">

                                <span
                                    v-text="form.errors.get('title')"
                                    v-if="form.errors.has('title')"
                                    class="text-danger">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <input
                                    v-model="form.excerpt"
                                    id="excerpt"
                                    name="excerpt"
                                    type="text"
                                    class="form-control"

                                    :class="{'is-invalid': form.errors.has('excerpt')}"

                                    @keydown="form.errors.clear('excerpt')">

                                <span
                                    v-text="form.errors.get('excerpt')"
                                    v-if="form.errors.has('excerpt')"
                                    class="text-danger">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea
                                    v-model="form.body"
                                    id="body"
                                    name="body"
                                    type="text"
                                    class="form-control"

                                    :class="{'is-invalid': form.errors.has('body')}"

                                    @keydown="form.errors.clear('body')">

                                </textarea>

                                <span
                                    v-text="form.errors.get('body')"
                                    v-if="form.errors.has('body')"
                                    class="text-danger">

                                </span>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-if="modalTitle === 'Add'" type="submit" class="btn btn-success">Add</button>
                        <button v-else type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        article: {
            default: null
        }
    },

    data() {
        return {
            form: new Form({
                body: '',
                title: '',
                excerpt: '',
            })
        }
    },

    computed: {
        modalTitle: function () {
            return this.article ? "Update" : "Add";
        }
    },

    watch: {
        article: function() {
            this.assignData()
        }
    },

    mounted() {
        this.assignData();
    },

    methods: {
        handleEvent(){
            if(this.article){
                this.updateArticle(this.article)
            }else{
                this.addArticle()
            }
        },

        addArticle(){
            this.form.post('/api/articles').then(() => {
                this.$emit('getData')
            })
            .catch(error => {
                console.log(error);
            })
        },

        updateArticle(data){
            this.form.put('/api/articles/' + data.id).then(() => {
                this.$emit('getData', this.article.id)
            })
            .catch(error => {
                console.log(error);
            })
        },

        assignData(){
            if(this.article){
                this.form.body = this.article.body
                this.form.title = this.article.title
                this.form.excerpt = this.article.excerpt
            }
        },
    },
}
</script>

<style scoped>

</style>

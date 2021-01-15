<template>
    <div class="card mb-3">
        <div class="card-body">
            <div class="card-title">
                Filters
            </div>

            <div class="card-text">
                <form @submit.prevent="getFilteredArticles">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input
                                    v-model="filter.title"
                                    id="title"
                                    name="title"
                                    type="text"
                                    placeholder="Title"
                                    class="form-control">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-dark">
                                <i class="fa fa-filter"></i>
                                Filter
                            </button>

                            <button type="button" class="btn btn-dark" @click="resetFilters">
                                <i class="fa fa-redo"></i>
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [],

    data() {
        return {
            filter: {
                title: '',
            }
        }
    },

    methods: {
        getFilteredArticles(){
            this.$emit('filteredArticles', this.filter)
        },

        resetFilters(){
            this.filter.title = ''
            this.getFilteredArticles()
        }
    },
}
</script>

<style scoped>

</style>

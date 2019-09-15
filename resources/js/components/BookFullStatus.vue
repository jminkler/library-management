<template>
    <div class="">
        <h3>Books</h3>
        <pagination-status :pagination="pagination"/>
        <div class="list-group">
            <div class="list-group-item" v-for="book in bookStatuses">
                <div class="d-flex flex-row">
                    <div class="w-25 mr-4">
                        {{ book.title }}
                        <div v-for="auth in book.authors.data">
                            <div>By: {{ auth.name }}</div>
                        </div>
                        <div>ISBN: {{ book.isbn }}</div>
                    </div>
                    <div class="flex-grow-1 d-flex flex-column mr-4">
                        <div v-for="desc in book.descriptions.data">
                            <div>
                                <span class="badge badge-primary">
                                    {{ desc.language }}
                                </span>
                                {{ desc.description }}
                            </div>
                        </div>
                    </div>
                    <book-buttons :book="book"/>
                </div>
            </div>
        </div>
        <span @click="page = 1; get()" class="badge badge-primary" v-if="page != 1">< First</span>
        <span @click="previous" class="badge badge-primary" v-if="page != 1">< Previous</span>
        <span @click="next" class="badge badge-primary">Next ></span>
        <span @click="page = pagination.total_pages; get()" class="badge badge-primary">Last ></span>
    </div>
</template>

<script>
    import {mapActions, mapState} from 'vuex'
    import PaginationStatus from "./PaginationStatus";
    import BookButtons from "./BookButtons";

    export default {
        name: "BookFullStatus",
        components: {BookButtons, PaginationStatus},
        data() {
            return {
                page: 1,
                perPage: 10
            }
        },
        watch: {
            deletedBook: function () {
                this.get()
            }
        },
        computed: {
            ...mapState({
                bookStatuses: state => state.books.bookStatuses,
                pagination: state => state.books.bookPagination,
                deletedBook: state => state.books.deletedBook,
            })
        },
        methods: {
            ...mapActions([
                'getBookStatuses'
            ]),
            next() {
                this.page++;
                this.get();
            },
            previous() {
                this.page--;
                this.get();
            },
            get() {
                this.getBookStatuses({
                    page: this.page,
                    perPage: this.perPage
                })
            }
        },
        mounted() {
            this.getBookStatuses({
                page: this.page,
                perPage: this.perPage
            })
        }
    }
</script>


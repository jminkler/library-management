<template>
    <div class="w-25">
        <h3>Books</h3>
        <pagination-status :pagination="pagination"></pagination-status>
        <div class="list-group">
            <div class="list-group-item" v-for="book in bookStatuses">
                <span :class="book.status == 'IN' ? 'badge-success' : 'badge-warning'" class="badge">
                    {{ book.status }}
                </span> {{ book.isbn }}
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

    export default {
        name: "BookStatus",
        components: {PaginationStatus},
        data() {
            return {
                page: 1,
                perPage: 10
            }
        },
        computed: {
            ...mapState({
                bookStatuses: state => state.books.bookStatuses,
                pagination: state => state.books.bookPagination
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


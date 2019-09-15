<template>
    <div class="w-25">
        <h3>Books</h3>
        <h4 class="small">
            Total Books: {{ pagination.total }} Page: {{ pagination.current_page}}
            Total Pages: {{ pagination.total_pages }}
        </h4>
        <div class="list-group">
            <div class="list-group-item" v-for="book in bookStatuses">
                <span :class="book.status == 'IN' ? 'badge-success' : 'badge-warning'" class="badge w-25">
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

    export default {
        name: "BookStatus",
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


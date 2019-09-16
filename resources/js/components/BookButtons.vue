<template>
    <div>
        <button @click="view" class="btn btn-secondary" v-if="showView">View / Edit</button>
        <button @click="checkoutBook" class="btn btn-warning" v-if="status == 'IN'">Check Out</button>
        <button @click="checkinBook" class="btn btn-primary" v-if="status == 'OUT'">Check In</button>
        <button @click="deleteBook" class="btn btn-danger">Delete</button>
    </div>
</template>
<script>
    import {mapActions} from 'vuex'

    export default {
        name: 'book-buttons',
        props: ['book', 'showView'],
        computed: {
            status() {
                return this.book.status ? this.book.status : 'IN'
            }
        },
        methods: {
            ...mapActions(['checkout', 'checkin', 'removeBook']),
            deleteBook() {
                let del = confirm("Are you sure?");
                if (del) {
                    this.removeBook(this.book.isbn)
                }
            },
            view() {
                this.$router.push({
                    name: 'view-book',
                    params: {
                        isbn: this.book.isbn
                    }
                })
            },
            checkoutBook() {
                this.checkout(this.book.isbn);
                this.book.status = 'OUT'
            },
            checkinBook() {
                this.checkin(this.book.isbn);
                this.book.status = 'IN'
            }
        }
    }
</script>

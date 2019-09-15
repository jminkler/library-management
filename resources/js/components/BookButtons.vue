<template>
    <div>
        <button @click="view" class="btn btn-secondary">View / Edit</button>
        <button @click="checkoutBook" class="btn btn-warning" v-if="book.status == 'IN'">CheckOut</button>
        <button @click="checkinBook" class="btn btn-primary" v-if="book.status == 'OUT'">Check In</button>
        <button @click="deleteBook" class="btn btn-danger">Delete</button>
    </div>
</template>
<script>
    import {mapActions} from 'vuex'

    export default {
        name: 'book-buttons',
        props: ['book'],
        methods: {
            ...mapActions(['checkout', 'checkin']),
            deleteBook() {
                if (confirm("Are you sure?")) {
                    this.removeBook(this.book.isbn)
                }
            },
            view() {
                this.$router.push({
                    name: 'view-book',
                    params: {
                        id: this.book.id
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

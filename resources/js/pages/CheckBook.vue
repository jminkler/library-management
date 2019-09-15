<template>
    <div>
        <h3>Enter ISBN to Check Out/In</h3>
        <div class="form-group">
            <input class="form-control" v-model="isbn">
            <button @click="checkOutBook" class="btn btn-danger mt-2">Check Out</button>
            <button @click="checkInBook" class="btn btn-success mt-2">Check In</button>
        </div>

    </div>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {
        name: "CheckBook",
        data() {
            return {
                isbn: '978-0938650553'
            }
        },
        methods: {
            ...mapActions([
                'checkout',
                'checkin',
                'checkerrors'
            ]),
            checkOutBook() {
                if (!this.isbn) {
                    return
                }
                this.checkout(this.isbn)
            },
            checkInBook() {
                if (!this.isbn) {
                    return
                }
                this.checkin(this.isbn)
            }
        }
    }
</script>

<style scoped>

</style>

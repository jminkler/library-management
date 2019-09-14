<template>
    <div>
        <h3>Enter ISBN to Check Out/In</h3>
        <div class="form-group">
            <input v-model="isbnOut" class="form-control">
            <button @click="checkOutBook" class="btn btn-secondary mt-2">Check Out</button>
        </div>

        <div class="form-group">
            <input v-model="isbnIn" class="form-control">
            <button @click="checkInBook" class="btn btn-secondary mt-2">Check In</button>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex'

    export default {
        name: "CheckBook",
        data() {
            return {
                isbnOut: '',
                isbnIn: ''
            }
        },
        methods: {
            ...mapActions([
                'checkout',
                'checkin',
                'checkerrors'
            ]),
            checkOutBook() {
                if (!this.isbnOut) { return }
                this.checkout(this.isbnOut)
                this.isbnOut = '';
            },
            checkInBook() {
                if (!this.isbnIn) { return }
                this.checkin(this.isbnIn)
                this.isbnIn = '';
            }
        }
    }
</script>

<style scoped>

</style>

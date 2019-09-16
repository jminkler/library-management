<template>
    <div v-if="book.data">

        <h3 @click="toggleTitle" v-if="!edit.title">
            {{ title }}
        </h3>
        <h3 v-if="edit.title">
            <input class="form-control" v-model="book.data.title">
            <button @click="save" class="btn btn-secondary">Save</button>
        </h3>


        <h3 @click="toggleAuthors" v-if="!edit.authors">
            <small class="text-muted" v-if="authors.length">
                By: {{ authors.join(', ') }}
            </small>
        </h3>
        <h3 v-if="edit.authors">
            <input v-for="(author, key) in book.data.authors.data"
                   v-model="book.data.authors.data[key].name">
            <button @click="updateAuthors">Save</button>
        </h3>


        <book-buttons :book="book.data" :showView="false"></book-buttons>
        {{ book.status }}
        <div class="mt-4" v-for="desc in descriptions">
            <h4 class="badge badge-primary">{{ desc.language }}</h4>
            <p>desc.description</p>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapState} from 'vuex'
    import BookButtons from "../components/BookButtons";

    export default {
        name: "ViewBook",
        components: {BookButtons},
        data() {
            return {
                edit: {
                    title: false,
                    authors: false,
                    descriptions: false,
                }
            }
        },
        watch: {
            deletedBook: function () {
                this.$router.push({name: 'books'})
            }
        },
        computed: {
            ...mapState({
                book: state => state.books.currentBook,
                deletedBook: state => state.books.deletedBook
            }),
            title() {
                return this.book.data.title
            },
            authors() {
                let ret = [];
                this.book.data.authors.data.forEach(function (auth) {
                    ret.push(auth.name);
                });
                return ret
            },
            descriptions() {
                return this.book.data.descriptions.data
            }
        },
        methods: {
            ...mapActions([
                'getBook',
                'saveBook',
                'saveAuthors',
                'saveDescriptions'
            ]),
            toggleTitle() {
                this.edit.title = !this.edit.title
            },
            toggleAuthors() {
                this.edit.authors = !this.edit.authors
            },

            save() {
                this.saveBook(this.book);
                this.resetEditing()
            },
            updateAuthors() {
                this.saveAuthors({
                    isbn: this.book.data.isbn,
                    authors: this.book.data.authors.data
                });
                this.resetEditing()
            },
            updateDescriptions() {
                this.saveDescriptions(this.book.data.descriptions);
                this.resetEditing()
            },
            resetEditing() {
                this.edit.title = false;
                this.edit.authors = false;
                this.edit.authors = false;
            }
        },
        mounted() {
            this.getBook(this.$route.params.isbn)
        }
    }
</script>

<style scoped>

</style>

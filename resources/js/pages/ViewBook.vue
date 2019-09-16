<template>
    <div class="d-flex flex-row" v-if="book.data">

        <div class="w-25 mr-4">
            <h4 @click="toggle('title')" v-if="!edit.title">
                {{ title }}
            </h4>
            <h3 v-if="edit.title">
                <input class="form-control" v-model="book.data.title">
                <button @click="save" class="btn btn-secondary">Save</button>
            </h3>

            <h5>
                {{ isbn }}
            </h5>


            <book-buttons :book="book.data" :showView="false"></book-buttons>
        </div>

        <div class="w-25 mr-4">
            <h4>Authors:</h4>
            <div class="form-group">
                <div :key="author.id" class="list-group-item d-flex flex-row"
                     v-for="(author, key) in authorsData">
                    <div>{{ author.name }}</div>
                    <button @click="delAuthor(author.id)" class="btn btn-outline-danger ml-auto">
                        Remove
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label>New Author</label>
                <input v-model="authorToAdd">
                <button @click="addAuthor">Add</button>
            </div>
        </div>

        <div class="w-50">
            <h4>Descriptions:</h4>
            <div class="list-group">
                <div :key="desc.id"
                     class="mb-4 list-group-item"
                     v-for="(desc, key) in descriptions">
                    <h4 class="badge badge-primary">{{ desc.language }}</h4>
                    <p>{{ desc.description }}</p>
                    <button @click="delDesc(desc.id)" class="btn btn-outline-danger">Remove</button>
                </div>
            </div>

            <div class="form-group">
                <label>New Description</label>
                <select class="form-control" v-model="descLangToAdd">
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                </select>
                <textarea class="form-control" v-model="descToAdd"></textarea>
                <button @click="addDesc">Add</button>
            </div>
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
                },
                authorToAdd: '',
                descToAdd: '',
                descLangToAdd: 'en'
            }
        },
        watch: {
            deletedBook: function () {
                this.$router.push({name: 'books'})
                this.authorToAdd = '';
                this.descToAdd = '';
            }
        },
        computed: {
            ...mapState({
                book: state => state.books.currentBook,
                deletedBook: state => state.books.deletedBook
            }),
            isbn() {
                return this.book.data.isbn
            },
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
            },
            authorsData() {
                return this.book.data.authors.data
            }
        },
        methods: {
            ...mapActions([
                'getBook',
                'saveBook',
                'addAuthorToBook',
                'addDescToBook',
                'removeAuthor',
                'removeDesc'
            ]),
            toggle(key) {
                this.edit[key] = !this.edit[key]
            },
            save() {
                this.saveBook(this.book);
                this.resetEditing()
            },
            updateAuthors() {
                this.saveAuthors({
                    isbn: this.isbn,
                    authors: this.authorsData
                });
                this.resetEditing()
            },
            updateDescriptions() {
                this.saveDescriptions({
                    isbn: this.isbn,
                    descriptions: this.descriptions
                });
                this.resetEditing()
            },
            addAuthor() {
                this.addAuthorToBook({isbn: this.book.data.isbn, author: this.authorToAdd})
            },
            addDesc() {
                this.addDescToBook({
                    isbn: this.book.data.isbn,
                    description: this.descToAdd,
                    language: this.descLangToAdd
                })
            },
            delAuthor(id) {
                this.removeAuthor({
                    isbn: this.book.data.isbn, author: id
                })
            },
            delDesc(id) {
                this.removeDesc({
                    isbn: this.book.data.isbn,
                    description: id
                })
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

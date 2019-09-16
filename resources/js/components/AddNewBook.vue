<template>
    <div>
        <h3>Add A Book</h3>
        <div class="form-group">
            <label class="form-label">ISBN</label>
            <input v-model="isbn" class="form-control">
            <div id="error-isbn" v-if="errors.isbn" class="alert alert-danger mt-2">
                <ul class="mb-0">
                    <li v-for="error in errors.isbn">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Title</label>
            <input v-model="title" class="form-control">
            <div id="error-title" v-if="errors.title" class="alert alert-danger mt-2">
                <ul class="mb-0">
                    <li v-for="error in errors.title">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Add Authors</label>
            <input v-model="authorToAdd" class="form-control">
            <button @click="addAuthor" class="btn btn-secondary mt-2">Add Author</button>
            <div v-if="authors.length > 0" class="mt-2">
                <ul>
                    <li v-for="author in authors">
                        {{ author }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Add Description</label>
            <textarea v-model="descriptionToAdd" class="form-control"></textarea>
            <select class="form-control mt-2" v-model="descriptionLang">
                <option value="en">English</option>
                <option value="es">Spanish</option>
            </select>
            <button @click="addDescription" class="btn btn-secondary mt-2">Add Description</button>
            <div v-if="descriptions.length > 0" class="mt-2">
                <ul>
                    <li v-for="desc in descriptions">
                        <span class="badge badge-primary">{{ desc.language }}</span>
                        {{ desc.description }}
                    </li>
                </ul>
            </div>
        </div>

        <button @click="addABook" class="btn btn-primary">Add Book</button>

    </div>
</template>

<script>
    import {mapActions, mapState} from 'vuex'

    export default {
        name: "AddNewBook",
        data() {
            return {
                isbn: '978-0938650553',
                title: '',
                authors: [],
                descriptions: [],
                authorToAdd: '',
                descriptionToAdd: '',
                descriptionLang: 'en'
            }
        },
        watch: {
            created: function () {
                this.$router.push({name: 'books'})
            }
        },
        computed: {
            ...mapState({
                created: state => state.books.createdBook,
                errors: state => state.books.errors
            })
        },
        methods: {
            ...mapActions([
                'addBook'
            ]),
            addABook() {
                this.addBook({
                    isbn: this.isbn,
                    title: this.title,
                    authors: this.authors,
                    descriptions: this.descriptions,
                })
            },
            addAuthor() {
                if (this.authorToAdd != '') {
                    this.authors.push(this.authorToAdd);
                    this.authorToAdd = '';
                }

            },
            addDescription() {
                if (!this.descriptionToAdd || !this.descriptionLang) {
                    return
                }

                this.descriptions.push({
                    description: this.descriptionToAdd,
                    language: this.descriptionLang
                });
                this.descriptionToAdd = '';
                this.descriptionLang = 'en'
            }
        }
    }
</script>

<style scoped>

</style>

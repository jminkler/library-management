<template>
    <div class="bd-highlight mr-4 w-25">
        <h3>Recent Changes</h3>
        <h4 class="small">
            Total Changes: {{ pagination.total }} Page: {{ pagination.current_page}}
            Total Pages: {{ pagination.total_pages }}
        </h4>
        <div class="list-group">
            <div class="list-group-item" v-for="status in latestStatuses">
                <span :class="status.status == 'IN' ? 'badge-success' : 'badge-warning'" class="badge w-25">{{ status.status }}</span>
                {{ status.book.data.isbn }}
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
        name: "Status",
        data() {
            return {
                page: 1,
                perPage: 10
            }
        },
        computed: {
            ...mapState({
                latestStatuses: state => state.books.latestStatuses,
                pagination: state => state.books.statusPagination
            })
        },
        methods: {
            ...mapActions([
                'getStatuses'
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
                this.getStatuses({
                    page: this.page,
                    perPage: this.perPage
                })
            }
        },
        mounted() {
            this.getStatuses({
                page: this.page,
                perPage: this.perPage
            })
        }
    }
</script>

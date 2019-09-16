import book from '../../api/book'

const state = {
    createdBook: {},
    errors: [],
    checkerrors: [],
    message: '',
    statuserrors: [],
    latestStatuses: [],
    statusPagination: {},
    bookstatuserrors: [],
    bookStatuses: [],
    bookPagination: {},
    deletedBook: {},
    deleteerrors: [],
    currentBook: {}
};

const getters = {};

const actions = {
    addBook({commit}, attributes) {
        commit('errors', []);
        commit('message', '');
        book.addBook(attributes)
            .then(r =>  ( commit('createdBook', r.data) ))
            .catch(error => { commit('errors', error.response.data.errors) })
    },
    checkout({commit}, isbn) {
        commit('checkerrors', []);
        commit('message', '');
        book.checkout(isbn)
            .then(r =>  ( commit('message', r.message) ))
            .catch(error => { commit('checkerrors', error.response.data.errors) })
    },
    checkin({commit}, isbn) {
        commit('checkerrors', []);
        commit('message', '');
        book.checkin(isbn)
            .then(r =>  ( commit('message', r.message) ))
            .catch(error => { commit('checkerrors', error.response.data.errors) })
    },
    getStatuses({commit}, payload) {
        commit('statuserrors', []);
        book.getStatuses(payload)
            .then(r => (commit('setStatuses', r.data)))
            .catch(error => {
                commit('statuserrors', error.response.data.errors)
            })
    },
    getBookStatuses({commit}, payload) {
        commit('bookstatuserrors', []);
        book.getBookStatuses(payload)
            .then(r => (commit('setBookStatuses', r.data)))
            .catch(error => {
                commit('bookstatuserrors', error.response.data.errors)
            })
    },
    removeBook({commit}, isbn) {
        book.delete(isbn)
            .then(r => (commit('setDeletedBook', r.data)))
            .catch(error => {
                commit('deleteerrors', error.response.data.errors)
            })
    },
    getBook({commit}, id) {
        book.get(id)
            .then(r => (commit('setCurrentBook', r.data)))
            .catch(error => {
                commit('errors', error.response.data.errors)
            })
    },
    saveBook({commit}, updated) {
        book.saveBook(updated)
            .then(r => (commit('setCurrentBook', r.data)))
            .catch(error => {
                commit('errors', error.response.data.errors)
            })
    },
    saveAuthors({commit}, updated) {
        book.saveAuthors(updated)
            .then(r => (commit('setCurrentBook', r.data)))
            .catch(error => {
                commit('errors', error.response.data.errors)
            })
    },
    saveDescriptions({commit}, updated) {
        book.saveDescriptions(updated)
            .then(r => (commit('setCurrentBook', r.data)))
            .catch(error => {
                commit('errors', error.response.data.errors)
            })
    }
};

const mutations = {
    setCurrentBook(state, book) {
        state.currentBook = book;
    },
    setDeletedBook(state, book) {
        state.deletedBook = book
    },
    deleteerrors(state, errors) {
        state.deleteerrors = errors
    },
    setBookStatuses(state, status) {
        state.bookStatuses = status.data;
        state.bookPagination = status.meta.pagination
    },
    bookstatuserrors(state, errors) {
        state.bookstatuserrors = errors
    },
    setStatuses(state, status) {
        state.latestStatuses = status.data;
        state.statusPagination = status.meta.pagination
    },
    statuserrors(state, errors) {
        state.statuserrors = errors
    },
    createdBook(state, book) {
        state.createdBook = book
    },
    errors(state, errors) {
        state.errors = errors
    },
    checkerrors(state, errors) {
        state.checkerrors = errors
    },
    message(state, message) {
        state.message = message
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}

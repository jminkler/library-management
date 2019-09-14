import book from '../../api/book'

const state = {
    createdBook: {},
    errors: [],
    checkerrors: [],
    message: ''
}

const getters = {

}

const actions = {
    addBook({commit}, attributes) {
        commit('errors', [])
        commit('message', '')
        book.addBook(attributes)
            .then(r =>  ( commit('createdBook', r.data) ))
            .catch(error => { commit('errors', error.response.data.errors) })
    },
    checkout({commit}, isbn) {
        commit('checkerrors', [])
        commit('message', '')
        book.checkout(isbn)
            .then(r =>  ( commit('message', r.message) ))
            .catch(error => { commit('checkerrors', error.response.data.errors) })
    },
    checkin({commit}, isbn) {
        commit('checkerrors', [])
        commit('message', '')
        book.checkin(isbn)
            .then(r =>  ( commit('message', r.message) ))
            .catch(error => { commit('checkerrors', error.response.data.errors) })
    }
}

const mutations = {
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
}

export default {
    state,
    getters,
    actions,
    mutations
}

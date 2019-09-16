import axios from 'axios'

/**
 * API for Laravel API Backend
 * Returns Promises
 */
export default {
    addBook(attributes) {
        return axios.post('/api/books', attributes)
    },
    checkout(isbn) {
        return axios.post('/api/books/checkout', {isbn: isbn})
    },
    checkin(isbn) {
        return axios.post('/api/books/checkin', {isbn: isbn})
    },
    getStatuses(payload) {
        return axios.get('/api/statuses', {params: payload})
    },
    getBookStatuses(payload) {
        return axios.get('/api/books', {params: payload})
    },
    delete(isbn) {
        return axios.delete('/api/books/' + isbn)
    },
    get(isbn) {
        return axios.get('/api/books/' + isbn)
    },
    saveBook(book) {
        return axios.put('/api/books/' + book.data.isbn, book.data)
    },
    saveAuthor(payload) {
        return axios.post('/api/books/' + payload.isbn + '/authors', payload)
    },
    saveDescriptions(payload) {
        return axios.post('/api/books/' + payload.isbn + '/descriptions', payload)
    },
    removeAuthor(payload) {
        return axios.delete('/api/books/' + payload.isbn + '/authors/' + payload.author)
    },
    removeDesc(payload) {
        return axios.delete('/api/books/' + payload.isbn + '/descriptions/' + payload.description)
    }
}

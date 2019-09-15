import axios from 'axios'

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
    }

}

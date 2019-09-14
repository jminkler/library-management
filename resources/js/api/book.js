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
    }

}

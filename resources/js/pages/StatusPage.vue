<template>
    <div class="d-flex flex-row bd-highlight mb-3">
        <status></status>
        <book-status></book-status>
    </div>

</template>

<script>
    import Status from '../components/Status'
    import BookStatus from "../components/BookStatus";

    export default {
        name: "StatusPage",
        components: {
            BookStatus,
            Status
        }
    }
</script>

<style scoped>

</style>

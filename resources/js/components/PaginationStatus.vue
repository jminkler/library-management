<template>
    <h4 class="small">
        Total Books: {{ pagination.total }} Page: {{ pagination.current_page}}
        Total Pages: {{ pagination.total_pages }}
    </h4>
</template>
<script>
    export default {
        name: 'pagination-status',
        props: ['pagination']
    }
</script>

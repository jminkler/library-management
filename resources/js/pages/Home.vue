<template>
    <div>
        <div class="nav">
            <router-link :to="{name: 'add-book'}" class="nav-link">Add A Book</router-link>
            <router-link :to="{name: 'check-book'}" class="nav-link">Check In/Out</router-link>
            <router-link :to="{name: 'status'}" class="nav-link">Status Report</router-link>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "Home"
    }
</script>

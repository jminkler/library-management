<template>
    <div>
        <div class="nav">
            <router-link :to="{name: 'books'}" class="nav-link">Books</router-link>
            <router-link :to="{name: 'add-book'}" class="nav-link">Add A Book</router-link>
            <router-link :to="{name: 'check-book'}" class="nav-link">Check In/Out</router-link>
            <router-link :to="{name: 'status'}" class="nav-link">Status Report</router-link>
        </div>
        <transition name="slide-fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "Home"
    }
</script>

<style scoped>
    .slide-fade-enter-active {
        transition: all .3s ease;
    }

    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */
    {
        transform: translateX(10px);
        opacity: 0;
    }
</style>

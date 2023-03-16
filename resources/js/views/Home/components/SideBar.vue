<template>
    <section class="home__sidebar--categories">
        <sideBarCategories/>
    </section>

    <section class="home__sidebar--top-posts">
        <sideBarTopPosts/>
    </section>
</template>

<script setup>
    import sideBarCategories from './SideBarCategories.vue';
    import sideBarTopPosts from './SideBarTopPosts.vue';
</script>


<script>
    export default {
        name: "SideBar",
    }
</script>

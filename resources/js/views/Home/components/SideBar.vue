<template>
    <section class="home-sidebar__categories">
        <SideBarCategories/>
    </section>

    <section class="home-sidebar__top-posts">
        <SideBarTopPosts/>
    </section>
</template>

<script setup>
import SideBarCategories from './SideBarCategories.vue';
import SideBarTopPosts from './SideBarTopPosts.vue';
</script>


<script>
export default {
    name: "SideBar"
}
</script>

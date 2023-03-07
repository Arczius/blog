<template>
    <section class="home__sidebar--categories">
        <SideBarCategories/>
    </section>

    <section class="home__sidebar--top-posts">
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

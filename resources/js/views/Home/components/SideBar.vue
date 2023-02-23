<template>
    <section>
        <SideBarCategories/>
    </section>

    <section>
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

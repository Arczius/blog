<template>
    <Profile/>
    <BlogCreate/>
    <Blog/>
</template>

<script setup>
import Profile from "./components/Profile.vue";
import BlogCreate from '../BlogCreate/components/BlogCreate.vue';
import Blog from '../ShowBlog/components/MainContainer.vue';
</script>

<script>
export default {
    name: "Index",
}
</script>

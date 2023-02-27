<template>
    <div class="onProfile">
        <ProfileBanner/>
        <Profile/>
        <div class="profileInfo">
            <BlogCreate/>
            <Blog/>
        </div>
    </div>
</template>

<script setup>
import Profile from "./components/Profile.vue";
import ProfileBanner from "./components/ProfileBanner.vue"
import BlogCreate from '../BlogCreate/components/BlogCreate.vue';
import Blog from '../ShowBlog/components/MainContainer.vue';
</script>

<script>
export default {
    name: "Index",
}
</script>

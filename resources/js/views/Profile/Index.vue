<template>
    <div class="profile profile__container">
        <ProfileBanner/>
        <div class="sidebar">
            <Profile/>
            <div class="profile profile__categories">
                <SideBarCategories/>
            </div>
        </div>

        <div class="profile profile__info">
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
    import SideBarCategories from '../Home/components/SideBarCategories.vue';
</script>

<script>
    export default {
        name: "Index",
    }
</script>

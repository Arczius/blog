<template>
    <ProfileBanner/>
    <div class="sidebar">
        <Profile/>
        <div class="home home__sidebar--top-posts">
            <UserPosts/>
        </div>
    </div>
    <div class="blog__container">
        <MainContainer/>
    </div>
</template>

<script setup>
    import MainContainer from './components/MainContainer.vue' ;
    import ProfileBanner from '../Profile/components/ProfileBanner.vue';
    import Profile from '../Profile/components/Profile.vue';
    import UserPosts from '../Home/components/SideBarTopPosts.vue'
</script>

<script>
    export default {
        name: "blogs",
    }
</script>

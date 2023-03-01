<template>
    <ProfileBanner/>
    <Profile/>
    <div class="blog__container">
        <MainContainer/>
    </div>
</template>

<script setup>
    import MainContainer from './components/MainContainer.vue' ;
    import ProfileBanner from '../Profile/components/ProfileBanner.vue';
    import Profile from '../Profile/components/Profile.vue';
</script>

<script>
    export default {
        name: "blogs",
    }
</script>

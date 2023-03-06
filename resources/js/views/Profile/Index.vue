<template>
    <div class="profile profile__container">
        <mainContainer/>
        <div class="sidebar">
            <div class="profile profile__categories">
                <sideBarCategories/>
            </div>
        </div>

        <div class="profile profile__info">
            <blogCreate/>
            <blog/>
        </div>
    </div>
</template>

<script setup>
    import blogCreate from '../BlogCreate/components/BlogCreate.vue';
    import blog from '../ShowBlog/components/MainContainer.vue';
    import mainContainer from '../Profile/components/MainContainer.vue';
    import sideBarCategories from '../Home/components/SideBarCategories.vue';
</script>

<script>
    export default {
        name: "users",
    }
</script>

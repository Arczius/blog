<template>
    <ProfileBanner v-if="user" :users="user"/>
    <div class="sidebar">
        <Profile v-if="user" :users="user"/>
        <div class="home home__sidebar--top-posts">
            <UserPosts/>
        </div>
    </div>
    <div class="blog__container">
        <MainContainer v-if="blog" :blog="blog"/>
    </div>
</template>

<script setup>
    import MainContainer from './components/MainContainer.vue' ;
    import ProfileBanner from '../Profile/components/ProfileBanner.vue';
    import Profile from '../Profile/components/Profile.vue';
    import UserPosts from '../Home/components/SideBarTopPosts.vue'
    import axios from 'axios';
</script>

<script>
    export default {
        name: "blogs",
        data(){
            return {
                page_id: this.$route.params.id,
                user: null,
                blog: null,
            }
        },

        methods: {
            getBlogData(){
                axios.get('/api/blog/detail/' + this.page_id)
                    .then(response => {
                        console.table(response.data)
                        this.user = response.data.user
                        this.blog = response.data.blog
                    })
            }
        },
        mounted(){
            this.getBlogData()
        }
    }
</script>

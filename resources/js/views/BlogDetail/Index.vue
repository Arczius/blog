<template>
    <profileBanner v-if="user" :users="user"/>
    <div class="sidebar">
        <!-- <profile v-if="user" :users="user"/> -->
        <profile/>
        <div class="home home__sidebar--top-posts">
            <userPosts/>
        </div>
    </div>
    <div class="blog__container">
        <mainContainer v-if="blog" :blog="blog"/>
    </div>
</template>

<script setup>
    import mainContainer from './components/MainContainer.vue' ;
    import profileBanner from '../Profile/components/ProfileBanner.vue';
    import profile from '../Profile/components/MainContainer.vue';
    import userPosts from '../Home/components/SideBarTopPosts.vue'
    import axios from 'axios';
</script>

<script>
    export default {
        name: "blog",
        
        data(){
            return {
                page_id: this.$route.params.id,
                user: null,
                blog: null,
                comments: null,
                users: null
            }
        },

        methods: {
            getBlogDetail(){
                axios.get('/api/blog/detail/' + this.page_id)
                    .then(response => {
                        this.user = response.data.user
                        this.blog = response.data.blog
                        this.comments = response.data.comments
                    })
            },
        },

        mounted(){
            this.getBlogDetail()
        }
    }
</script>

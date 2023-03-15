<template>
    <profileBanner v-if="user" :users="user"/>
    <div class="container">

        <div class="sidebar">
            <profile v-if="user" :users="user"/>
        </div>

        <div class="blog__container">
            <mainContainer v-if="blog" :blog="blog"/>
        </div>
    </div>
</template>

<script setup>
    import mainContainer from './components/MainContainer.vue' ;
    import profileBanner from '../Profile/components/ProfileBanner.vue';
    import profile from '../Profile/components/MainContainer.vue';
    import axios from 'axios';
</script>

<style>
.sidebar .profile__banner {
    display: none;
}
</style>

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
                        console.table(response.data.blog)
                        this.user = response.data.blog[0].user
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

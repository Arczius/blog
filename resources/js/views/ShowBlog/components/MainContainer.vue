<template>
    <main>
        <div class="container">
            <MainContainerItemSkeleton v-if="blogs === null"/>

            <MainContainerItem v-else v-for="blog in blogs" :blog="blog"/>
            <!-- <MainContainerItem v-else v-for="user in users" :user="user"/> -->
        </div>
        
    </main>
</template>

<script setup>
    import MainContainerItemSkeleton from './MainContainerItemSkeleton.vue'
    import MainContainerItem from './MainContainerItem.vue';
    import axios from 'axios'
</script>


<script>
    export default {
        name: "MainContainer",
        props: {
            // 'blogs': null,
            // 'users': null,
        },
        
        data(){
            return {
                'blogs': null,
                'users': null,
                'id': this.$route.params.id
            }
        },

        methods: {
            getAllBlogs(){
                axios.get('/api/blog')
                    .then((response) => {
                        this.blogs = response.data.blogs
                        console.log(this.blogs)
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },

            getUserProfile(){
                axios.get('/api/profile/user/' + this.id)
                    .then((response) => {
                        this.users = response.data.users
                        console.log(this.users)
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },
        },

        mounted(){
            this.getAllBlogs()
            this.getUserProfile()
        }
    }
</script>
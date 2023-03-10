<template>
    <main>
        <div class="container">
            <MainContainerItemSkeleton v-if="blogs === null || user === null"/>

            <MainContainerItem v-else v-for="blog in blogs" :blog="blog" :user="user" :comments="comments" @refresh="getAllBlogs"/>
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
        
        data(){
            return {
                'blogs': null,
                'user': null,
                'comments': null
            }
        },

        methods: {
            getAllBlogs(){
                axios.get('/api/blog')
                    .then((response) => {
                        this.blogs = response.data.blogs
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },

            getCurrentUserInfo(){
                axios.post('/api/user/currentUser', {
                    'userID': localStorage.getItem('userID'),
                    'token': localStorage.getItem('token'),
                })
                    .then((response) => {
                        this.user = response.data.user
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },
        },

        mounted(){
            this.getAllBlogs()

            if(localStorage.getItem('userID') !== null && localStorage.getItem('token') !== null){
                this.getCurrentUserInfo()
            }
        }
    }
</script>
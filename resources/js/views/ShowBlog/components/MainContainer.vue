<template>
    <main>
        <div class="container">
            <MainContainerItemSkeleton v-if="blogs === null || user === null"/>

            <MainContainerItem v-else v-for="blog in blogs" :blog="blog" :user="user" :comments="comments" :users="users" @refresh="getAllBlogs"/>
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
                'comments': null,
                'users': null
            }
        },

        methods: {
            /* get the current logged in user */
            getCurrentUserData(){
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
            /* get all the blogs to display at the homepage */
            getAllBlogs(){
                axios.get('/api/blog')
                    .then((response) => {
                        this.blogs = response.data.blogs
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },

            /* get all the user blogs to display at the userprofile */
            getUserBlogs(){
                axios.get('/api/blog/user/' + this.$route.params.id)
                    .then((response) => {
                        this.blogs = response.data.blogs
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },

            /* get the user data to display at the userprofile*/
            getUserProfile(){
                axios.get('/api/profile/user/' + this.id)
                    .then((response) => {
                        this.users = response.data.users
                    })
                    .catch((error) => {
                        console.warn(error)
                    })
            },
        },

        mounted(){
            if(localStorage.getItem('userID') !== null && localStorage.getItem('token') !== null){
                this.getCurrentUserData()
            }
            
            if (this.$route.path == '/home') {
                this.getAllBlogs()
            }else{
                this.getUserBlogs()
            }
            
            this.getUserProfile()
        }
    }
</script>
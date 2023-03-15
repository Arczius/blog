<template>
    <main>
        <div class="container">
            <MainContainerItemSkeleton v-if="blogs === null || user === null"/>

            <MainContainerItem v-else v-for="blog in blogs" :blog="blog" :user="user" :comments="comments" :users="users" @refreshHome="getAllBlogs" @refreshUser="getUserBlogs" :user-icon="profile_picture"/>
        </div>
    </main>
</template>

<script setup>
    import MainContainerItemSkeleton from './MainContainerItemSkeleton.vue'
    import MainContainerItem from './MainContainerItem.vue';
    import Tyler from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg';
</script>

<script>
    import axios from 'axios'
    export default {
        name: "MainContainer",

        data(){
            return {
                'blogs': null,
                'user': null,
                'comments': null,
                'users': null,
                profile_picture: null,
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

            getUserProfilePicture(){
                if(this.profile_picture === null || this.profile_picture === Tyler || window.location.pathname === "/home"){

                    this.profile_picture = ( this.profile_picture === null )
                        ? Tyler
                            : this.profile_picture

                    const token = localStorage.getItem('token')
                    const userID = localStorage.getItem('userID')

                    if(!token || !userID) {
                        return;
                    }

                    axios.post("/api/auth", {
                        'token': token,
                        'userID': userID,
                    })

                    .then((response) => {
                        if(response.data.authorized) {
                            axios.get("/api/profile/user/" + userID)
                                .then((response) => {
                                    if(response.data.users.profile_picture !== null) {
                                        this.profile_picture = '/storage/ProfilePictures/'+ response.data.users.profile_picture
                                    }
                                })
                            }
                        })
                }
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
            this.getUserProfilePicture()
        },

        watch: {
            $route () {
                this.blogs = this.user = this.comments = this.profile_picture = this.users = null

                if(localStorage.getItem('userID') !== null && localStorage.getItem('token') !== null){
                    this.getCurrentUserData()
                }

                if (this.$route.path == '/home') {
                    this.getAllBlogs()
                }
                else{
                    this.getUserBlogs()
                }

                this.getUserProfile()
                this.getUserProfilePicture()
            }
        }
    }
</script>

<template>
    <Header
        :user-icon="profile_picture"
        :userID="userID"
        />
    <router-view></router-view>
    <Footer/>
</template>


<script setup>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import tyler from '../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg'
import public_routes from "./router/public_routes.js"
</script>

<script>
    import axios from 'axios'
    export default {
        name: "app",

        data(){
            return {
                profile_picture: null,
                userID: null,
            }
        },

        methods: {
            /* show an alert if the user is not logged in */
            notifyUnauthorized(){
                alert('you must be logged in to view this page')
                this.$router.push("/")
            },

            /**
            * authorize the user
            * @returns {void}
            */
            authorize(){
                if(!public_routes.includes(window.location.pathname)) {
                    const token = localStorage.getItem('token')
                    const userID = localStorage.getItem('userID')

                    if(!token || !userID) {
                        this.notifyUnauthorized()
                        return;
                    }

                    axios.post("/api/auth", {
                        'token': token,
                        'userID': userID
                    })
                        .then((response) => {

                            if(!response.data.authorized) {
                                localStorage.clear()

                                this.notifyUnauthorized()
                            }
                            else {
                                this.userID = userID
                            }
                        })
                }
            },

            /* get the profile picture of the current logged in user */
            getUserProfilePicture(){
                if(this.profile_picture === null || this.profile_picture === tyler || window.location.pathname === "/home"){

                    this.profile_picture = ( this.profile_picture === null )
                        ? tyler
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

            /* set the title of the window tab based on the current used route */
            setTitle() {
                document.title = (this.$route.name)
                    ? this.$route.name
                        : "No Title Given"
            }
        },

        mounted(){
            this.getUserProfilePicture()
            this.setTitle()
        },

        watch: {
            $route () {
                this.authorize()
                this.getUserProfilePicture()
                this.setTitle()
            }
        }
    }


</script>
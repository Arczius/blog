<template>
    <blogCreate :user-icon="profile_picture"/>
    <router-view></router-view>
</template>


<script setup>
    import blogCreate from './BlogCreate.vue';
    import tyler from '../../../../assets/tyler-nix-PQeoQdkU9jQ-unsplash.jpg';
</script>

<script>
    import axios from 'axios'
    export default {
        name: "MainContainer",

        data(){
            return {
                profile_picture: null,
            }
        },

        mounted(){
            this.getUserProfilePicture()
        },

        methods: {
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
        }
    }
</script>
